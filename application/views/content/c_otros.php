
<script>
    var base_url= "<?php echo base_url();?>";
    let permisos = JSON.parse('<?php echo json_encode($permisos) ?>');
        $(document).ready(() => {
            $('#otros').jtable({
               title : "PAGOS VARIOS",
               paging : true,
               overflow: scroll,
               //pageSize: true, //nos muestra el numero de registros
               sorting : true, // ordenar registros
               //defaultSorting: 'nombe ASC', // ordenado ascendente

                actions: {
                   listAction: '<?php echo site_url(); ?>movimientos/otros/lista',
                    // createAction: '<?php echo base_url(); ?>movimientos/otros/create"',
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
                            text: `<i class="fa fa-plus"></i> Nuevo Pago`,
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
                    num_documento:{
                        key:true,
                        title: 'DNI',
                        width: '5%' ,
                    },
                    estudiante:{
                        title: 'ESTUDIANTE',
                        width: '30%' ,
                    },
                    concepto:{
                        key:true,
                        title: 'CONCEPTO',
                        width: '30%' ,
                    },
                    fecha_pago:{
                        title: 'FECHA_PAGO',
                        width: '10%' ,
                    },
                    monto:{
                        title: 'MONTO',
                        width: '5%' ,
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
                                    return `<a href="javascript:void(0)" style='color:skyblue' class="edit-row" data-id="${data.record.id}" title="Editar">
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
                        window.location.href = `<?php echo site_url(); ?>movimientos/otros/edit/${id}`;      
                    });

                    $('.view-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        $.ajax({
                            url: base_url + "movimientos/otros/view/" + id,
                            type:"POST",
                            success:function(resp){
                                $("#modal-otros .modal-body").html(resp);
                                $("#modal-otros").modal('show');
                                //alert(resp);
                            }
                        });
                    });

                    $('.delete-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        Swal.fire({
                            title: 'Estas Seguro?',
                            text: "de borrar este Pago",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, Borrarlo'
                            }).then((result) => {
                            if (result.value) {
                                console.log(id)
                                const url = `<?php echo site_url(); ?>movimientos/otros/delete/${id}`;
                                fetch(url)
                                    .then(res=>res.json())
                                    .then(res => {
                                        console.log(res)
                                        Swal.fire(
                                            'Borrado Confirmado!',
                                            'Tu Pago ha sido borrado',
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
        //   $('#otros').jtable('load');
        LoadRecordsButton = $('#LoadRecordsButton');
        LoadRecordsButton.click(function (e) {
            e.preventDefault();
            console.log($('#search').val())
            $('#otros').jtable('load', {
                search: $('#search').val()
            });
        });
        LoadRecordsButton.click();
    
    });

    const newRecord = () => {
        window.location.href = "<?php echo site_url(); ?>movimientos/otros/add";
    }
</script>

