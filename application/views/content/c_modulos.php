
<script>
    var base_url= "<?php echo base_url();?>";
    let permisos = JSON.parse('<?php echo json_encode($permisos) ?>');
        $(document).ready(() => {
            $('#modalCRUD').on('hidden.bs.modal', function (e) {
                $("#cuid").val('').prop('disabled', false);
                $("#curso").val('').prop("disabled", false);
                $("#modulo").val('').prop("disabled", false);
                $("#abreviatura").val('').prop("disabled", false);
                $("#hora").val('').prop("disabled", false);
            })

             $('#listado').jtable({
               title : "MODULOS",
               paging : true,
               overflow: scroll,
               pageSize: true, //nos muestra el dni de registros
               sorting : true, // ordenar registros
               defaultSorting: 'Orde date ASC', // ordenado ascendente

                actions: {
                     listAction: '<?php echo site_url(); ?>registrar/modulos/lista',
                    // createAction: '<?php echo base_url(); ?>registrar/modulos/create"',
                    // updateAction: 'jj',
                //    deleteAction: '',
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
                    curso:{
                        title: 'CURSO',
                        width: '20%' ,
                    },
                    ciclo:{
                        key:true,
                        title: 'CICLO',
                        width: '10%' ,
                    },
                    nivel:{
                        key:true,
                        title: 'NIVEL',
                        width: '10%' ,
                    },
                    modulo:{
                        title: 'MODULO',
                        width: '20%' ,
                    },
                    horas:{
                        title: 'HORAS',
                        width: '20%' ,
                        
                    },
           
                    see: {
                        width: '1%',
                        sorting:false,
                        edit:false,
                        create:false,
                        display: (data) => {
                                if(permisos.read === '1'){
                                    return `<a href="javascript:void(0)" class="view-row" data-id="${data.record.cuid}" title="Ver">
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
                                    return `<a href="javascript:void(0)" style='color:skyblue' class="edit-row" data-id="${data.record.cuid}" title="Editar">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>`;
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
                        //window.location.href = `<?php echo site_url(); ?>administrador/modulos/edit/${id}`;
                        //LoadRecordsButton.click();
  
                        $.ajax({
                                url: base_url + "registrar/modulos/edit",
                                method: "POST",
                                data:{id:id},
                                dataType: "json"
                        })
                            .done(function(result) {
                            // console.log(result);
                                $("#idcurso").val(result.idcurso).prop("disabled", false);
                                $("#curso").val(result.descripcion+" - "+ result.ciclo+" - "+result.nivel).prop("disabled", false);
                                $("#modulo").val(result.modulo).prop("disabled", true);
                                $("#abrebiatura").val(result.abrebiatura).prop("disabled", true);
                                $("#hora").val(result.hora).prop("disabled", true);
                                $("#agregar_curso").val(result.agregar_curso).prop("disabled", true);
                                $("#agregar_modulo").val(result.agregar_modulo).prop("disabled", true);
                                $("#btnGuardar").prop('disabled', false);
                                $("#btn-consultar-dni").prop('disabled', false);
                                $(".modal-header-color").css("background-color", "#28a745");
                                $(".modal-header-color").css("color", "white");
                                $(".modal-title-titulo").text("Editar Modulos del Curso");        
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
                                url: base_url + "registrar/modulos/edit",
                                method: "POST",
                                data:{id:id},
                                dataType: "json"
                        })
                            .done(function(result) {
                            // console.log(result);
                                $("#idcurso").val(result.idcurso).prop("disabled", false);
                                $("#curso").val(result.descripcion+" - "+ result.ciclo+" - "+result.nivel).prop("disabled", false);
                                $("#modulo").val(result.modulo).prop("disabled", true);
                                $("#abrebiatura").val(result.abrebiatura).prop("disabled", true);
                                $("#hora").val(result.hora).prop("disabled", true);
                                $("#agregar_curso").val(result.agregar_curso).prop("disabled", true);
                                $("#agregar_modulo").val(result.agregar_modulo).prop("disabled", true);
                                $("#btnGuardar").prop('disabled', true);
                                $("#btn-consultar-dni").prop('disabled', true);
                                $(".modal-header-color").css("background-color", "coral");
                                $(".modal-header-color").css("color", "white");
                                $(".modal-title-titulo").text("Datos del Curso");         
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
                                const url = `<?php echo site_url(); ?>registrar/modulos/delete/${id}`;
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
        //   $('#modulos').jtable('load');
        LoadRecordsButton = $('#LoadRecordsButton');
        LoadRecordsButton.click(function (e) {
            e.preventDefault();
            console.log($('#search').val())
            $('#listado').jtable('load', {
                search: $('#search').val()
            });
        });
        LoadRecordsButton.click();
         //FORMULARIO MODULOS ////
            /// seleccionar el curso en el formulario modulos 
            $(document).on("click",".btn-cursos",function(){
                    curso = $(this).val();
                    infocurso = curso.split("*");
                    $("#idcurso").val(infocurso[0]);
                    $("#curso").val(infocurso[1]);
                    $("#modal-cursos").modal("hide");
            });
            // agregar modulos  
            $("#agregar_modulo").on("click",function(){
                        if ($("#modulo").val() !='' &&  $("#hora").val() !='' &&  $("#abreviatura").val() !='') {
                        data = $("#modulo").val()+"*"+$("#abreviatura").val()+ "*"+$("#hora").val();
                        infomodulo = data.split("*");
                        html = "<tr>";
                        html += "<td><input type='text' class='form-control' name='nombremodulo[]' value='"+infomodulo[0]+"'></td>";
                        html += "<td><input type='text' class='form-control' name='abreviaturamodulo[]' value='"+infomodulo[1]+"'></td>";
                        html += "<td><input type='text' class='form-control' name='horamodulo[]' value='"+infomodulo[2]+"'></td>";
                        html += "<td><button type='button' class='btn btn-danger btn-remove-modulo'><span class='fa fa-remove'></span></button></td>";
                        html += "</tr>";
                        $("#tbmodulos tbody").append(html);
                        $("#modulo").val(null);
                        $("#abreviatura").val(null);
                        $("#hora").val(null);
                    }else{
                        alert("Ingrese datos del Modulo...");
                    }
            });
            /// remover modulos
            $(document).on("click",".btn-remove-modulo", function(){
                $(this).closest("tr").remove();
            // sumar();
            });


    
    });

    const newRecord = () => {
        $("#form_modulos").trigger("reset");
        $(".modal-header-color").css("background-color", "#007bff");
        $(".modal-header-color").css("color", "white");
        $(".modal-title-titulo").text("Nuevo Curso");            
        $("#modalCRUD").modal("show");        
        id="";
    }

  

   $("#form_modulos").submit(function(e){
   e.preventDefault();  
   let formData = new FormData($("#form_modulos")[0]);
    $.ajax({
        url: "<?php echo base_url(); ?>registrar/modulos/store",
     //   type: "POST",
      //  dataType: "json",
        processData: false,
        contentType: false,
        type: 'POST',
        // type:$("form").attr("method"),
        data: formData,
        // data: {id:id, ciclos:ciclos, niveles:niveles, descripcion:descripcion, costo:costo, silabus:silabus, web:web},
       // data:{guardar},
        success: function(data){  
            console.log(data)
                Swal.fire({
              //  position: 'top-end',
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

