<?php

class AjaxUsuarios{

	public $idProveedor;

	public function ajaxEditarProveedor(){

		$valor = $this->idProveedor;

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $link = 'https://km29vlujn4.execute-api.us-east-2.amazonaws.com/api/proveedores/v0/'.$valor;
                curl_setopt($ch, CURLOPT_URL, $link);
                $token = "TokenID: ".$_SESSION["token"]; 
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));
                $result = curl_exec($ch);
                curl_close($ch);

                echo $result;

	}

}

if(isset($_POST["idProveedor"])){

	$editar = new AjaxUsuarios();
	$editar -> idProveedor = $_POST["idProveedor"];
	$editar -> ajaxEditarProveedor();

}


?>