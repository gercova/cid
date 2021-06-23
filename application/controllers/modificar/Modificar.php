<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modificar extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->permisos = $this->backend_lib->control();/* crear para permisos de modulos  */
		$this->load->model("Prematriculas_model");
		$this->load->model("Estudiantes_model");
		$this->load->model("Aperturas_model");
		$this->load->model("Niveles_model");
		$this->load->model("Matriculas_model");
		$this->load->model("Modificar_model");
		$this->load->model('View_model');
	}

	public function index(){
		$data  = [
			'permisos' => $this->permisos,
			'curaperturados' => $this->Modificar_model->getAperturadosmod();
		];

		$this->View_model->render_view('admin/prematriculas/listmjt', $data, 'content/c_modificar');
	}
	
	public function lista(){
		$starIndex = $_GET['jtStartIndex'];
		$pageSize  = $_GET['jtPageSize'];
		
		if(isset($_POST['loquita'])){
			$buscar = (isset($_POST['loquita']) ? $_POST['loquita']: '' );
			$grilla = 'listexp';
		}else{    
			$buscar = (isset($_POST['search']) ? $_POST['search']: '' );
			$grilla	= 'listo';
		}

		$libro 								= $this->Modificar_model->$grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] 			= 'OK';
		$jTableResult['Records'] 			= $libro[0];
		$jTableResult['TotalRecordCount'] 	= $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function excel(){	 
		header('Content-Disposition: attachment; filename=ListaPrematriclados.xls');
		header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
		if(!isset($_GET['idapertura'])){
			$buscar = '';
			$grilla = 'Excel';
		}else{    
			$buscar = $_GET['idapertura'];
			$grilla = 'Excelbus';
		}
		$libro = $this->Modificar_model->$grilla($buscar);

		echo "<table >
			<thead>
				<tr>
					<th>#</th>
					<th>CODIGO</th>
					<th>DNI</th>
					<th>ESTUDIANTE</th>
					<th>CELULAR</th>
					<th>CURSO</th>
					<th>GRUPO</th>
					<th>HORA INICIO</th>
					<th>HORA FIN</th>
				</tr>
			</thead>
			<tbody>";
			$num=1;
			if (!empty($libro)) : 
				foreach ($libro as $libros) :
					echo "<tr>";
						echo "<td>". $num."</td>";
						echo "<td>". $libros->id."</td>";
						echo "<td>". $libros->num_documento."</td>";
						echo "<td>".utf8_decode($libros->estudiante)."</td>";
						echo "<td>". $libros->celular."</td>";
						echo "<td>". $libros->codigo."</td>";
						echo "<td>". utf8_decode($libros->curso)."</td>";
						echo "<td>". utf8_decode($libros->grupo)."</td>";
						echo "<td>". $libros->hora_ini."</td>";
						echo "<td>". $libros->hora_fin."</td>";
					echo "</tr>";
					$num=$num+1;
						 endforeach;
					 endif; 
				echo "</tbody>
			</table>
		";
	}	
}