<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diarios extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Reportes_model");
	}
	

	public function index()
	{
		//$fechainicio = $this->input->post("fechainicio");
	//	$fechafin = $this->input->post("fechafin");
		$data  = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			//'pagos' => $this->Pagos_model->getPagos(),
			//$fechainicio = $this->input->post("fechainicio"),
			//$fechafin = $this->input->post("fechafin"),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/reportes/diariosjt", $data);
		$this->load->view("layouts/footer");
		$this->load->view("content/c_reportediario");
	 }
	public function lista()
	{
		$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];
	
		if (isset($_POST['ini']) && isset($_POST['fin']) && isset($_POST['fselec'])) {
			$buscaini = (isset($_POST['ini']) ? $_POST['ini']: '' );
			$buscafin = (isset($_POST['fin']) ? $_POST['fin']: '' );
			$fechaselec = (isset($_POST['fselec']) ? $_POST['fselec']: '' );
			//$fechaselec=$tres;
			if($fechaselec==2){
				$grilla='listexpa';;
			} else{$grilla='listexp';;}
			
			//$grilla='listexp';
	  } else {    
		$buscaini = (isset($_POST['search']) ? $_POST['search']: '' );
		$buscafin = (isset($_POST['search']) ? $_POST['search']: '' );
		//$fechaselec = (isset($_POST['search']) ? $_POST['search']: '' );
		  $grilla='listo';
	  }
		$libro = $this->Reportes_model->$grilla($starIndex, $pageSize, $buscaini, $buscafin);
		$jTableResult['Result'] = 'OK';
		$jTableResult['Records'] = $libro[0];
		$jTableResult['TotalRecordCount'] = $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}


	public function excel()
	{	 
		 header('Content-Disposition: attachment; filename=reportepagos.xls');
		 header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
		//exit($_GET['ini']);
		$uno=$_GET['ini'];
		$dos=$_GET['fin'];
		$tres=$_GET['fselec'];
		
		if (empty($uno) && empty($dos)) {
			$libro = $this->Reportes_model->Excel();
		} else {   
			if($tres==2){
				$grilla='Excelbuscan';
			} else{
				$grilla='Excelbus';
				}
			$libro = $this->Reportes_model->$grilla($uno, $dos);
		}

		 echo "<table >
			<thead>
				<tr>
					<th>#</th>
					<th>CODIGO</th>
					<th>FECHA DE REGISTRO</th>
					<th>DNI</th>
					<th>ESTUDIANTE</th>
					<th>CONCEPTO</th>
					<th>MONTO</th>
					<th>CODIGO DE COMPROBANTE</th>
					<th>FECHA DE PAGO</th>
				</tr>
			</thead>
			<tbody>";
			$num=1;
			if (!empty($libro)) : 
				foreach ($libro as $libros) :
					echo "<tr>";
						echo "<td>". $num."</td>";
						echo "<td>". $libros->id."</td>";
						echo "<td>". $libros->fecha_registro."</td>";
						echo "<td>". $libros->num_documento."</td>";
						echo "<td>".utf8_decode($libros->estudiante)."</td>";
						echo "<td>". utf8_decode($libros->curso)."</td>";
						echo "<td>". $libros->monto."</td>";
						echo "<td>". $libros->codigo."</td>";
						echo "<td>". $libros->fecha_pago."</td>";
					echo "</tr>";
					$num=$num+1;
						 endforeach;
					 endif; 
				echo "</tbody>
			</table>
		";
		//return $varlo;

	}	

}
