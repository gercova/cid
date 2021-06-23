<script>
    var base_url= "<?php echo base_url();?>";
    let permisos = JSON.parse('<?php echo json_encode($permisos) ?>');
        $(document).ready(() => {
            $('#modalCRUD').on('hidden.bs.modal', function (e) {
                $("#id").val('').prop('disabled', false);
                $("#dni").val('').prop("disabled", false);
                $("#nombre").val('').prop("disabled", false);
                $("#celular").val('').prop("disabled", false);
                $("#adicional").val('').prop("disabled", false);
                $("#email").val('').prop("disabled", false);
                $("#btnGuardar").prop('disabled', false);  
                $("#btn-consultar-dni").prop('disabled', false); 
            })

            $('#listado').jtable({
               title : "ESTUDIANTES",
               paging : true,
               overflow: scroll,
               pageSize: true, //nos muestra el dni de registros
               sorting : true, // ordenar registros
               defaultSorting: 'Orde date ASC', // ordenado ascendente

                actions: {
                   listAction: '<?php echo site_url("registrar/estudiantes/lista"); ?>',
                    // createAction: '<?php echo base_url(); ?>registrar/cursos/create"',
                    // updateAction: 'jj',
                    //deleteAction: '',
                },
                
                toolbar: {
                    items: [
                        {
                            cssClass: 'buscador',
                            text: buscador
						},
                        {
                            cssClass: 'btn-primary hide',
                            text: `<i class="fa fa-plus"></i> Nuevo`,
                            click: function () {
                            console.log(permisos)
                                if (permisos.insert === '1'){
                                    newRecord();
                                }
                            }
                        }
                    ]
                },
                fields: {
                    id:{
                        key:true,
                        title: 'ID',
                        width: '5%' ,
                    },
                    dni:{
                        title: 'DNI',
                        width: '10%' ,

                    },
                    nombre:{
                        title: 'APELLIDOS Y NOMBRES',
                        width: '20%' ,
                    },
                    celular:{
                        title: 'CELULAR',
                        width: '10%' ,
                    },
					email:{
                        title: 'EMAIL',
                        width: '10%' ,
                    },

                    see: {
                        width: '1%',
                        sorting:false,
                        edit:false,
                        create:false,
                        display: (data) => {
                            if(permisos.read === '1'){
                                return `<a href="javascript:void(0)" class="view-row" data-id="${data.record.id}" title="Ver">
                                <i class="fa fa-eye" aria-hidden="true"></i></a>`;
                            }
                        }  
                    },
                    edit: {
                        width: '1%',
                        sorting:false,
                        edit:false,
                        create:false,
                        display: (data) => {
                            if(permisos.update === '1'){
                                return `<a href="javascript:void(0)" style='color:skyblue' class="edit-row" data-id="${data.record.id}" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>`;
                            }
                        }
                    },
                    delete: {
                        width: '1%',
                        sorting:false,
                        edit:false,
                        create:false,
                        display: (data) => {
                            if(permisos.delete === '1'){
                                return `<a href="javascript:void(0)" style='color:red' class="delete-row" data-id="${data.record.id}" title="Eliminar">
                                <i class="fa fa-trash-o" aria-hidden="true"></i></a>`;
                            }
                        }
                    },
                },
                
                recordsLoaded: (event, data) => {
                    if (permisos.insert === '1'){
                        const newButton = document.getElementsByClassName('jtable-toolbar-item')[1];
                        newButton.classList.remove('hide');
                    }
                    $('.edit-row').click(function(e) {
                        e.preventDefault();
                        opcion = 2;
                        let id = $(this).attr('data-id');
                        console.log(id),
                        //window.location.href = `<?php echo site_url(); ?>administrador/estudiantes/edit/${id}`;
                        //LoadRecordsButton.click();
  
                        $.ajax({
                            url: base_url + "registrar/estudiantes/edit",
                            method: "POST",
                            data:{id:id},
                            dataType: "json"
                        })
                        .done(function(result) {
                        // console.log(result);
                            $("#id").val(result.id).prop("disabled", false);
                            $("#dni").val(result.dni).prop("disabled", false);
                            $("#nombre").val(result.nombre).prop("disabled", false);
                            $("#celular").val(result.celular).prop("disabled", false);
                            $("#adicional").val(result.adicional).prop("disabled", false);
                            $("#email").val(result.email).prop("disabled", false);
                            $("#btnGuardar").prop('disabled', false);
                            $("#btn-consultar-dni").prop('disabled', false);
                            $(".modal-header-color").css("background-color", "#28a745");
                            $(".modal-header-color").css("color", "white");
                            $(".modal-title-titulo").text("Editar Estudiante");        
                            $("#modalCRUD").modal("show");  
                        })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                        });
                    });

                    $('.view-row').click(function(e) {
                        e.preventDefault();
                        opcion = 3;
                        let id = $(this).attr('data-id');
                        console.log(id),

                        $.ajax({
                            url: base_url + "registrar/estudiantes/edit",
                            method: "POST",
                            data:{id:id},
                            dataType: "json"
                        })
                        .done(function(result) {
                        // console.log(result);
                            $("#id").val(result.id).prop("disabled", true);
                            $("#dni").val(result.dni).prop("disabled", true);
                            $("#nombre").val(result.nombre).prop("disabled", true);
                            $("#celular").val(result.celular).prop("disabled", true);
                            $("#adicional").val(result.adicional).prop("disabled", true);
                            $("#email").val(result.email).prop("disabled", true);
                            $("#btnGuardar").prop('disabled', true);
                            $("#btn-consultar-dni").prop('disabled', true);
                            $(".modal-header-color").css("background-color", "coral");
                            $(".modal-header-color").css("color", "white");
                            $(".modal-title-titulo").text("Datos del Estudiante");         
                            $("#modalCRUD").modal("show");      
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                        });
                    });

                    $('.delete-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        Swal.fire({
                            title: 'Estas Seguro?',
                            text: "de borrar este Usuario",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, Borrarlo'
                            }).then((result) => {
                            if (result.value) {
                                console.log(id)
                                const url = `<?php echo site_url(); ?>registrar/estudiantes/delete/${id}`;
                                fetch(url)
                                    .then(res=>res.json())
                                    .then(res => {
                                        console.log(res)
                                        Swal.fire(
                                            'Borrado Confirmado!',
                                            'Tu Usuario ha sido borrado',
                                            'success'
                                        )   
                                        LoadRecordsButton.click();
                                    })
                                .catch(function(err) {
                                        console.log(err);
                                });
                            }
                        })
                    });
				}
            });
        //   $('#cursos').jtable('load');
        LoadRecordsButton = $('#LoadRecordsButton');
        LoadRecordsButton.click(function (e) {
            e.preventDefault();
            console.log($('#search').val())
            $('#listado').jtable('load', {
                search: $('#search').val()
            });
        });
        LoadRecordsButton.click();
    
    });

const newRecord = () => {
    $("#form_estudiantes").trigger("reset");
    $(".modal-header-color").css("background-color", "#007bff");
    $(".modal-header-color").css("color", "white");
    $(".modal-title-titulo").text("Nuevo Estudiante");            
    $("#modalCRUD").modal("show");        
    id="";
}

$("#form_estudiantes").submit(function(e){
    e.preventDefault();  
    id          = $.trim($("#id").val()); 
    dni         = $.trim($("#dni").val());    
    nombre      = $.trim($("#nombre").val());
    email       = $.trim($("#email").val());
    celular     = $.trim($("#celular").val());
    adicional   = $.trim($("#adicional").val());  

    $.ajax({
        url: "<?php echo base_url(); ?>registrar/estudiantes/store",
        type: "POST",
        dataType: "json",
        data: {id:id, dni:dni, nombre:nombre, celular:celular, adicional:adicional, email:email},
       // data:{guardar},
        success: function(data){  
            console.log(data)
            Swal.fire({
                //position: 'top-end',
                icon: 'success',
                title: 'Los datos se Guardaron Correctamente',
                showConfirmButton: false,
                timer: 1500,
            })
            LoadRecordsButton.click();
            $("#modalCRUD").modal("hide");
        }        
    });
  
});
</script>