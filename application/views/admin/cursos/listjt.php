
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
        <form id="form_cursos"> 
            <div class="modal-body" >
              <div class="form-group">
                <input type="hidden" id="id" name="id" value="">
                <label for="descripcion" class="labelfor">Nombre del Curso:</label>
                <input class="grandes" type="text" name="descripcion" id="descripcion" autocomplete="off" required>
              </div>
              <div class="form-group row">
                  <div class="col-lg-5">
                      <label for="costo" class="labelfor">Costo:</label>
                      <input class="grandes" type="text" name="costo" id="costo" pattern="^[0-9]+([,][0-9]+)?$" autocomplete="off" required>
                  </div>
                  <div class="col-lg-7">
                    <label for="silabus" class="labelfor">Silabus:</label>
                    <input class="grandes" type="file" name="silabus" id="silabus" required>
                  </div>
              </div>
              <div class="form-group row">
                  <div class="col-lg-4">
                      <label for="ciclos">Ciclo:</label>
                      <select name="ciclos" id="ciclos" class="form-control" required>
                          <option value=""> SELECCIONE</option>
                          <?php foreach($ciclos as $ciclo):?> 
                          <option value="<?php echo $ciclo->id;?>"> <?php echo $ciclo->descripcion;?></option>
                          <?php endforeach;?>
                      </select>
                  </div>
                  <div class="col-lg-4">
                      <label for="niveles">Nivel:</label>
                      <select name="niveles" id="niveles" class="form-control" required>
                          <option value=""> SELECCIONE</option>
                          <?php foreach($niveles as $nivel):?> 
                          <option value="<?php echo $nivel->id;?>"> <?php echo $nivel->descripcion;?></option>
                          <?php endforeach;?>
                      </select>
                  </div>
                  <div class="col-lg-4">
                      <label for="web">Montar en Web:</label>
                      <select name="web" id="web" class="form-control" required>
                          <option value=""> SELECCIONE</option>
                          <option value="0">NO MOSTRAR</option>
                          <option value="1">MOSTRAR</option>
                      </select>
                  </div>
              </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-success" value="Guardar" />
                <!-- <button type="button" id="btnGuardar" >Guardar</button> -->
            </div>
        </form>    
        </div>
    </div>
</div>  
