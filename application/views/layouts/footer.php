        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.1
            </div>
            <strong>CID &copy; 2021 <a href="https://www.cid.edu.pe">UNSM-T</a></strong>
        </footer>
    </div>
    <!-- ./wrapper -->

<!-- highcharts 3 -->
<script src="<?php echo base_url();?>assets/template/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/template/highcharts/exporting.js"></script>

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/template/jquery/unojquery.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery/jquery.print.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-print/jquery.print.js"></script>

<!-- timepicker 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/template/timepicker/bootstrap-timepicker.js"></script>

<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/template/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- IMPLEMENTACION DE JTABLE -->
<script src="<?php echo base_url();?>assets/template/jtable/jquery.jtable.js"></script>
<script src="<?php echo base_url();?>assets/template/jtable/jquery.jtable.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jtable/localization/jquery.jtable.es.js"></script>
<script src="<?php echo base_url();?>assets/template/jtable/sweetalert.js"></script>

<!-- data table export  3 -->
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatablesexport/js/buttons.print.min.js"></script>


<!-- FastClick -->
<script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/template/dist/js/demo.js"></script>
<script>
var base_url= "<?php echo base_url();?>";
$(document).ready(function () {
   
    var year = (new Date).getFullYear();
  //  datagrafico(base_url,year);

    $("#year").on("change",function(){
        var yearselect = $(this).val();
		datagrafico(base_url,yearselect);
       // datagrafico(base_url,yearselect);
    });
    
    $(".btn-remove").on("click", function(e){
            e.preventDefault();
            var ruta = $(this).attr("href");
            //alert(ruta);
            $.ajax({
                url: ruta,
                type:"POST",
                success:function(resp){
                    //http://localhost/ventas_ci/mantenimiento/productos
                    window.location.href = base_url + resp;
                }
            });
        });
        
    $(".btn-remove-gri").on("click", function(){
        var remover=$(this).val(); 
        var opcion = confirm("Esta Por eliminar registros !! Aceptar o Cancelar");
    if (opcion == true) {
                        $.ajax({
                        url: remover,
                        type:"POST",
                    });
                    location.reload();
        } else {
            location.reload();
        }
    });

	$(".btn-remove-notas").on("click", function(){
        var remover=$(this).val(); 
        var opcion = confirm("Esta todas las notas del registros !! Aceptar o Cancelar");
    if (opcion == true) {
                        $.ajax({
                        url: remover,
                        type:"POST",
                    });
                    location.reload();
        } else {
            location.reload();
        }
    });

//// CARGAR HORA 

$('.time-picker1').timepicker({
            showMeridian: false     
        });

$('.time-picker2').timepicker({
            showMeridian: false     
        });
//// FIN HORA

// ALGUNAS VISTAS ANTERIORES 

      $(".btn-view-usuario").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "administrador/usuarios/view",
            type:"POST",
            data:{idusuario:id},
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });

 // TABLAS DENTRO DE LOS MANTENIMIENTOS 
    $('#example').DataTable( {
       dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }

    } );

	$('#example1').DataTable({
       responsive: true,
		//scrollY:        500,
   		deferRender:    true,
    	scroller:       true,
		"language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('#example2').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('#example3').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('#example4').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('#example5').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('#example6').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

 $('.sidebar-menu').tree();

// 
	/// seleccionar apertura de cursos en la grilla prematricula
    $(document).on("click",".btn-curaperturados",function(){
        curaperturado = $(this).val();
        infocuraperturado = curaperturado.split("*");
        $("#idapertura").val(infocuraperturado[0]);
        $("#informacion").val(infocuraperturado[1]+" - "+infocuraperturado[0]+ " :::: GRUPO : "+infocuraperturado[2]);
        $("#modal-curaperturado").modal("hide");
    });

	/// seleccionar curso con deudas de alumnos
    $(document).on("click",".btn-curdeuda",function(){
        curaperturado = $(this).val();
        infocuraperturado = curaperturado.split("*");
        $("#idapertura").val(infocuraperturado[0]);
        $("#informacion").val(infocuraperturado[0]+" - "+infocuraperturado[1]);
        $("#modal-curdeuda").modal("hide");
    });




//// FORMULARIO APERTURAS
        /// seleccionar el curso en el formulario APERTURA 
         $(document).on("click",".btn-cursoape",function(){
                curso = $(this).val();
                infocurso = curso.split("*");
                $("#idcurso").val(infocurso[0]);
                $("#curso").val(infocurso[1]);
                $("#costo").val(infocurso[2]);
                $("#modal-curso").modal("hide");
        });
        /// seleccionar el grupo en el formulario APERTURA
        $(document).on("click",".btn-grupoape",function(){
            grupo = $(this).val();
            infogrupo = grupo.split("*");
            $("#idgrupo").val(infogrupo[0]);
            $("#grupo").val(infogrupo[1]+" "+infogrupo[2]+" "+infogrupo[3]);
            $("#modal-grupo").modal("hide");
        });


//// FORMULARIO PREMATRICULAS
    /// seleccionar el estudiates en el formulario prematricula 
        $(document).on("click",".btn-estupre",function(){
            estudiante = $(this).val();
            infoestudiante = estudiante.split("*");
            $("#idestudiante").val(infoestudiante[0]);
          //  $("#num_documento").val(infoestudiante[1]);
            $("#estudiante").val(infoestudiante[1]);
            $("#modal-estudiante").modal("hide");
        });
    /// BUSCAR ESTUDIANTE
    $("#btn-buscarestu").on("click", function(event) {             
         if($("#dni").val()) {
            var uno = $("#dni").val();
          // alert(uno);
            $.ajax({
                  url: base_url + "movimientos/Prematriculas/buscarestud",
                  method: "POST",
                  data:{dni:uno},
                  dataType: "json"
                })
                .done(function(result) {
                // console.log(result);
                    $("#idestudiante").val(result.id);
                    $("#estudiante").val(result.nombre);
                 })
               .fail(function(jqXHR, textStatus, errorThrown) {
                    });
                 }else{
                     alert("Ingrese DNI/RUC del Estudiante");
                }
    });
    /// seleccionar el nivel academico en el formulario prematricula 
        $(document).on("click",".btn-nivelpre",function(){
            nivel = $(this).val();
            infonivel = nivel.split("*");
            $("#idnivel").val(infonivel[0]);
            $("#nivel").val(infonivel[1]+" "+infonivel[2]);
            $("#porcentaje").val(infonivel[2]);
            $("#modal-nivel").modal("hide");
        });

    /// seleccionar apertura de cursos en formulario prematricula
        $(document).on("click",".btn-apertura",function(){
            apertura = $(this).val();
            infoapertura = apertura.split("*");
            $("#idapertura").val(infoapertura[0]);
            $("#apertura").val(infoapertura[1]+" - "+infoapertura[0]+" :::: GRUPO : "+infoapertura[2]+" :::: HORARIO : "+infoapertura[3]+" A "+infoapertura[4]);
            $("#costo").val(infoapertura[5]);
            $("#curso").val(infoapertura[6]);
            $("#modal-apertura").modal("hide");
        });

    /// calcular el pago del alumno por curso
        $("#btn-calcular-pago").on("click",function(){
            
            data = $("#costo").val()+ "*"+$("#porcentaje").val()+ "*"+$("#descuento").val();
            if ($("#costo").val() !='' &&  $("#porcentaje").val() !='' && $("#descuento").val() !='') {
                data = $("#costo").val()+ "*"+$("#porcentaje").val()+"*"+$("#descuento").val();
                infopre = data.split("*");
                montopre = (infopre[0]-(infopre[0]*infopre[1]))-infopre[2];
                $("#monto").val(parseInt(montopre));
            }else{
                alert("Ingrese datos para poder calcular...");
            }
        });

    /// remover prematricuallas
        $(document).on("click",".btn-remove-prema", function(){
            conpre= conpre -1;
            $("#conpre").val(conpre);
            $(this).closest("tr").remove();

            //$("#conpre").val(conpre);
        // sumar();
        });
        
//FORMULRIO PAGOS 
            /// DATOS DEL ALUMNO FORMULARIO PAGOS
            $(document).on("click",".btn-pagos",function(){
                    grupo = $(this).val();
                    infogrupo = grupo.split("*");
                    $("#idprematricula").val(infogrupo[0]);
                    $("#dniestudiante").val(infogrupo[1]);
                    $("#estudiante").val(infogrupo[2]);
                    $("#curso").val(infogrupo[3]+" - "+infogrupo[4]);
                    $("#deuda").val(infogrupo[5]);
                    $("#descripcion").val("CTITPT");
                    $("#modal-prematricula").modal("hide");
                });
            //AGREGA PAGOS A LA TABLA DEL FORMULARIO DE PAGOS
                $("#btn-agregar-pago").on("click",function(){
                    var con=0;
                        if ($("#descripcion").val() !='' &&  $("#monto").val() !='' &&  $("#codigo").val() !='' &&  $("#fecha_pago").val() !='') {
                        data =$("#idprematricula").val()+"*"+$("#dniestudiante").val()+"*"+$("#estudiante").val()+"*"+$("#descripcion").val()+ "*"+$("#monto").val()+ "*"+$("#codigo").val()+ "*"+$("#fecha_pago").val()+ "*"+$("#deuda").val();
                        infopago = data.split("*");
                        con=con+1;
                        html = "<tr>";
                        html += "<td><input type='hidden' class='form-control' name='idpre[]' value='"+infopago[0]+"'><input type='text' size='5%' readonly style='text-align:right' class='form-control' name='dni[]' value='"+infopago[1]+"'></td>";    
                        html += "<td><input type='hidden' class='form-control' name='deudas[]' value='"+infopago[7]+"'><input type='text' size='30%' readonly class='form-control' name='estudiante[]' value='"+infopago[2]+"'></td>";
                        html += "<td><input type='text' size='5%' style='text-align:right' class='form-control' name='descripcionpago[]' value='"+infopago[3]+"'></td>";
                        html += "<td><input type='text' size='5%' style='text-align:right' class='form-control' name='montopago[]' value='"+infopago[4]+"'></td>";
                        html += "<td><input type='text' size='5%' style='text-align:right' class='form-control' name='codigopago[]' value='"+infopago[5]+"'></td>";
                        html += "<td><input type='date' size='10%' style='color:red;text-align:right' class='form-control' name='fechapago[]' value='"+infopago[6]+"'></td>";
                        html += "<td><button type='button' class='btn btn-danger btn-remove-pago'><span class='fa fa-remove'></span></button></td>";
                        html += "</tr>";
                        $("#tbpagos tbody").append(html);
                    //   sumar();
                    $("#contador").val(con);
                        $("#idprematricula").val(null);
                        $("#dniestudiante").val(null);
                        $("#estudiante").val(null);
                        $("#curso").val(null);
                        $("#deuda").val(null);
                        $("#descripcion").val(null);
                        $("#monto").val(null);
                        $("#codigo").val(null);
                        $("#fecha_pago").val(null);
                    }else{
                        alert("Ingrese datos del Boucher...");
                    }
                });
                /// remober pago 
                $(document).on("click",".btn-remove-pago", function(){
                    $(this).closest("tr").remove();
                    sumar();
                });
 //FORMULRIO PAGOS VARIOS
            /// DATOS DEL ALUMNO FORMULARIO PAGOS
            $(document).on("click",".btn-pagoestudiante",function(){
                    grupo = $(this).val();
                    infogrupo = grupo.split("*");
                    $("#idestudiante").val(infogrupo[0]);
                    $("#dniestudiante").val(infogrupo[1]);
                    $("#estudiante").val(infogrupo[2]);
                    $("#descripcion").val("CTITPT");
                    $("#modal-estudiante").modal("hide");
                });
            /// DATOS DEL CONCEPTO
            $(document).on("click",".btn-concepto",function(){
                    grupo = $(this).val();
                    infogrupo = grupo.split("*");
                    $("#idconcepto").val(infogrupo[0]);
                    $("#concepto").val(infogrupo[1]);
                    $("#modal-concepto").modal("hide");
                });

            //AGREGA PAGOS A LA TABLA DEL FORMULARIO DE PAGOS
                $("#btn-agregar-otropago").on("click",function(){
                    var con=0;
                        if ($("#concepto").val() !='' && $("#descripcion").val() !='' &&  $("#monto").val() !='' &&  $("#codigo").val() !='' &&  $("#fecha_pago").val() !='') {
                        data =$("#idestudiante").val()+"*"+$("#dniestudiante").val()+"*"+$("#estudiante").val()+"*"+$("#idconcepto").val()+"*"+$("#concepto").val()+"*"+$("#descripcion").val()+ "*"+$("#monto").val()+ "*"+$("#codigo").val()+ "*"+$("#fecha_pago").val();
                        infopago = data.split("*");
                        con=con+1;
                        html = "<tr>";
                        html += "<td><input type='hidden' class='form-control' name='idestudiante[]' value='"+infopago[0]+"'><input type='text' size='5%' readonly style='text-align:right' class='form-control' name='dni[]' value='"+infopago[1]+"'></td>";    
                        html += "<td><input type='text' size='30%' readonly class='form-control' name='estudiante[]' value='"+infopago[2]+"'></td>";
                        html += "<td><input type='hidden' class='form-control' name='idconcepto[]' value='"+infopago[3]+"'><input type='text' size='5%' readonly style='text-align:right' class='form-control' name='concepto[]' value='"+infopago[4]+"'></td>";
                        html += "<td><input type='text' size='5%' style='text-align:right' class='form-control' name='descripcionpago[]' value='"+infopago[5]+"'></td>";
                        html += "<td><input type='text' size='5%' style='text-align:right' class='form-control' name='montopago[]' value='"+infopago[6]+"'></td>";
                        html += "<td><input type='text' size='5%' style='text-align:right' class='form-control' name='codigopago[]' value='"+infopago[7]+"'></td>";
                        html += "<td><input type='date' size='10%' style='color:red;text-align:right' class='form-control' name='fechapago[]' value='"+infopago[8]+"'></td>";
                        html += "<td><button type='button' class='btn btn-danger btn-remove-otropago'><span class='fa fa-remove'></span></button></td>";
                        html += "</tr>";
                        $("#tbpagos tbody").append(html);
                    //   sumar();
                    $("#contador").val(con);
                        $("#idestudiante").val(null);
                        $("#dniestudiante").val(null);
                        $("#estudiante").val(null);
                        $("#idconcepto").val(null);
                        $("#concepto").val(null);
                        $("#descripcion").val(null);
                        $("#monto").val(null);
                        $("#codigo").val(null);
                        $("#fecha_pago").val(null);
                    }else{
                        alert("Ingrese datos todos los datos...");
                    }
                });
                /// remober pago 
                $(document).on("click",".btn-remove-otropago", function(){
                    $(this).closest("tr").remove();
                    sumar();
                });

//// INICIAR CURSO - MATRICULAR ALUMNOS
        /// seleccionar apertura de cursos en formulario iniciar curso
                $(document).on("click",".btn-inicurso",function(){
                apertura = $(this).val();
                infoapertura = apertura.split("*");
                $("#idapertura").val(infoapertura[0]);
                $("#apertura").val(infoapertura[1]+" - "+infoapertura[0]+" :::: GRUPO : "+infoapertura[2]+" :::: HORARIO : "+infoapertura[3]+" A "+infoapertura[4]);
                $("#modal-inicurso").modal("hide");
            });
        ///// seleccionar  datos del docente
        $(document).on("click",".btn-docente",function(){
                docente = $(this).val();
                infodocente = docente.split("*");
                $("#iddocente").val(infodocente[0]);
                $("#docente").val(infodocente[1]);
                $("#modal-docente").modal("hide");
            });
        ///// seleccionar aula 
        $(document).on("click",".btn-aula",function(){
                aula = $(this).val();
                infoaula = aula.split("*");
                $("#idaula").val(infoaula[0]);
                $("#aula").val(infoaula[1]);
                $("#modal-aula").modal("hide");
            });
        //// consultar el docente del curso aperturado 
             $("#btn-consultar").on("click", function(event) {             
                if($("#idapertura").val()) {
                var uno = $("#idapertura").val();
                //alert(uno);
                    $.ajax({
                            url: base_url + "matriculas/Matriculas/buscar",
                            method: "POST",
                            data:{idapertura:uno},
                            dataType: "json"
                    })
                        .done(function(result) {
                        // console.log(result);
                            $("#iddocente").val(result.docente_id);
                            $("#docente").val(result.docente);
                            $("#idaula").val(result.aula_id);
                            $("#aula").val(result.aula);
                            $("#fecha_ini").val(result.fecha_ini);
                            $("#fecha_fin").val(result.fecha_fin);
                    
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                        });
                }else{
                        alert("Ingrese datos del curso");
                    }
            });

        //// consultar el docente del curso aperturado en el menu modificado
            $("#btn-consultarmod").on("click", function(event) {
                if($("#idapertura").val()) {
                var uno = $("#idapertura").val();
                //alert(uno);
                    $.ajax({
                            url: base_url + "matriculas/Matriculas/buscarmod",
                            method: "POST",
                            data:{idapertura:uno},
                            dataType: "json"
                    })
                        .done(function(result) {
                        // console.log(result);
                            $("#iddocente").val(result.docente_id);
                            $("#docente").val(result.docente);
                            $("#idaula").val(result.aula_id);
                            $("#aula").val(result.aula);
                            $("#fecha_ini").val(result.fecha_ini);
                            $("#fecha_fin").val(result.fecha_fin);
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                        });

                }else{
                        alert("Ingrese datos del curso");
                    }
            });

            // matricular alumnos 

            $("#btn-agregar-alumno").on("click", function(event) {
                    
                    if($("#idapertura").val()) {
                    var uno = $("#idapertura").val();
                        $.ajax({
                                url: base_url + "matriculas/Matriculas/buscaralumno",
                                method: "POST",
                                data:{idapertura:uno},
                                dataType: "json"
                        })
                            .done(function(result) {
                            console.log(result);
                            table.clear().draw();
                            table.rows.add(result).draw();
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                            // needs to implement if it fails
                            });

                    }else{
                            alert("Ingrese todos los datos del formulario");
                        }
                });
            /// tabla de alumnos agregados
            let table = $("#table_id").DataTable({
                columns: [
                    { data: "dni" },
                    { data: "nombre" },
                    // { data: "apellido" },
                    { data: "id",
                        render: function (data_id) { 
                            return `<input type='hidden' name='idprematricula[]' value='${data_id}'  ><button  type='button'  class='prematriculas btn btn-danger btn-remove-alupre'><span class='fa fa-remove'></span></button>`;
                    }}
                ],
                rowCallback: function(row, data) {},
                filter: true,
                info: true,
                ordering: true,
                processing: true,
                retrieve: true,
                paging:   false,
            });

     /// remover modulos
            $(document).on("click",".btn-remove-alupre", function(){
                $(this).closest("tr").remove();
            // sumar();
            });

//// FORMULARIO NOTAS

    $(document).on("click",".btn-matri-notas",function(){
        notas = $(this).val();
        infomatrinotas = notas.split("*");
        $("#idapertura").val(infomatrinotas[0]);
        $("#apertura").val(infomatrinotas[1]+" - "+infomatrinotas[0]);
        $("#idgrupo").val(infomatrinotas[2]);
        $("#grupo").val(infomatrinotas[3]);
        $("#hora_ini").val(infomatrinotas[4]);
        $("#hora_fin").val(infomatrinotas[5]);
        $("#fecha_ini").val(infomatrinotas[6]);
        $("#fecha_fin").val(infomatrinotas[7]);
        $("#iddocente").val(infomatrinotas[8]);
        $("#docente").val(infomatrinotas[9]);
        $("#idaula").val(infomatrinotas[10]);
        $("#aula").val(infomatrinotas[11]);
		$("#idcurso").val(infomatrinotas[12]);
        $("#modal-matri-notas").modal("hide");
    });

    /// cargar notas  add notas
    $("#btn-agregar-notas").on("click", function(event) {
         if($("#idapertura").val() !='' && $("#idcurso").val() !='') {
         var uno = $("#idapertura").val();
		 var dos = $("#idcurso").val();
               $.ajax({
                     url: base_url + "matriculas/notas/buscaralumno",
                     method: "POST",
                   //  data:{idcurso:uno,idgrupo:dos,fecha_ini:tres,fecha_fin:cuatro,iddocente:cinco,idaula:seis},
				   data:{idapertura:uno,idcurso:dos},
                     dataType: "json"
               })
                 .done(function(result) {
                  // console.log(result);
                   $('#modules_len').val(result.modulos.leng);
                   $('#modules_ids').val(JSON.stringify(result.modulos.modulodata));
                   tablenotas.clear().draw();
                   tablenotas.rows.add(result.alumnos).draw();
                 })
                 .fail(function(jqXHR, textStatus, errorThrown) {
                   // needs to implement if it fails
                 });

         }else{
                 alert("Ingrese todos los datos del formulario");
             }
     });

     /// cargar notas  add notas en las modicficaciones
    $("#btn-agregar-notasmod").on("click", function(event) {
         if($("#idapertura").val() !='' && $("#idcurso").val() !='') {
         var uno = $("#idapertura").val();
		 var dos = $("#idcurso").val();
               $.ajax({
                     url: base_url + "matriculas/notas/buscaralumnomod",
                     method: "POST",
                   //  data:{idcurso:uno,idgrupo:dos,fecha_ini:tres,fecha_fin:cuatro,iddocente:cinco,idaula:seis},
				   data:{idapertura:uno,idcurso:dos},
                     dataType: "json"
               })
                 .done(function(result) {
                  // console.log(result);
                   $('#modules_len').val(result.modulos.leng);
                   $('#modules_ids').val(JSON.stringify(result.modulos.modulodata));
                   tablenotas.clear().draw();
                   tablenotas.rows.add(result.alumnos).draw();
                 })
                 .fail(function(jqXHR, textStatus, errorThrown) {
                   // needs to implement if it fails
                 });

         }else{
                 alert("Ingrese todos los datos del formulario");
             }
     });

    /// vista de agregar notas 
		let tablenotas = $("#table_notas").DataTable({
          columns: [
              { data: "dni" },
              { data: "nombre" },
            //  { data: "apellido" },
              { data: "idpre",
                 render: function (data_idpre) { 
                     //console.log("modules tamano", $('#modules_len').val());
                     let monleng=$('#modules_len').val();
                     let mod_ids=JSON.parse($('#modules_ids').val());
                     let stringinput = '';
                    let srtConcat = '';
					let title_m = '';
					let hola = 1;
                     for (let mod of mod_ids){
						//console.log("TCL: mod_ids", mod.id);
					//	$('#modules_ids').data('mod_id')
                        stringinput=`<input type='hidden' name='idprematricula[]' value='${data_idpre}'>
									 <input type='hidden' name='idmodulo[]' value='${mod.id}'>
									<input id='${mod.id}' title='${mod.nombre}' name='nota[${data_idpre}][${mod.id}]' value='' data-mod_id='${mod.id}' style='width:42px;border:1px solid gray; border-radius:4px; margin-right: 3px' type='number' min='0' max='20' />`; 
						let coma = ''
						if(title_m != ''){
							coma = ',';
						}
						title_m = `${title_m}${coma} ${mod.abreviatura}`;
						$('#title_mods').text(title_m);
						srtConcat=srtConcat + stringinput;
						hola=hola+1;
                     }

                    // for(var i=0;i<monleng;i++){
                    //  };
                     return srtConcat;
			}, width: 300},
		
		   ],
		   	columnDefs: [
           		 { "width": "20%", "targets": 0 }
			],

          rowCallback: function(row, data) {},
          filter: true,
          info: true,
          ordering: true,
          processing: true,
          retrieve: true,
          paging:   false,
		});

/// FORMULARIO CERTIFICADOS   /////
/// seleccionar el estudiates en el formulario prematricula 
 $(document).on("click",".btn-aludura",function(){
        alumno = $(this).val();
        infoalumno = alumno.split("*");
        $("#idprematricula").val(infoalumno[0]);
        $("#alumno").val(infoalumno[2]);
        $("#curso").val(infoalumno[3]);
        $("#fecha_ini").val(infoalumno[4]);
        $("#fecha_fin").val(infoalumno[5]);
        $("#modal-alumnos").modal("hide");
    });
//var cuenfo=Integer.parseInt("1");
var cuenfo=1;
// agregar certificado  
$("#btn-agregar-certificado").on("click",function(){
            if ($("#idprematricula").val() !='' &&  $("#alumno").val() !='' &&  $("#fecha_ini").val() !='' &&   $("#fecha_fin").val() !='' && $("#curso").val() !='' &&  $("#folio").val() !='' &&  $("#correlativo").val() !='' &&  $("#fecha").val() !='') {
            data = $("#idprematricula").val()+"*"+$("#alumno").val()+"*"+$("#fecha_ini").val()+"*"+$("#fecha_fin").val()+ "*"+$("#curso").val()+ "*"+$("#folio").val()+ "*"+$("#correlativo").val()+ "*"+$("#fecha").val()+ "*"+$("#cara").val();
            infocertificado = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' class='form-control' name='idprematriculal[]' value='"+infocertificado[0]+"'><input type='text' class='form-control' name='alumnol[]' readonly value='"+infocertificado[1]+"'></td>";
            html += "<td><input type='text' class='form-control' name='cursol[]' readonly value='"+infocertificado[4]+"'></td>";
            html += "<td><input type='date' class='form-control' name='fecha_ini[]'  value='"+infocertificado[2]+"'></td>";
            html += "<td><input type='date' class='form-control' name='fecha_fin[]'  value='"+infocertificado[3]+"'></td>";
            html += "<td><input type='text' class='form-control' name='foliol[]' value='"+infocertificado[5]+"'></td>";
            html += "<td><input type='text' class='form-control' name='correlativol[]' value='"+infocertificado[6]+"'></td>";
            html += "<td><input type='date' class='form-control' name='fechal[]' value='"+infocertificado[7]+"'></td>";
            html += "<td><input type='text' class='form-control' name='img[]' value='"+infocertificado[8]+"'></td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-certificado'><span class='fa fa-remove'></span></button></td>";
            html += "</tr>";
            $("#tbcertificado tbody").append(html);
            $("#idprematricula").val(null);
            $("#alumno").val(null);
            $("#curso").val(null);
            $("#fecha_ini").val(null);
            $("#fecha_fin").val(null);
            $("#folio").val(infocertificado[5]);
            cuenfo =1 + parseInt(infocertificado[6]);
            $("#correlativo").val(cuenfo);
            $("#fecha").val(infocertificado[7]);
            $("#cara").val(infocertificado[8]);
            $("#oculto").val(infocertificado[0]);
        }else{
            alert("Ingrese datos del datos para generar el certificado...");
            $("#idprematricula").val(null);
            $("#alumno").val(null);
            $("#curso").val(null);
            $("#fecha_ini").val(null);
            $("#fecha_fin").val(null);
            $("#folio").val(null);
            $("#correlativo").val(null);
            $("#fecha").val(null);
        }
    });
/// remober datos del certificados 
$(document).on("click",".btn-remove-certificado", function(){
        $(this).closest("tr").remove();
       // sumar();
    });

//// FORMULARIO DUPLICADO 

$(document).on("click",".btn-certificado",function(){
        alumno = $(this).val();
        infoalumno = alumno.split("*");
        $("#idprematricula").val(infoalumno[0]);
        $("#alumno").val(infoalumno[1]);
        $("#curso").val(infoalumno[2]);
        $("#folio").val(infoalumno[3]);
        $("#correlativo").val(infoalumno[4]);
        $("#modal-duplicados").modal("hide");
    });

$("#btn-agregar-duplicado").on("click",function(){
               if ($("#idprematricula").val() !='' &&  $("#alumno").val() !='' &&  $("#curso").val() !='' &&  $("#folio").val() !='' &&  $("#correlativo").val() !='' &&  $("#fecha").val() !='') {
            data = $("#idprematricula").val()+"*"+$("#alumno").val()+ "*"+$("#curso").val()+ "*"+$("#folio").val()+ "*"+$("#correlativo").val()+ "*"+$("#fecha").val();
            infocertificado = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' class='form-control' name='id[]' value='"+infocertificado[0]+"'><input type='text' class='form-control' name='' readonly value='"+infocertificado[1]+"'></td>";
            html += "<td><input type='text' class='form-control' name='' readonly value='"+infocertificado[2]+"'></td>";
            html += "<td><input type='text' class='form-control' name='' readonly value='"+infocertificado[3]+"'></td>";
            html += "<td><input type='text' class='form-control' name='' readonly value='"+infocertificado[4]+"'></td>";
            html += "<td><input type='date' class='form-control' name='fechad[]' value='"+infocertificado[5]+"'></td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-certificado'><span class='fa fa-remove'></span></button></td>";
            html += "</tr>";
            $("#tbduplicado tbody").append(html);
            $("#idprematricula").val(null);
            $("#alumno").val(null);
            $("#curso").val(null);
            $("#folio").val(null);
            $("#correlativo").val(null);
            $("#fecha").val(null);
            $("#oculto").val(infocertificado[0]);
        }else{
            alert("Ingrese datos del datos para generar el certificado Duplicado...");
        }
    });


///IMPRIMIR LISTAS DEL SISTEMA
/// imprimir lista de alumnos matriculados
    $(document).on("click",".btn-print",function(){
        $("#modal-matriculados .modal-body").print({

            title:"Lista de Alumnos Matriculados"
        });
    });
/// imprimir acta de notas
    $(document).on("click",".btn-print-notas",function(){
        $("#modal-notas .modal-body").print({
            title:"REGISTRO DE NOTAS"
        });
    });
})


///// APIIII   DNI RENIEC Y SUNAT
$("#btn-consultar-dni").on("click", function(event) {
         //console.log("ggfg");
        switch ($("#tipodocumento").val()) {
            case "1":
                if($("#dni").val().length == 8){
                    let documento = $("#dni").val();
                    $.ajax({
                            url: base_url + "registrar/estudiantes/getDNI",
                            method: "POST",
                            data:{documento},
                            dataType: "json"
                    })
                        .done(function(result) {
                        let name = result.data;
                        name = name.split("|");
                        name = `${name[0]} ${name[1]} ${name[2]}`;
                        $("#nombre").val(name);
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                        });
                    }else{
                        alert("Ingrese el número del DNI");
                    }
            break;
            case "2":
                if($("#dni").val().length == 11){
                    let documento = $("#dni").val();
                    $.ajax({
                            url: base_url + "registrar/estudiantes/getRUC",
                            method: "POST",
                            data:{documento},
                            dataType: "json"
                    })
                        .done(function(result) {
                            $("#nombre").val(result.razonSocial);
                            $("#direccion").val(result.direccion);
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                        });
                    }else{
                        alert("Ingrese el número del RUC");
                    }
                break;
            default:
                break;
        }
     
	 });

///// GRAFICAS Y REPORTES GRAFICOS DE INGRESOS

function datagrafico(base_url,year){
    namesMonth=["ENE", "FEB", "MAR", "ABR", "MAY", "JUN","JUL", "AGO", "SEP", "OCT", "NOV", "DIC"];
    $.ajax({
            url: base_url + "dashboard/getData",
            type:"POST",
            data:{year: year},
            dataType:"json",
            success:function(data){
                var meses = new Array();
                var montos = new Array();
                $.each(data,function(key, value){
                    meses.push(namesMonth[value.mes -1]);
                    valor = Number(value.monto);
                    montos.push(valor);
                });
                graficar(meses,montos,year);
            }
    });
}

function graficar(meses,montos,year){
    Highcharts.chart('grafico', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Ingresos Acumulado por Meses'
    },
    subtitle: {
        text: 'Año: ' + year
    },
    xAxis: {
        categories: meses,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado (soles)'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} soles</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }
            }
        }
    },
    series: [{
        name: 'Meses',
        data: montos
    }]
});
}

</script>
</body>
</html>
