
<script>
    var base_url= "<?php echo base_url();?>";
    let permisos = JSON.parse('<?php echo json_encode($permisos) ?>');
        $(document).ready(() => {
            $('#duplicados').jtable({
               title : "DUPLICADOS",
               paging : true,
               overflow: scroll,
               //pageSize: true, //nos muestra el numero de registros
               sorting : true, // ordenar registros
               //defaultSorting: 'nombe ASC', // ordenado ascendente
                actions: {
                   listAction: '<?php echo site_url(); ?>matriculas/duplicados/lista',
                    // createAction: '<?php echo base_url(); ?>duplicados/duplicados/create"',
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
                            text: `<i class="fa fa-plus"></i> Nuevos Duplicados`,
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
                                fechabuscar = $('#fechabuscar').val();
                                console.log(permisos)
                                if (permisos.insert === '1'){
                                    excel(fechabuscar);
                                }
                            }
                        },
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
                        width: '25%' ,
                    },
                    descripcion:{
                        title: 'MODALIDAD',
                        width: '10%' ,
                    },
                    curso:{
                        key:true,
                        title: 'CURSO / EVENTO',
                        width: '25%' ,
                    },
                    folio:{
                        title: 'FOLIO',
                        width: '7%' ,
                    },
                    correlativo:{
                        title: 'CORRE',
                        width: '7%' ,
                    },
                    fecha_dupli:{
                        title: 'IMPRESIÓN',
                        width: '10%',
                       // type: 'date',
                    },
                    entrega_dupli:{
                        title: 'ENTREGA',
                        width: '10%' ,

                       // create:false,
                        display: (data) => {
                                if(data.record.entrega_dupli === '0'){
                                    return `<a href="javascript:void(0)" class="dar-row" data-id="${data.record.id}" title="Entregar"><i style="color: red" class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>`;
                                }
                                else{
                                    return `<a href="javascript:void(0)" class="ficha-row" data-id="${data.record.id}"  data-idpre="${data.record.pre}" title="Ficha">
                                    <i style="color: #008000" class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>`;
                                }
                        } 


                    },
                    see: {
                        width: '1%',
                        sorting:false,
                        edit:false,
                        create:false,
                        display: (data) => {
                                if(permisos.read === '1'){
                                    return `<a href="javascript:void(0)"  target="_blank" class="view-row" data-id="${data.record.id}"  data-idpre="${data.record.pre}" title="certificado">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>`;
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
                                    return `<a href="javascript:void(0)" style='color:skyblue' class="edit-row" data-id="${data.record.id}"   title="Editar">
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
                                    return `<a href="javascript:void(0)" style='color:red' class="delete-row" data-id="${data.record.id}" data-idpre="${data.record.pre}" title="Eliminar">
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
                        window.location.href = `<?php echo site_url(); ?>matriculas/duplicados/edit/${id}`;      
                    });

                    $('.view-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        let idpre = $(this).attr('data-idpre');
                       window.location.href = `<?php echo site_url(); ?>matriculas/Duplicados/view/${id}/${idpre}`; 
                     // window.open("<?php echo site_url(); ?>matriculas/duplicados/view/${id}/${idpre}", "_blank"); 
                    });

                    $('.delete-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                      //  let idpre = $(this).attr('data-idpre');
                        Swal.fire({
                            title: 'Estas Seguro?',
                            text: "de borrar este Duplicado de Certificado",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, Borrarlo'
                            }).then((result) => {
                            if (result.value) {
                                console.log(id)
                                const url = `<?php echo site_url(); ?>matriculas/duplicados/delete/${id}`;
                                fetch(url)
                                    .then(res=>res.json())
                                    .then(res => {
                                        console.log(res)
                                        Swal.fire(
                                            'Borrado Confirmado!',
                                            'Tu Duplicado de Certificado ha sido borrado',
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

                    $('.dar-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                       // let idpre = $(this).attr('data-idpre');
                        Swal.fire({
                            title: 'Estas Seguro?',
                            text: "de Entregar este Certificado",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, Entregar'
                            }).then((result) => {
                            if (result.value) {
                                console.log(id)
                                const url = `<?php echo site_url(); ?>matriculas/duplicados/entregar/${id}`;
                                fetch(url)
                                    .then(res=>res.json())
                                    .then(res => {
                                        console.log(res)
                                        Swal.fire(
                                            'Entrega Confirmado!',
                                            'Tu Certificado ha sido Entregado',
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
                    $('.ficha-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        let idpre = $(this).attr('data-idpre');
                        window.location.href = `<?php echo site_url(); ?>matriculas/duplicados/ficha/${id}/${idpre}`;  
                    });


				}
            });
        //   $('#duplicados').jtable('load');
        LoadRecordsButton = $('#LoadRecordsButton');
        LoadRecordsButton.click(function (e) {
            e.preventDefault();
            console.log($('#search').val())
            $('#duplicados').jtable('load', {
                search: $('#search').val()
            });
        });
        
        $('#btn_buscarfecha').click((e)=>{
        e.preventDefault();
        console.log($('#fechabuscar').val())
        $('#duplicados').jtable('load', {
            loquita: $('#fechabuscar').val()
         });
        })
        LoadRecordsButton.click();
    
    });

    const newRecord = () => {
        window.location.href = "<?php echo site_url(); ?>matriculas/duplicados/add";
    }
    
    const excel = (fechabuscar) => {
       // console.log(idapertura);
      //  debugger;
         window.location.href = "<?php echo site_url(); ?>matriculas/duplicados/excel?fechabuscar="+fechabuscar;
       //  console.log('loquita');
    }
    
</script>

