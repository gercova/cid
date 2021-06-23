
<script>
    var base_url= "<?php echo base_url();?>";
    let permisos = JSON.parse('<?php echo json_encode($permisos) ?>');
    let idapertura =  null;
  //  let fin =  null;
    //let fselec =  null;
        $(document).ready(() => {
            $('#pagogrupo').jtable({
               title : "LISTADO",
               paging : true,
               overflow: scroll,
               //pageSize: true, //nos muestra el numero de registros
               sorting : true, // ordenar registros
               //defaultSorting: 'nombe ASC', // ordenado ascendente.
                actions: {
                   listAction: '<?php echo site_url(); ?>reportes/pagogrupos/lista',
                    // createAction: '<?php echo base_url(); ?>Mantenimiento/aulas/create"',
                    // updateAction: 'jj',
                //    deleteAction: '',
                },
                
                toolbar: {
                    items: [
                        {
                            cssClass: 'buscador',
                            text: buscador
						},

                        {   tooltip: 'Descarga en Excel',
                            text: `<i class="fa fa-download" aria-hidden="true"></i> Descargar en Excel`,
                            click: function () {
                                idapertura= $('#idapertura').val(),
                                //fin= $('#fechafin').val(),
                               // fselec= $('#fechaselec').val(),
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
                        title: 'ID',
                        width: '5%' ,
                    },
                    dni:{
                        title: 'DOCUMENTO',
                        width: '8%' ,
                    },
                    estudiante:{
                        title: 'ESTUDIANTE',
                        width: '20%' ,
                    },
                    ape:{
                        title: '# APE ',
                        width: '5%' ,
                    },
                    curso:{
                        title: 'CUSO / EVENTO',
                        width: '20%' ,
                    },
                    boucher:{
                        title: 'BOUCHER',
                        width: '8%' ,
                    },
                    monto:{
                        title: 'PAGÓ',
                        width: '7%' ,
                    },
                    fecha:{
                        title: 'FECHA',
                        width: '5%' ,
                    },
                    see: {
                        width: '1%',
                        sorting:false,
                        edit:false,
                        create:false,
                        display: (data) => {
                                if(permisos.read === '1'){
                                    return `<a href="javascript:void(0)" class="view-row" data-id="${data.record.prematricula_id}" title="Ver">
                                    <i class="fa fa-eye" aria-hidden="true"></i></a>`;
                                }
                        }                      
                    },
                },
                
                recordsLoaded: (event, data) => {
                    $('.view-row').click(function(e) {
                        e.preventDefault();
                        let id = $(this).attr('data-id');
                        $.ajax({
                            url: base_url + "movimientos/pagos/view/" + id,
                            type:"POST",
                            success:function(resp){
                                $("#modal-pagos .modal-body").html(resp);
                                $("#modal-pagos").modal('show');
                                //alert(resp);
                            }
                        });
                    });
				}
            });
        //   $('#aulas').jtable('load');
        LoadRecordsButton = $('#LoadRecordsButton');
        LoadRecordsButton.click(function (e) {
            e.preventDefault();
            console.log($('#search').val())
            $('#pagogrupo').jtable('load', {
                search: $('#search').val()
            });
        });
        $('#buscardeudor').click((e)=>{
            e.preventDefault();
          // console.log( $('#idapertura').val());
           // console.log($('#fechafin').val());
            $('#pagogrupo').jtable('load', {
                loquita: $('#idapertura').val(),
              //  fin: $('#fechafin').val(),
               // fselec: $('#fechaselec').val(),
              
            });
        })

        LoadRecordsButton.click();
    
    });

    const excel = (idapertura) => {
      //  console.log(ini);
     //   console.log(fin);
     //  debugger;
     //  window.location.href = `<?php echo site_url(); ?>reportes/Diarios/excel/${idapertura}`;
        window.location.href = "<?php echo site_url(); ?>reportes/pagogrupos/excel?ini="+idapertura;
       //  console.log('loquita');
    }
</script>

