
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
	  <div id="listado">
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg-" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-color">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>           
                </button>
                <h4 class="modal-title modal-title-titulo" id="exampleModalLabel"></h4>
            </div>
        <form id="form_docentes">    
            <div class="modal-body" >

              <div class="form-group row">
                  <div class="col-lg-4">
                      <input type="hidden" id="id" name="id" value="">
                      <label for="dni" class="labelfor" > Número de Documento:</label>
                      <input type="text" class="medianos" id="dni" name="dni" autocomplete="off" required>
                      <input type="hidden" id="tipodocumento" name="tipodocumento" value="1">
                      <button id="btn-consultar-dni" type="button" class="btn btn-primary  "><span class="fa fa-search"></span> DNI </button>
                  </div>
                  <div class="col-xs-8">
                      <label for="nombre" class="labelfor">Nombre Completo:</label>
                      <input class="grandes" type="text" name="nombre" id="nombre" autocomplete="off" required>
                  </div>
              </div>        
              
              <div class="form-group row">
                  <div class="col-lg-4">
                      <label for="celular" class="labelfor">Celular:</label>
                      <input class="grandes" type="text" name="celular" id="celular" pattern="[0-9]{9,11}" autocomplete="off" required>
                  </div>
                  <div class="col-lg-8">
                    <label for="email" class="labelfor">Email:</label>
                    <input class="grandes" type="email" name="email" id="email" pattern="[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+" required>
                  </div>
              </div>
              <div class="form-group">
                <label for="adicional" class="labelfor">Datos Adicionales:</label>
                <textarea class="grandes" name="adicional" id="adicional"placeholder="Comentario ..." autocomplete="off" >
                </textarea>

              </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btnGuardar" class="btn btn-success">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  


