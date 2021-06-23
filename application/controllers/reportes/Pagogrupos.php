<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pagogrupos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Reportes_model");
		$this->load->model("Pagogrupo_model");
		$this->load->model("Prematriculas_model");
	}

	public function index()
	{
		
		$data  = array(
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			//'pagos' => $curaperturado,
			'curaperturados' => $this->Pagogrupo_model->getalumnos(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/reportes/pagogrupos", $data);
		$this->load->view("layouts/footer");
		$this->load->view("content/c_pagogrupo");
	}

	public function lista()
	{
		$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];
		if (isset($_POST['loquita'])) {
			$buscar = (isset($_POST['loquita']) ? $_POST['loquita']: '' );
			$grilla='getpagogrupos';
	  } else {    
		  $buscar = (isset($_POST['search']) ? $_POST['search']: '' );
		  $grilla='getpagogrupo';
	  }
		$libro = $this->Pagogrupo_model->$grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] = 'OK';
		$jTableResult['Records'] = $libro[0];
		$jTableResult['TotalRecordCount'] = $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}


	public function excel()
	{	 
		 header('Content-Disposition: attachment; filename=deudores.xls');
		 header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
	//	exit($_GET['idapertura']);
		if (empty($_GET['ini'])) {
			//  $buscar = (isset($_POST['loquita']) ? $_POST['loquita']: '' );
		///	  $grilla='Excele';
			  $libro = $this->Pagogrupo_model->Excele();
		} else {    
			$buscar = $_GET['ini'];
			$grilla='Excelbuse';
			$libro = $this->Pagogrupo_model->$grilla($buscar);
		}
	//	$libro = $this->pagogrupo_model->$grilla($buscar);

		 echo "<table >
			<thead>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>DNI</th>
					<th>ESTUDIANTE</th>
					<th>DNI</th>
					<th>CELULAR</th>
					<th>APERTURA</th>
					<th>CURSO</th>
					<th>BOUCHER</th>
					<th>MONTO</th>
					<th>FECHA</th>
					
				</tr>
			</thead>
			<tbody>";
			$num=1;
			if (!empty($libro)) : 
				foreach ($libro as $libros) :
					echo "<tr>";
						echo "<td>". $num."</td>";
						echo "<td>". $libros->id."</td>";
						echo "<td>". $libros->dni."</td>";
						echo "<td>".utf8_decode($libros->estudiante)."</td>";
						echo "<td>".$libros->dni."</td>";
						echo "<td>".$libros->celular."</td>";
						echo "<td>". $libros->ape."</td>";
						echo "<td>". utf8_decode($libros->curso)."</td>";
						echo "<td> ".$libros->boucher."</td>";
						echo "<td>". $libros->monto."</td>";
						echo "<td>". $libros->fecha."</td>";
						
						echo "</tr>";
					$num=$num+1;
						 endforeach;
					 endif; 
				echo "</tbody>
			</table>
		";
		 }



	
}
