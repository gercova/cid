<?php 
//$this->CI->session->set_userdata($data);
//print_r($this->session->userdata('showMenu'));
//exit();
$showMenus = $this->session->userdata('showMenu');

$menus = array(
                 array('id_padre'=>1,'nombre' => 'MANTENIMIENTO','icono'=> 'fa-gear',
                'links' => array( 
                        array('link'=>'mantenimiento/aulas', 'nombre'=> 'Aulas'), 
                        array('link'=>'mantenimiento/carreras', 'nombre'=> 'Carreras'), 
                        array('link'=>'mantenimiento/ciclos', 'nombre'=> 'Ciclos'), 
                        array('link'=>'mantenimiento/conceptos', 'nombre'=> 'Conceptos'), 
                        array('link'=>'mantenimiento/dias', 'nombre'=> 'Días'), 
                        array('link'=>'mantenimiento/niveles', 'nombre'=> 'Niveles'), 
                        array('link'=>'mantenimiento/sedes', 'nombre'=> 'Sedes'), 
                        array('link'=>'mantenimiento/tipos', 'nombre'=> 'Tipos')
                )),
                array('id_padre'=>2,'nombre' => 'REGISTRAR','icono'=> 'fa-edit',
                'links' => array( 
                        array('link'=>'registrar/estudiantes', 'nombre'=> 'Estudiantes'), 
                        array('link'=>'registrar/docentes', 'nombre'=> 'Docentes'), 
                        array('link'=>'registrar/cursos', 'nombre'=> 'Cursos'), 
                        array('link'=>'registrar/modulos', 'nombre'=> 'Modulos por Curso'), 
                       // array('link'=>'registrar/niveles', 'nombre'=> 'Nivel de Estudios'), 
                       // array('link'=>'registrar/grupos', 'nombre'=> 'Grupos'), 
                       // array('link'=>'registrar/aulas', 'nombre'=> 'Aulas')
                )),
                array('id_padre'=>3,'nombre' => 'PREMATRICULAS','icono'=> 'fa-male',
                'links' => array( 
                        array('link'=>'prematriculas/apertura', 'nombre'=> 'Aperturar Curso'), 
                        array('link'=>'prematriculas/prematricula', 'nombre'=> 'Registrar Prematricula')
                )),
                array('id_padre'=>4,'nombre' => 'Pagos','icono'=> 'fa-dashboard',
                'links' => array( 
                        array('link'=>'movimientos/pagos', 'nombre'=> 'Pago Estudiantes'), 
                        array('link'=>'movimientos/otros', 'nombre'=> 'Pagos Varios')
                )),
                array('id_padre'=>5,'nombre' => 'Matriculas','icono'=> 'fa-book',
                'links' => array( 
                        array('link'=>'matriculas/matriculas', 'nombre'=> 'Iniciar Curso'), 
                        array('link'=>'matriculas/notas', 'nombre'=> 'Agregar Notas')
                )),
                array('id_padre'=>6,'nombre' => 'Certificados','icono'=> 'fa-diamond',
                'links' => array( 
                        array('link'=>'matriculas/certificados', 'nombre'=> 'Emitir'), 
                        array('link'=>'matriculas/duplicados', 'nombre'=> 'Duplicado')
                )),
                array('id_padre'=>7,'nombre' => 'Reportes','icono'=> 'fa-print',
                'links' => array( 
                        array('link'=>'reportes/diarios', 'nombre'=> 'Ingresos'), 
                        array('link'=>'reportes/deudas', 'nombre'=> 'Deudores'), 
                        array('link'=>'reportes/pagogrupos', 'nombre'=> 'Pagos por Grupos')
                )),
                array('id_padre'=>8,'nombre' => 'Modificaciones','icono'=> 'fa-wrench',
                'links' => array( 
                        array('link'=>'modificar/modificar', 'nombre'=> 'Adicionales')
                )),
                array('id_padre'=>9,'nombre' => 'Administrador','icono'=> 'fa-user-circle-o',
                'links' => array( 
                        array('link'=>'administrador/usuarios', 'nombre'=> 'Usuarios'), 
                        array('link'=>'administrador/permisos', 'nombre'=> 'Permisos')
                )),
                array('id_padre'=>10,'nombre' => 'Mant. WEB','icono'=> 'fa-television',
                'links' => array( 
                        array('link'=>'web_admin/servicios', 'nombre'=> 'Servicios'), 
                        array('link'=>'web_admin/cursos', 'nombre'=> 'Cursos'), 
                        array('link'=>'web_admin/eventos', 'nombre'=> 'Eventos'), 
                        array('link'=>'web_admin/organizacion', 'nombre'=> 'Organizacion'), 
                        array('link'=>'web_admin/solicitudes', 'nombre'=> 'Solicitudes'), 
                        array('link'=>'web_admin/pagos', 'nombre'=> 'Pagos'), 
                ))
        );


?>


        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
        	<!-- sidebar: style can be found in sidebar.less -->
        	<section class="sidebar">
        		<!-- sidebar menu: : style can be found in sidebar.less -->
        		<ul class="sidebar-menu" data-widget="tree">
        			<li class="header">MODULOS DEL SISTEMA</li>
        			<li>
        				<a href="<?php echo base_url(); ?>dashboard">
        					<i class="fa fa-home"></i> <span>Inicio</span>
        				</a>
        			</li>

<?php 

foreach ($menus as $key => $value) {
        $flag_modulo = false;
        $links_modulo = array_column($value['links'], 'link');

        foreach ($showMenus as $skey => $svalue) {
                $flag_modulo = $flag_modulo | in_array($svalue, $links_modulo);
        }
        if($flag_modulo ){
?>
        <li class="treeview">
                <a href="#">
                        <i class="fa <?= $value['icono'] ?> " aria-hidden="true"></i> <span><?= $value['nombre'] ?> </span>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">

<?php           foreach ($value['links'] as $skey => $svalue) :   
                if( in_array($svalue['link'], $showMenus) ):
?>
                        <li><a href="<?= base_url($svalue['link']); ?>"><i class="fa fa-circle-o"></i> <?= $svalue['nombre']; ?> </a></li>
<?php           
                endif;
                endforeach; 
?>
                 </ul>
        </li>

<?php


        }

}
?>

                                
        		</ul>
        	</section>
        	<!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->
