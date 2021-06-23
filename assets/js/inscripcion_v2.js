$(document).ready(function () {
    $('.select2').select2();
     getCursoApertura();

    //Validar el registro de solo números
    $('.input-number').on('input', function () { 
        this.value = this.value.replace(/[^0-9]/g,'');
    });

    function mostrarAlert(icon, title){
        Swal.fire({
            icon: icon,
            title: title,
        });
    }

    //Buscar datos del interesado
    $("#num_documento").on('input',function() {

        length_tipo = $("#tipo_documento_id option:selected").attr("length_valid");
        if(this.value.length == length_tipo){

            var tipo_documento   = $("#tipo_documento_id").val();
            var num_documento    = this.value;

            $.ajax({
                url : base_url + "web/inscripcion/get_datos_estudiante/",
                type :"POST",
                data: {tipo_doc: tipo_documento, num_doc: num_documento},
                dataType: 'JSON',
                async: true,
                beforeSend: function(){
                    mostrarAlert('warning','Búsqueda en progreso.');
                },
                success :function(data){

                    if (data.fuente == 'cti' ) {
                        $('#fecha_nacimiento').val(data.fecha_nacimiento);
                        $('#nombre').val(data.nombre);
                        $('#sexo_id').val(data.sexo_id);                        
                        $('#telefono').val(data.celular);
                        $('#email').val(data.email);
                        $('#direccion').val(data.direccion);
                        $('#carrera_id').val(data.carrera_id).trigger('change');
                    }else if( data.data.length > 0){
                        let name = data.data;
                        name = name.split("|");
                        name = `${name[0]} ${name[1]} ${name[2]}`;
                        $("#nombre").val(name);
                    }

                    mostrarAlert('success','Búsqueda con éxito.');

                },
                error: function (data) {
                     mostrarAlert('error','Error en búsqueda.');
                }
            });
            
        }
    });

    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email.trim()).toLowerCase());
    }

    function validInputsInscripcion() {

        bval = false ;

        if( $("#num_documento").val().length != $("#tipo_documento_id option:selected").attr("length_valid") ){
            mostrarAlert('warning','Formato no valido para el tipo de documento.');
            return bval;
        }else if( $("#nombre").val().length <= 2){
            mostrarAlert('warning','Es necesario contar con su nombre completo.');
            return bval;
        }else if( $("#email").val().length == 0 || !validateEmail($("#email").val()) ){
            mostrarAlert('warning','Es necesario contar con su email. Se enviará un correo de confirmación a su bandeja.');
            return bval;
        }else if( !($("#nivel_id").val() >= 1) ){
            mostrarAlert('warning','Debe seleccionar el grado de estudio.');
            return bval;
        }else if( !($("#apertura_id:checked").val() >= 1)) {
            mostrarAlert('warning','Debe seleccionar un grupo y horario disponible.');
            return bval;
        }

        bval = true ;
        return bval;
    }

    $("#BtnSave1").click(function() {

        $("#BtnSave1").addClass("disabled");

        bval = validInputsInscripcion();
        
        if(bval){

        $.ajax({
            type:   'POST',
            url:    base_url +'web/inscripcion/guardar_inscripcion',
            data:   $('#form-inscripcion').find('select, textarea, input').serialize(),
            dataType: 'json',
            beforeSend: function(){
                mostrarAlert('warning','Inscripción en progreso.');
            },
            success: function (data) {

                if(data.grupo==0 && data.error==0){
                    Swal.fire({
                        icon: 'success',
                        title: 'Inscripción realizada con éxito',
                        text: 'Se ha enviado un correo de confirmación a su bandeja.',
                        showCancelButton: false,
                        closeOnConfirm: false,
                        allowOutsideClick: false                
                    }).then((result) => {
                        window.location.reload(); 
                    });

                }else if(data.grupo==0 && data.error==1){
                    mostrarAlert('error','Fallo en inscripción. Por favor comuníquese con el administrador.');
                }else if(data.error==0 && data.grupo==1){
                    mostrarAlert('info','Usted ya se encuentra registrado en este curso. Si desea cambiar el horario, comuníquese con el administrador.');
                }                                      
                
            },
            error:function (result) {
                mostrarAlert('error','Fallo en inscripción.');  
            },
            complete:function (){
                $("#BtnSave1").removeClass("disabled");
            }
        }); 

        } else {
            $("#BtnSave1").removeClass("disabled");
        }

    });

});


//Muestra tabla de grupo y horarios disponibles
function getCursoApertura() {

    var curso_id= $("#curso_id").val();
    var sede_id= $("#sede_id").val();
    if(!$("#curso_id").val().length){
       curso_id= 'none'; 
    }
    $("#table-curso-apertura").html("<p> Cargando ... </p>");
    $.ajax({
        url         : base_url + "web/inscripcion/getCursoAperturaTable/" + curso_id+"/"+sede_id,
        type        :"POST",
        success     :function(resp){
            $("#table-curso-apertura").html(resp);
        },
        error: function (data) {
            rpta_error = " <h2> No se pudo obtener respuesta ... <i class='fa fa-frown-o'></h2>"
            $("#table-curso-apertura").html(rpta_error);
        },
        complete: function(){
         // Handle the complete event
            if($("#curso_id").val().length){
                var scrollBottom = $(window).scrollTop() + $(window).height();
                $('html, body').animate({scrollTop:scrollBottom}, 'slow');
            }
        }
    });

    //}
}

function crearSolicitud() {
    $("#modal-solicitud-apertura").modal("show");
}


