
$(document).ready(function () {
	//Initialize Select2 Elements
    var controlador= "pago";   
  
    var base_url= "<?php echo base_url();?>"; 

    $("#buscar").click(function () {
                          
                           
        text = $("#buscar").html();
        $("#buscar").addClass("disabled");
        $("#buscar").html('Procesando... ');
        var bval = true;
        var select = $(this).attr("id");
        var value = $("#num_documento").val();
        var dependent = $(this).data('dependent');
        var _token = $('input[name="_token"]').val();
    


         $.ajax({
           url: "pago/fecha_nacimiento",
           type: "POST",
           data: {select: select, value: value, _token: _token, dependent: dependent},
            
                }).done(function(respuesta){

                         $('#fecha_nacimiento').html('<label>Fecha nacimiento </label> <input disabled type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="'+respuesta.fecha_nacimiento+'">');
                         $('#nombre_nuevo').html('<label>Nombre </label> <input disabled type="text" id="nombre" name="nombre" class="form-control" value="'+respuesta.nombre+'">');
                         $('#sexo_id').html('<label>Sexo </label> <input disabled type="text" id="nombre" name="nombre" class="form-control" value="'+respuesta.descripcion_sexo+'">');
                         $('#telefono_contacto').html('<label>Telefono </label> <input disabled type="text" id="telefono" name="telefono" class="form-control" value="'+respuesta.celular+'">');
                         $('#email_contacto').html('<label>Email </label> <input disabled type="text" id="email" name="email" class="form-control" value="'+respuesta.email+'">');
                         $('#direccion_contacto').html('<label>Direccion </label> <input disabled type="text" id="direccion" name="direccion" class="form-control" value="'+respuesta.direccion+'">');
                         getListPago(respuesta.id);

                });

  
         $.ajax({
            url: "pago/sin_data",
            method: "POST",
            data: {select: select, value: value, _token: _token, dependent: dependent},
            success: function (result, result1)
            {
                $('#sin_data').html(result);
            }

        });
                     


                $("#buscar").removeClass("disabled");
                $("#buscar").html(text);

    });

 $("#BtnSave1").click(function () {      
       
        text = $("#BtnSave1").html();
        $("#BtnSave1").addClass("disabled");
        $("#BtnSave1").html('Procesando, espere porfavor...');
        var bval = true;
        if (bval) {
            var formData = new FormData();

            formData.append('_token', $("#token").val());                                
            formData.append('fecha_pago', $("#fecha_pago").val());   
            formData.append('descripcion', $("#descripcion").val());
            formData.append('codigo', $("#codigo").val());
            formData.append('monto', $("#monto").val());
            var inputFileCedula = document.getElementById('imagen_pago');
            var file = inputFileCedula.files[0];
            formData.append('imagen_pago', file);
            formData.append('comentario', $("#comentario").val());
            formData.append('prematricula_id', $("#prematricula_id").val());
           
            
            if (bval) {
                $.ajax({

                    url: 'pago/guardar_pago',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (data) {
                        $("#BtnSave1").removeClass("disabled");
                        $("#BtnSave1").html(text);
                        if( data.error==0){
                            Swal.fire({
                                icon: 'success',
                                title: data.text,
                                showConfirmButton: false,
                                timer: 1000,
                                onClose: () => {
                                window.location=  controlador;

                                }});
                        }
                        if(data.error==1){
                              Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.text
                            });
                        }

                        if(data.grupo==1){
                              Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'ya existe estudiante en ese grupo'
                            });
                        }
                        
                    }
                });
            } else {
                $("#BtnSave1").removeClass("disabled");
                $("#BtnSave1").html(text);
            }
        }

    });
 
	$('#curso_id').select2();

});

function getListPago($id='') {
	var id = $id;
	$("#table-lista-pago").html("<p> Cargando ... </p>");
	console.log(id);
	$.ajax({
		url: base_url + "web/pago/getListPagoTable/" + id,
		type:"POST",
		success:function(resp){
			$("#table-lista-pago").html(resp);
		}
	});
}

   ///check validar estudiante por dni

function showContent() {
    element = document.getElementById("content");

    check = document.getElementById("check");
    if (check.checked) {
        element.style.display='block';
        document.getElementById("check_re").value = "1";

    }
    else {
        element.style.display='none';
        document.getElementById("check_re").value = "0";

    }
}

$('.input-number').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});   

var _mSelect2 = $("#documento").select2();
 $('select').select2();

