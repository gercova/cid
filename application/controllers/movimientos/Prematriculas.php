<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Prematriculas extends CI_Controller{

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
		$this->load->model('View_model');
	}

	public function index(){
		$data  = [
			'permisos' => $this->permisos, /* crear para permisos de modulos  */
			'curaperturados' => $this->Prematriculas_model->getAperturados(),
		];

		$this->View_model->render_view('admin/prematriculas/listjt', $data, 'content/c_prematriculas');
	}

	public function lista(){
		$starIndex = $_GET['jtStartIndex'];
		$pageSize = $_GET['jtPageSize'];
		
		if(isset($_POST['loquita'])){
			$buscar = (isset($_POST['loquita']) ? $_POST['loquita']: '' );
			$grilla='listexp';
		}else{    
			$buscar = (isset($_POST['search']) ? $_POST['search']: '' );
			$grilla='listo';
		}

		$libro = $this->Prematriculas_model->$grilla($starIndex, $pageSize, $buscar);
		$jTableResult['Result'] = 'OK';
		$jTableResult['Records'] = $libro[0];
		$jTableResult['TotalRecordCount'] = $libro[1];
		header('Content-Type: application/json');
		echo json_encode($jTableResult);
	}

	public function add(){
		$data = [
			"estudiantes" => $this->Estudiantes_model->getEstudiantes(),
			"niveles" => $this->Niveles_model->getNiveles(),
			'aperturas' => $this->Prematriculas_model->getAperturas(),
		];

		$this->View_model->render_view('admin/prematriculas/add', $data, $content_data = null);
	}
	
	public function buscarestud(){
		$dni = $this->input->post("dni");
		$this->Prematriculas_model->buscarestu($dni);
	}

	public function addm(){
		$data = [
			"estudiantes" => $this->Estudiantes_model->getEstudiantes(),
			"niveles" => $this->Niveles_model->getNiveles(),
			'aperturas' => $this->Prematriculas_model->getAperturass(),
		];

		$this->View_model->render_view('admin/prematriculas/addm', $data, $content_data = null);
	}


	public function store(){
		$idusuario 		= $this->session->userdata("id");
		$idestudiante 	= $this->input->post("idestudiante");
		$idnivel 		= $this->input->post("idnivel");
		$idapertura 	= $this->input->post("idapertura");
		$costo 			= $this->input->post("costo");
		$descuento 		= $this->input->post("descuento");
		$descripcion 	= $this->input->post("descripcion");
		$monto 			= $this->input->post("monto");
		$estado 		= "1";
		$nota 			= "0";
		$estudiante 	= $this->input->post("estudiante");
		$apertura 		= $this->input->post("apertura");

		$curso 			= $this->Aperturas_model->getapertura($idapertura);
		$idcurso 		= $curso->curso_id;
		$nomcurso 		= $curso->curso;

		$data['usuario_id'] 	= $this->session->userdata("id");
		$data['estudiante_id'] 	= $this->input->post("idestudiante");
		$data['apertura_id'] 	= $this->input->post("idapertura");
		$data['nivel_id'] 		= $this->input->post("idnivel");
		$data['costo'] 			= $this->input->post("costo");
		$data['descuento'] 		= $this->input->post("descuento");
		$data['descripcion'] 	= $this->input->post("descripcion");
		$data['monto'] 			= $this->input->post("monto");
		$data['deuda'] 			= $this->input->post("monto");
		$data['fecha_registro'] = date('Y-m-d');
		$data['pagado'] 		= 
		$data['matriculado'] 	= 
		$data['estado'] 		= 
            
		if($this->Prematriculas_model->getPrematri($idestudiante, $idcurso,  $estado, $nota)) {
			$this->session->set_flashdata("error", "El Estudiante ".$estudiante." ya esta Prematriculado en el Curso ".$nomcurso);
			redirect(base_url('movimientos/prematriculas/add'));
		};
		
		if($monto == 0){
			$pago = "1";
		}else{
			$pago = "0";
		};
			
		$data  = array(
			'usuario_id' => $idusuario,
			'estudiante_id' => $idestudiante,
			'apertura_id' => $idapertura,
			'nivel_id' => $idnivel,
			'costo' => $costo,
			'descuento' => $descuento,
			'descripcion' => $descripcion,
			'monto' => $monto,
			'deuda' => $monto,
			'fecha_registro' => date('Y-m-d'),
			'pagado' => $pago,
			'matriculado' => "0",
			'estado' => $estado,
		);

		if($this->Prematriculas_model->save($data)) {
			redirect(base_url('movimientos/prematriculas'));
		}else{
			$this->session->set_flashdata("error", "No se pudo guardar la informacion");
			redirect(base_url('movimientos/prematriculas/add'));
		}
	}

	public function edit($id){
		$data  = array(
			"estudiantes" => $this->Estudiantes_model->getEstudiantes($id),
			"niveles" => $this->Niveles_model->getNiveles($id),
			'prematricula' => $this->Prematriculas_model->getPrematricula($id),
			'aperturas' => $this->Prematriculas_model->getAperturas(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/prematriculas/edit", $data);
		$this->load->view("layouts/footer");
	}

	public function editm($id){
		$data  = array(
			"estudiantes" => $this->Estudiantes_model->getEstudiantes($id),
			"niveles" => $this->Niveles_model->getNiveles($id),
			'prematricula' => $this->Prematriculas_model->getPrematricula($id),
			'aperturas' => $this->Prematriculas_model->getAperturasm(),
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/prematriculas/edit", $data);
		$this->load->view("layouts/footer");
	}

	public function update(){   
		$idprematricula = $this->input->post("idprematricula");
		$idusuario = $this->session->userdata("id");
		$idapertura = $this->input->post("idapertura");
		$idnivel = $this->input->post("idnivel");
		$costo = $this->input->post("costo");
		$descuento = $this->input->post("descuento");
		$descripcion = $this->input->post("descripcion");
		$monto = $this->input->post("monto");
		$this->form_validation->set_rules("estudiante", "Estudiante de la Prematricula", "required");
		$this->form_validation->set_rules("nivel", "Nivel de la Prematricula", "required");
		$this->form_validation->set_rules("apertura", "Apertura de la Prematricula", "required");
		$this->form_validation->set_rules("costo", "Costo de la Prematricula", "required");
		$this->form_validation->set_rules("descuento", "Descuento de la Prematricula", "required");
		$this->form_validation->set_rules("monto", "Monto a Pagar de la Prematricula", "required");
		
		if($monto==0){
		$pago="1";
		}else{
			$pago="0";
		};

		if ($this->form_validation->run() == TRUE) {

			$data  = array(
				'apertura_id' => $idapertura,
				'nivel_id' => $idnivel,
				'costo' => $costo,
				'descuento' => $descuento,
				'descripcion' => $descripcion,
				'monto' => $monto,
				'deuda' => $monto,
				'pagado' => $pago,
				'fecha_mod' => date('Y-m-d'),
				'usuario_mod' => $idusuario,
				'estado' => '1',
			);
			if ($this->Prematriculas_model->update($idprematricula, $data)) {
				redirect(base_url() . "movimientos/prematriculas");
			} else {
				$this->session->set_flashdata("error", "No se pudo Actualizar la informacion");
				redirect(base_url() . "movimientos/prematriculas/edit/" . $idprematricula);
			}
		} else {
			/*redirect(base_url()."mantenimiento/Niveles/add");*/
			$this->edit($idprematricula);
		}
	}

	public function view($id){
		// echo $this->upload->display_errors();die;
		$data  = array(
			'prematricula' => $this->Prematriculas_model->getPrever($id),

		);
		// exit($data);
		$this->load->view("admin/prematriculas/view", $data);
	}

	public function delete($id){
		$data  = array(
			'estado' => "0",
		);
		$this->Prematriculas_model->update($id, $data);
		echo json_encode(['sucess' => true]);
	}


/** modificaciones */

public function storem()
{
	$idusuario = $this->session->userdata("id");
		$idestudiante = $this->input->post("idestudiante");
		$idnivel = $this->input->post("idnivel");
		$idapertura = $this->input->post("idapertura");
		$costo = $this->input->post("costo");
		$descuento = $this->input->post("descuento");
		$descripcion = $this->input->post("descripcion");
		$monto = $this->input->post("monto");
		$estado = "1";
		$estudiante = $this->input->post("estudiante");
		$apertura = $this->input->post("apertura");
		$this->form_validation->set_rules("estudiante", "Estudiante de la Prematricula", "required");
		$this->form_validation->set_rules("nivel", "Nivel de la Prematricula", "required");
		$this->form_validation->set_rules("apertura", "Apertura de la Prematricula", "required");
		//	$this->form_validation->set_rules("grupo", "Gupo de la Prematricula", "required");
		$this->form_validation->set_rules("costo", "Costo de la Prematricula", "required");
		$this->form_validation->set_rules("descuento", "Descuento de la Prematricula", "required");
		$this->form_validation->set_rules("monto", "Monto a Pagar de la Prematricula", "required");


		if ($this->form_validation->run() == TRUE) {
			$curso = $this->Aperturas_model->getapertura($idapertura);
			$idcurso = $curso->curso_id;
			$nomcurso = $curso->curso;
			//exit(json_encode($curso));
			if ($this->Prematriculas_model->getPrematri($idestudiante, $idcurso,  $estado)) {
				$this->session->set_flashdata("error", "El Estudiante " . $estudiante . " ya esta Prematriculado en el Curso " . $nomcurso);
				redirect(base_url() . "movimientos/prematriculas/addm");
			}
			if($costo== $descuento){
				$pago="1";
			 }else{
				$pago="0";
			 };
	
			$data  = array(
				'usuario_id' => $idusuario,
				'estudiante_id' => $idestudiante,
				'apertura_id' => $idapertura,
				'nivel_id' => $idnivel,
				'costo' => $costo,
				'descuento' => $descuento,
				'descripcion' => $descripcion,
				'monto' => $monto,
				'deuda' => $monto,
				'fecha_registro' => date('Y-m-d'),
				'pagado' => $pago,
				'matriculado' => "0",
				'estado' => $estado,
			);

			if($this->Prematriculas_model->save($data)){
				redirect(base_url('modificar/Modificar'));
			}else{
				$this->session->set_flashdata("error", "No se pudo guardar la informacion");
				redirect(base_url('movimientos/prematriculas/addm'));
			}
		}else{
			$this->add();
		}
	}

	public function excel(){	 
		header('Content-Disposition: attachment; filename=prematriculas.xls');
		header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
		if(empty($_GET['idapertura'])){
			$buscar = '';
			$grilla='Excel';
		}else{    
			$buscar = $_GET['idapertura'];
			$grilla='Excelbus';
		}
		$libro = $this->Prematriculas_model->$grilla($buscar);
		echo "<table >
			<thead>
				<tr>
					<th>#</th>
					<th>CODIGO</th>
					<th>DNI</th>
					<th>ESTUDIANTE</th>
					<th>CELULAR</th>
					<th>EMAIL</th>
					<th>C�0�7DIGO</th>
					<th>CURSO</th>
					<th>GRUPO</th>
					<th>HORA INICIO</th>
					<th>HORA FIN</th>
					<th>COSTO</th>
					<th>DEUDA</th>
				</tr>
			</thead>
			<tbody>";
			$num=1;
			if(!empty($libro)) : 
				foreach ($libro as $libros) :
					echo "<tr>";
						echo "<td>". $num."</td>";
						echo "<td>". $libros->id."</td>";
						echo "<td>". $libros->num_documento."</td>";
						echo "<td>".utf8_decode($libros->estudiante)."</td>";
						echo "<td>". $libros->celular."</td>";
						echo "<td>". $libros->email."</td>";
						echo "<td>". $libros->codigo."</td>";
						echo "<td>". utf8_decode($libros->curso)."</td>";
						echo "<td>". utf8_decode($libros->grupo)."</td>";
						echo "<td>". $libros->hora_ini."</td>";
						echo "<td>". $libros->hora_fin."</td>";
						echo "<td>". $libros->monto."</td>";
						echo "<td>". $libros->deuda."</td>";
						
					echo "</tr>";
					$num=$num+1;
				endforeach;
			endif; 
			echo "</tbody>
		</table>";
	}	
}