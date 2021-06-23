
<script>
    var base_url= "<?php echo base_url();?>";
    let permisos = JSON.parse('<?php echo json_encode($permisos) ?>');
   let idapertura =  null;
        $(document).ready(() => {
            $('#modificar').jtable({
               title : "PRE MATRICULAS",
               paging : true,
               overflow: scroll,
               //pageSize: true, //nos muestra el numero de registros
               sorting : true, // ordenar registros
               //defaultSorting: 'nombe ASC', // ordenado ascendente

                actions: {
                      listAction: '<?php echo site_url(); ?>modificar/Modificar/lista',
                    // createAction: '<?php echo base_url(); ?>movimientos/prematriculas/create"',
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
                        },
                        {   tooltip: 'Descarga en Excel',
                            text: `<i class="fa fa-download" aria-hidden="true"></i> Excel`,
                            click: function () {
                                idapertura = $('#idapertura').val();
                            console.log(permisos)
                                if (permisos.insert === '1'){
                                    excel(idapertura);
                                }
                            }
                        },
                    ]
                },
                fields: {
                    id:{
                        key:true,
                        title: '#',
                        width: '5%' ,
                        // create: false,
                        // edit:false,
                        // list:false
                    },
                    num_documento:{
                        title: 'DNI',
                        width: '5%' ,

                    },
                    estudiante:{
                        title: 'ESTUDIANTE',
                        width: '20%' ,

                    },
                    celular:{
                        title: 'CELULAR',
                        width: '9%' ,
                    },

                    codigo:{
                        title: 'ID ',
                        width: '5%' ,

                    },
                    curso:{
                        title: 'CURSO ',
                        width: '20%' ,

                    },
                    grupo:{
                        title: 'GRUPO ',
                        width: '10%' ,

                    },
                    hora_ini:{
                        title: 'H. INICIO',
                        width: '10%' ,
                    },
                    hora_fin:{
                        title: 'H.FIN',
                        width: '10%' ,

                    },
                    
                    estado:{
                        title: 'ESTADO',
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
                        window.location.href = `<?php echo site_url(); ?>movimientos/Prematriculas/editm/${id}`;      
                    });

                    $('.view-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        $.ajax({
                            url: base_url + "movimientos/Prematriculas/view/" + id,
                            type:"POST",
                            success:function(resp){
                                $("#modal-prematriculas .modal-body").html(resp);
                                $("#modal-prematriculas").modal('show');
                                //alert(resp);
                            }
                        });
                    });

                    $('.delete-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        Swal.fire({
                            title: 'Estas Seguro?',
                            text: "de borrar este estudiante",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, Borrarlo'
                            }).then((result) => {
                            if (result.value) {
                                const url = `<?php echo site_url(); ?>movimientos/Prematriculas/delete/${id}`;
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
        //   $('#prematriculas').jtable('load');
        LoadRecordsButton = $('#LoadRecordsButton');
        LoadRecordsButton.click(function (e) {
            e.preventDefault();
            $('#modificar').jtable('load', {
                search: $('#search').val(),
                //listAction: '<?php echo site_url(); ?>movimientos/Prematriculas/list',
            });
        });
        
        $('#btn_searchMatr').click((e)=>{
            e.preventDefault();
             console.log('idapertura');
            $('#modificar').jtable('load', {
                loquita: $('#idapertura').val()
                
            });
        })
        LoadRecordsButton.click();
    });

    const newRecord = () => {
       // window.location.href = "<?php echo site_url(); ?>movimientos/Prematriculas/add";
    }

    const excel = (idapertura) => {
       // console.log(idapertura);
      //  debugger;
         window.location.href = "<?php echo site_url(); ?>modificar/Modificar/excel?idapertura="+idapertura;
       //  console.log('loquita');
    }


</script>

