

<script src="<?php echo base_url();?>assets/template/swalalert2.js"></script>

<script>
//Función para mostrar alerta
function mostrarAlert(icon, title){
    Swal.fire({
        icon: icon,
        title: title,
    });
}

var statusSend = false;

//Requiere añadir "id=myForm" a elemento form
document.getElementById("myForm").onsubmit = function() { return checkSubmit()};

function checkSubmit() {
	mostrarAlert('warning','Procesando datos ...');
    if (!statusSend) {
        statusSend = true;
        return true;
    } else {
        //alert("El formulario ya se esta enviando...");
        return false;
    }
}
</script>