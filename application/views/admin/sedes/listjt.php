
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
        <form id="form_sedes">    
            <div class="modal-body" >
              <div class="form-group">
                <input type="hidden" id="id" name="id" value="">
                <label for="descripcion" class="labelfor">Descripción:</label>
                <input class="grandes" type="text" name="descripcion" id="descripcion" autocomplete="off" required >
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


