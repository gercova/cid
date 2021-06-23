
<script>
    var base_url= "<?php echo base_url();?>";
    let permisos = JSON.parse('<?php echo json_encode($permisos) ?>');
        $(document).ready(() => {
            $('#notas').jtable({
               title : "NOTAS",
               paging : true,
               overflow: scroll,
               //pageSize: true, //nos muestra el numero de registros
               sorting : true, // ordenar registros
               //defaultSorting: 'nombe ASC', // ordenado ascendente
                actions: {
                   listAction: '<?php echo site_url(); ?>matriculas/notas/lista',
                    // createAction: '<?php echo base_url(); ?>notas/notas/create"',
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
                            text: `<i class="fa fa-plus"></i> Nuevas Notas`,
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
                        key:true,
                        title: 'CURSO',
                        width: '30%' ,
                    },
                    docente:{
                        title: 'DOCENTE',
                        width: '30%' ,
                    },
                    grupo:{
                        title: 'GRUPO',
                        width: '10%' ,
                    },
                    fecha_ini:{
                        key:true,
                        title: 'F.FIN',
                        width: '10%' ,
                    },
                    fecha_fin:{
                        title: 'F. INICIO',
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
                                    return `<a href="javascript:void(0)" style='color:skyblue' class="edit-row" data-id="${data.record.id}"  title="Editar">
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
                        let id = $(this).attr('data-id');
                        window.location.href = `<?php echo site_url(); ?>matriculas/notas/edit/${id}`;      
                    });

                    $('.view-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        $.ajax({
                            url: base_url + "matriculas/notas/view/" + id,
                            type:"POST",
                            success:function(resp){
                                $("#modal-notas .modal-body").html(resp);
                                $("#modal-notas").modal('show');
                                //alert(resp);
                            }
                        });
                    });

                    $('.delete-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        Swal.fire({
                            title: 'Estas Seguro?',
                            text: "de borrar este Curso aperturado",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, Borrarlo'
                            }).then((result) => {
                            if (result.value) {
                                console.log(id)
                                const url = `<?php echo site_url(); ?>matriculas/notas/delete/${id}`;
                                fetch(url)
                                    .then(res=>res.json())
                                    .then(res => {
                                        console.log(res)
                                        Swal.fire(
                                            'Borrado Confirmado!',
                                            'Tu Estudiante ha sido borrado',
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
        //   $('#notas').jtable('load');
        LoadRecordsButton = $('#LoadRecordsButton');
        LoadRecordsButton.click(function (e) {
            e.preventDefault();
            console.log($('#search').val())
            $('#notas').jtable('load', {
                search: $('#search').val()
            });
        });
        LoadRecordsButton.click();
    
    });

    const newRecord = () => {
        window.location.href = "<?php echo site_url(); ?>matriculas/notas/add";
    }
</script>

