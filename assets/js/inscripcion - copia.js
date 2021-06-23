
$(document).ready(function () {
	//Initialize Select2 Elements
    var controlador= "index";   
    getCursoApertura();
    var _mSelect2 = $("#documento").select2();
    $('#curso_id').select2();
    $('.select2').select2();
    

    $("#BtnSave1").click(function () {                          
       
        text = $("#BtnSave1").html();
        $("#BtnSave1").addClass("disabled");
        $("#BtnSave1").html('Procesando, espere porfavor...');

        var bval = true;

        /*Validación de campos*/
        if( !($("#nivel_id").val() >= 1) ){
            bval = false ;
            msj_error = "Grado de estudio no seleccionado.";
        }else if( !($("#apertura_id:checked").val() >= 1)) {
            bval = false ;
            msj_error = "Grupo de estudio y horario disponible no seleccionado.";
        }else if( $("#tipo_documento_id").val() == 1  && 
            $("#num_documento").val().length != 8 ){
            bval = false ;
            msj_error = "Formato de DNI incorrecto.";
        }else if( $("#nombre2").val().length <= 5){
            bval = false ;
            msj_error = "Ingrese un nombre valido.";
        }else if( $("#email").val().length == 0  && 
            $("#telefono").val().length == 0 ){
            bval = false ;
            msj_error = "Ingrese un email valido.";
        } 

        if (bval) {
            var formData = new FormData();
            formData.append('_token', $("#token").val());                                
            formData.append('curso_id', $("#curso_id").val());
            formData.append('curso_nombre', $("#curso_id").val());
            formData.append('apertura_id', $("#apertura_id:checked").val());
            formData.append('nivel_id', $("#nivel_id").val());
            formData.append('carrera_id', $("#carrera_id").val());
            formData.append('check', $("#check").val());
            formData.append('tipo_documento_id', $("#tipo_documento_id").val());
            formData.append('num_documento', $("#num_documento").val());
            formData.append('fecha_nacimiento', $("#fecha_nacimiento").val());
            formData.append('nombre2', $("#nombre2").val());
            formData.append('sexo_id', $("#sexo_id").val());
            formData.append('telefono', $("#telefono").val());
            formData.append('email', $("#email").val());
            formData.append('direccion', $("#direccion").val());
            formData.append('check_re', $("#check_re").val());                
            
            
            $.ajax({

                url: 'guardar_inscripcion',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    $("#BtnSave1").removeClass("disabled");
                    $("#BtnSave1").html(text);
                    if(data.grupo==0 && data.error==0){                                
                        Swal.fire({
                            icon: 'success',
                            title: 'Inscripción realizada con éxito',
                            text: 'Se ha enviado un correo de confirmación a su bandeja.',
                            showCancelButton: false,
                            closeOnConfirm: false,
                            allowOutsideClick: false                
                        }).then((result) => {
                            window.location.reload();;   
                        })

                    }
                    if(data.error==1){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se realizó el registro de inscripción.'
                        });
                    }

                    if(data.grupo==1){
                          Swal.fire({
                            icon: 'warning',
                            title: 'Inscripción ya registrada',
                            text: 'Usted ya se encuentra registrado en este curso.'
                        });
                    }
                    
                },
                error: function (data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al registrar inscripción',
                        text: 'Comuníquese con personal del CTI.',
                        confirmButtonClass: "btn-danger"
                    });
                    $("#BtnSave1").removeClass("disabled");
                    $("#BtnSave1").html(text);
                }
            });        

        } else {
            $("#BtnSave1").removeClass("disabled");
            $("#BtnSave1").html(text);
            Swal.fire({
                icon: 'warning',
                title: 'ERROR EN :: ',
                text: msj_error
            });
        }

    });

        
    $("#buscar").click(function () {                     
                           
        text = $("#buscar").html();

        $("#buscar").addClass("disabled");
        $("#buscar").html('Procesando... ');

        var bval     = true;
        var select   = $(this).attr("id");
        var value    = $("#num_documento").val();
        var dependent= $(this).data('dependent');
        var _token   = $('input[name="_token"]').val();

        $.ajax({
           url: base_url + "web/inscripcion/get_datos_estudiante",
           type: "POST",
           data: {select: select, value: value, _token: _token, dependent: dependent},
        }).done(function(respuesta){

            if ( respuesta.length == 0 ) {
                $('#sin_data').html("<h6 style='color: red'NO SE ENCONTRÓ REGISTRO</h6>");

                $('#fecha_nacimiento_div','#nombre2').val("");
                $('#telefono','#email','#direccion').val("");

                rpta_icon = "warning";
                rpta_title = "No se pudo econtrar registro";                
            } else {

                $('#fecha_nacimiento_div').html('<label>Fecha nacimiento </label> <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="'+respuesta.fecha_nacimiento+'">');
                $('#nombre2').val(respuesta.nombre);
                $('#sexo_id').val(respuesta.sexo_id).trigger('change');
                
                $('#telefono').val(respuesta.celular);
                $('#email').html(respuesta.email);
                $('#direccion').html(respuesta.direccion);

                $('#carrera_id').val(respuesta.carrera).trigger('change');

                rpta_icon = "success";
                rpta_title = "Se encontró registro";                

            }

            Swal.fire({
                icon: rpta_icon,
                title: rpta_title
            });
                         
        }).always(function(respuesta){
            $("#buscar").removeClass("disabled");
            $("#buscar").html(text);
        });       

    });

});

function getCursoApertura() {
    var curso_id= $("#curso_id").val();
        $("#table-curso-apertura").html("<p> Cargando ... </p>");
        $.ajax({
        url         : base_url + "web/inscripcion/getCursoAperturaTable/" + curso_id,
        type        :"POST",
        success     :function(resp){
        	$("#table-curso-apertura").html(resp);
        }
    });
}

///check validar estudiante por dni
function showContent() {
    check_exist = document.getElementById("check");
    btn_buscar = document.getElementById("buscar");

    if (check_exist.checked) {
        btn_buscar.disabled = false;
        document.getElementById("check_re").value = "1";
    } else {
        btn_buscar.disabled = true;
        document.getElementById("check_re").value = "0";
    }
}

$('.input-number').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});


function saveSolicitud() {
       
    text = $("#BtnSave").html();
    $("#BtnSave").addClass("disabled");
    $("#BtnSave").html('Procesando, espere porfavor...');
    var bval = true;
    if (bval) {
        var formData = new FormData();
        formData.append('_token', $("#token").val());                                
        formData.append('curso_id', $("#curso_id").val());
        formData.append('nombre', $("#nombre").val());
        formData.append('celular', $("#celular").val());
        formData.append('correo', $("#correo").val());
        formData.append('lunes', $("#lunes").val());
        formData.append('martes', $("#martes").val());
        formData.append('miercoles', $("#miercoles").val());
        formData.append('jueves', $("#jueves").val());
        formData.append('viernes', $("#viernes").val());
        formData.append('sabado', $("#sabado").val());
        formData.append('domingo', $("#domingo").val());
        formData.append('hora_tentativa', $("#hora_tentativa").val());
        formData.append('mensaje', $("#mensaje").val());
        
        if (bval) {
            $.ajax({
                url: 'guardar_solicitud_apertura',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    $("#BtnSave").removeClass("disabled");
                    $("#BtnSave").html(text);

                    alert("El personal de CTI-UNSM, evaluará la solicitud y se pondrá en coctacto con usted. Gracias por su tiempo.");
                    
                    window.location.reload();
                }
            });
        } else {
            $("#BtnSave").removeClass("disabled");
            $("#BtnSave").html(text);
        }
    }

}


