<?php

if ( ! function_exists('fechaES'))
{

	function fechaES($fecha){
		$mes = array(
			'January' => 'Enero',
			'February' => 'Febrero',
			'March' => 'Marzo',
			'April' => 'Abril',
			'May' => 'Mayo',
			'June' => 'Junio',
			'July' => 'Julio',
			'August' => 'Agosto',
			'September' => 'Septiembre',
			'October' => 'Octubre',
			'November' => 'Noviembre',
			'December' => 'Diciembre'
		);

		return strtr($fecha, $mes);
	}

}

if ( ! function_exists('validImgDefault'))
{

	function validImgDefault($value, $path, $default){
		$path_img = (is_null($value) || empty(trim($value)))? $default : $path.$value;
		$path_img_valid = str_replace(base_url(),"",$path_img);
		if (!is_file($path_img_valid)) {	
			//echo "no existe $path_img_valid ";die();
			$path_img = $default;
		}
		return $path_img;
	}

}

if ( ! function_exists('getBtnsPermited'))
{

	function getBtnsPermited($permisos, $controlador, $id){

?>
		<div class="btn-group">
			<button type="button" class="btn btn-info btn-view-info" data-toggle="modal" data-target="#modal-info" value="<?php echo $id ?>">
				<span class="fa fa-search"></span>
			</button>
			<?php if ($permisos->update == 1) : ?>
				<a href="<?php echo base_url($controlador); ?>edit/<?php echo $id; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
			<?php endif; ?>
			<?php if ($permisos->delete == 1) : ?>
				<a href="<?php echo base_url($controlador); ?>delete/<?php echo $id; ?>" class="btn btn-danger btn-remove"><span class="fa fa-remove"></span></a>
			<?php endif; ?>
		</div>
<?php

	}

}


if ( ! function_exists('msjFlashAlert'))
{

	function msjFlashAlert($session_flash_data, $type = 'error'){

		switch ($type) {
			case 'error':
				$clase = "danger";
				$icon = "ban";
				break;			
			default:
				$clase = $type;
				$icon = "check";
				break;
		}
?>
	<?php if($session_flash_data): ?>
            <div class="alert alert-<?=$clase?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-<?=$icon?>"></i><?php echo $session_flash_data; ?></p>
            </div>
    <?php endif;?>
<?php 

    }
}
