
<script>
    var base_url= "<?php echo base_url();?>";
    let permisos = JSON.parse('<?php echo json_encode($permisos) ?>');
    let ini =  null;
    let fin =  null;
    let fselec =  null;
        $(document).ready(() => {
            $('#reportediario').jtable({
               title : "LISTA DE INGRESOS",
               paging : true,
               overflow: scroll,
               //pageSize: true, //nos muestra el numero de registros
               sorting : true, // ordenar registros
               //defaultSorting: 'nombe ASC', // ordenado ascendente.
                actions: {
                   listAction: '<?php echo site_url(); ?>reportes/Diarios/lista',
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
                            text: `<i class="fa fa-download" aria-hidden="true"></i> Excel`,
                            click: function () {
                                ini= $('#fechainicio').val(),
                                fin= $('#fechafin').val(),
                                fselec= $('#fechaselec').val(),
                            console.log(permisos)
                                if (permisos.insert === '1'){
                                    excel(ini,fin,fselec);
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
                    fecha_registro:{
                        title: 'REGISTRO',
                        style:'color:red',
                        width: '7%' ,
                    },
                    
                    dni:{
                        title: 'DOCUMENTO',
                        width: '8%' ,
                    },
                    estudiante:{
                        title: 'ESTUDIANTE',
                        width: '20%' ,
                    },
                    curso:{
                        title: 'CUSO / EVENTO',
                        width: '20%' ,
                    },
                    monto:{
                        title: 'MONTO',
                        width: '5%' ,
                    },
                    codigo:{
                        title: 'CODIGO',
                        width: '5%' ,
                    },
                    fecha_pago:{
                        title: 'CANCELACIÓN',
                        width: '7%' ,
                    },

                },
                

                recordsLoaded: (event, data) => {
                    
				}
            });
        //   $('#aulas').jtable('load');
        LoadRecordsButton = $('#LoadRecordsButton');
        LoadRecordsButton.click(function (e) {
            e.preventDefault();
            console.log($('#search').val())
            $('#reportediario').jtable('load', {
                search: $('#search').val()
            });
        });
        $('#btn_buscarpago').click((e)=>{
            e.preventDefault();
          // console.log( $('#fechaselec').val());
           // console.log($('#fechafin').val());
            $('#reportediario').jtable('load', {
                ini: $('#fechainicio').val(),
                fin: $('#fechafin').val(),
                fselec: $('#fechaselec').val(),
              
            });
        })

        LoadRecordsButton.click();
    
    });

    const excel = (ini,fin, fselec) => {
      //  console.log(ini);
     //   console.log(fin);
     //  debugger;
      // window.location.href = `<?php echo site_url(); ?>reportes/Diarios/excel/${ini}/${fin}`;
        window.location.href = "<?php echo site_url(); ?>reportes/Diarios/excel?ini="+ini+"&fin="+fin+"&fselec="+fselec;
       //  console.log('loquita');
    }
</script>

