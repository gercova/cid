
$(document).ready(function () {
	$('.select2').select2();

    //Validar el registro de solo números
    $('.input-number').on('input', function () { 
        this.value = this.value.replace(/[^0-9]/g,'');
    });

    function mostrarAlert(icon, title, input_focus = ''){      

        Swal.fire({
            icon: icon,
            title: title,
          
        }).then((result) => {
            if(input_focus!=''){
                $(input_focus).focus();
            }
        })
    }

    function getListPagoPendientes(id_estudiante) {
        $("#table-lista-pago").html("<p> Cargando ... </p>");
        $.ajax({
            url: base_url + "web/pago/getListPagoTable/",
            type:"POST",
            data: {id_estudiante: id_estudiante},
            async: true,
            success:function(resp){
                $("#table-lista-pago").html(resp);
            }
        });
    }

    //Buscar datos del interesado
    $("#num_documento").on('input',function() {

        length_tipo = $("#tipo_documento_id option:selected").attr("length_valid");
        if(this.value.length == length_tipo){

            var tipo_documento   = $("#tipo_documento_id").val();
            var num_documento    = this.value;

            $.ajax({
                url : base_url + "web/pago/get_datos_estudiante/",
                type :"POST",
                data: {tipo_doc: tipo_documento, num_doc: num_documento},
                dataType: 'JSON',
                async: false,
                beforeSend: function(){
                    mostrarAlert('warning','Búsqueda en progreso.');
                },
                success :function(data){

                    if (data.fuente == 'cti' ) {
                        $('#fecha_nacimiento').html(data.fecha_nacimiento);
                        $('#nombre').html(data.nombre);
                        $('#sexo').html(data.sexo);                        
                        $('#celular').html(data.celular);
                        $('#email').html(data.email);
                        $('#direccion').html(data.direccion);
                        $('#carrera').html(data.carrera);

                        getListPagoPendientes(data.id_estudiante);

                        mostrarAlert('success','Búsqueda con éxito.');
                    }else{
                        mostrarAlert('warning','No se ha encontrado resultados.');
                    }                    

                },
                error: function (data) {
                     mostrarAlert('error','Error en búsqueda.');
                }
            });
            
        }
    });


    function validInputsInscripcion() {

        bval = false ;

        if( $("#num_documento").val().length != $("#tipo_documento_id option:selected").attr("length_valid") ){
            mostrarAlert('warning','Formato no valido para el tipo de documento.', "#num_documento");
            return bval;
        }else if( $("#nombre").html().length <= 0){
            mostrarAlert('warning','No se cuenta con su nombre completo.',"#nombre");
            return bval;
        }else if( !($("#prematricula_id:checked").val() >= 1)) {
            mostrarAlert('warning','Debe seleccionar un pago pendiente.',"#table-lista-pago");
            return bval;
        }else if( !($("#codigo").val().length >= 1)) {
            mostrarAlert('warning','El codigo del boucher es requerido.',"#codigo");
            return bval;
        }else if( !($("#monto").val() >= 1)) {
            mostrarAlert('warning','El monto ingresado debe ser mayor a CERO.',"#monto");
            return bval;
        }else if( !($("#imagen_pago").val().length >= 1)) {
            mostrarAlert('warning','Es necesario la imagen del comprobante.',"#imagen_pago");
            return bval;
        }

        bval = true ;
        return bval;
    }

    $("#BtnSave2").click(function() {

        $("#BtnSave2").addClass("disabled");

        bval = validInputsInscripcion();

        if(bval){

            var formData = new FormData();

            formData.append('fecha_pago', $("#fecha_pago").val());   
            formData.append('descripcion', $("#descripcion").val());
            formData.append('codigo', $("#codigo").val());
            formData.append('monto', $("#monto").val());            
            formData.append('comentario', $("#comentario").val());
            formData.append('prematricula_id', $("#prematricula_id:checked").val());

            var inputFileCedula = document.getElementById('imagen_pago');
            var file = inputFileCedula.files[0];           
            formData.append('imagen_pago', file);

        $.ajax({
            type:   'POST',
            url:    base_url +'web/pago/guardar_pago',
            data:   formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            beforeSend: function(){
                mostrarAlert('warning','Registro de pago en progreso.');
            },
            success: function (data) {

                if(data.error==0){
                    Swal.fire({
                        icon: 'success',
                        title: data.msj_success,
                        text: 'Pendiente de validación.',
                        showCancelButton: false,
                        closeOnConfirm: false,
                        allowOutsideClick: false                
                    }).then((result) => {
                        window.location.reload(); 
                    });

                }else if(data.error==1){
                    mostrarAlert('error',data.msj_error);
                }                                     
                
            },
            error:function (result) {
                mostrarAlert('error','Fallo en registro de pago.');  
            },
            complete:function (){
                $("#BtnSave2").removeClass("disabled");
            }
        }); 

        } else {
            $("#BtnSave2").removeClass("disabled");
        }

    });

    
});
