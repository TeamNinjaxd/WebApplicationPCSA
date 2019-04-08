<?php 
//error_reporting(0);

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	public function ctrIngreso(){

		if(isset($_POST["ingUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				$datos = array("username"=> $_POST["ingUsuario"],	
				               "password"=> $_POST["ingPassword"],
								);

				$url = 'https://uuz4zciyz3.execute-api.us-east-2.amazonaws.com/v0/login';
				//create a new cURL resource
				$ch = curl_init($url);
				//setup request to send json via POST
				$payload = json_encode($datos);
				//Indicamos que nuestra petición sera Post
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);				 
				//Adjuntamos el json a nuestra petición
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
				//Agregamos los encabezados del contenido
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
				//Ejecutamos la petición
				$result = curl_exec($ch);

				curl_close($ch);

				$obj = json_decode($result);
				$resultado = $obj->AuthenticationResult;
				$token = $resultado->IdToken;

				if($resultado!= NULL){

					$_SESSION["iniciarSesion"] = "ok";
					$_SESSION["tipo"] = $_POST["tipo"];
					$_SESSION["token"] = $token;

					echo '<script>

						window.location = "inicio";

					</script>';
					
				}else{

					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

				}

			}	

		}

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	public function ctrCrearClienteIndividual(){

		if(isset($_POST["nuevoDNIClienteIndividual"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreClienteIndividual"]) &&
			   preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidoClienteIndividual"]) &&
			   preg_match('/^[0-9]{8}$/', $_POST["nuevoDNIClienteIndividual"]) && 
			   preg_match('/^[a-zA-Z0-9@.]+$/',$_POST["nuevoCorreoClienteIndividual"]) &&
			   preg_match('/^[9]{1}[0-9]{8}$/',$_POST["nuevoTelefonoClienteIndividual"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/',$_POST["nuevoDireccionClienteIndividual"])){

				$datos = array("username"=> $_POST["nuevoDNIClienteIndividual"],	
				               "direccion"=> $_POST["nuevoDireccionClienteIndividual"],
				               "correo"=> $_POST["nuevoCorreoClienteIndividual"],
				               "apellidos"=> $_POST["nuevoApellidoClienteIndividual"],
				               "nombre"=> $_POST["nuevoNombreClienteIndividual"],
				               "celular"=> $_POST["nuevoTelefonoClienteIndividual"]
				           );

				$url = 'https://uuz4zciyz3.execute-api.us-east-2.amazonaws.com/v0/clientes/persona/registrar';
				//create a new cURL resource
				$ch = curl_init($url);
				//setup request to send json via POST
				$payload = json_encode(array("data" => $datos));
				//Indicamos que nuestra petición sera Post
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);				 
				//Adjuntamos el json a nuestra petición
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
				//Agregamos los encabezados del contenido
				$token = "TokenID: ".$_SESSION["token"]; 
				//Agregamos los encabezados del contenido
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));	
				//Ejecutamos la petición
				$result = curl_exec($ch);

				curl_close($ch);

				$obj = json_decode($result);


				$respuesta = $obj->data;
				$respuesta1 = $obj->response;

				if( $respuesta1->estado == 'ok'){
					echo '<script>

					swal({

						type: "success",
						title: "El usuario ha sido guardado correctamente; la contraseña es '.$respuesta->password.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuariosindividual";

						}

					});

				</script>';

				}

				if( $respuesta1->estado == 'error'){
					echo '<script>

					swal({

						type: "error",
						title: "¡El usuario ya se encuentra registrado",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuariosindividual";

						}

					});

					</script>';
				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡Datos Invalidos Ingresados!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuariosindividual";

						}

					});

				</script>';

			}

		}

	}


	public function ctrCrearClienteEmpresa(){

		if(isset($_POST["nuevoRUCClienteEmpresa"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreClienteEmpresa"]) &&
			   preg_match('/^[0-9]{11}$/', $_POST["nuevoRUCClienteEmpresa"]) && 
			   preg_match('/^[a-zA-Z0-9@.]+$/',$_POST["nuevoCorreoClienteEmpresa"]) &&
			   preg_match('/^[9]{1}[0-9]{8}$/',$_POST["nuevoTelefonoClienteEmpresa"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/',$_POST["nuevoDireccionClienteEmpresa"])){

				$datos = array("username"=> $_POST["nuevoRUCClienteEmpresa"],	
				               "direccion"=> $_POST["nuevoDireccionClienteEmpresa"],
				               "correo"=> $_POST["nuevoCorreoClienteEmpresa"],
				               "nombre"=> $_POST["nuevoNombreClienteEmpresa"],
				               "celular"=> $_POST["nuevoTelefonoClienteEmpresa"]
				           );

				$url = 'https://uuz4zciyz3.execute-api.us-east-2.amazonaws.com/v0/clientes/persona/registrar';
				//create a new cURL resource
				$ch = curl_init($url);
				//setup request to send json via POST
				$payload = json_encode(array("data" => $datos));
				//Indicamos que nuestra petición sera Post
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);				 
				//Adjuntamos el json a nuestra petición
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
				//Agregamos los encabezados del contenido
				$token = "TokenID: ".$_SESSION["token"]; 
				//Agregamos los encabezados del contenido
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));	
				//Ejecutamos la petición
				$result = curl_exec($ch);

				curl_close($ch);

				$obj = json_decode($result);


				$respuesta = $obj->data;
				$respuesta1 = $obj->response;

				if( $respuesta1->estado == 'ok'){
					echo '<script>

					swal({

						type: "success",
						title: "El usuario ha sido guardado correctamente; la contraseña es '.$respuesta->password.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuariosempresa";

						}

					});

				</script>';

				}

				if( $respuesta1->estado == 'error'){
					echo '<script>

					swal({

						type: "error",
						title: "¡El usuario ya se encuentra registrado",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuariosempresa";

						}

					});

					</script>';
				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡Datos Invalidos Ingresados!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuariosempresa";

						}

					});

				</script>';

			}
		}

	}

	public function ctrCrearProveedor(){

		if(isset($_POST["nuevoRUCProveedor"])){

			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreProveedor"]) &&
			   preg_match('/^[0-9]{11}$/', $_POST["nuevoRUCProveedor"]) && 
			   preg_match('/^[a-zA-Z0-9@.]+$/',$_POST["nuevoCorreoProveedor"]) &&
			   preg_match('/^[9]{1}[0-9]{8}$/',$_POST["nuevoTelefonoProveedor"]) &&
			   preg_match('/^[a-zA-Z0-9 ]+$/',$_POST["nuevoDireccionProveedor"])){

				$datos = array("RUC"=> $_POST["nuevoRUCProveedor"],
							   "correo"=> $_POST["nuevoCorreoProveedor"],	
				               "direccion"=> $_POST["nuevoDireccionProveedor"],		   
				               "nombre"=> $_POST["nuevoNombreProveedor"],
				               "celular"=> $_POST["nuevoTelefonoProveedor"]
				           );

				$url = 'https://km29vlujn4.execute-api.us-east-2.amazonaws.com/api/proveedores/v0';
				//create a new cURL resource
				$ch = curl_init($url);
				//setup request to send json via POST
				$payload = json_encode(array("data" => $datos));
				//Indicamos que nuestra petición sera Post
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);				 
				//Adjuntamos el json a nuestra petición
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
				$token = "TokenID: ".$_SESSION["token"]; 
				//Agregamos los encabezados del contenido
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));
				//Ejecutamos la petición		
				$result = curl_exec($ch);

				curl_close($ch);

				$obj = json_decode($result);

				$respuesta = $obj->response;

				if( $respuesta== 'ok'){
					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente'.$obj->data.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuariosproveedor";

						}

					});

				</script>';

				}

				if( $respuesta == 'error'){
					echo '<script>

					swal({

						type: "error",
						title: "¡El usuario ya se encuentra registrado",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuariosproveedor";

						}

					});

					</script>';
				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacio o llevar caracteres especiales",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "usuariosproveedor";

						}

					});

				</script>';

			}

		}

	}

	
	public function ctrCrearProducto(){

		if(isset($_POST["nuevoCodigo"] ) ) {
						
			if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProducto"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoCodigo"]) && 
			   preg_match('/^[a-zA-Z0-9 ]+$/',$_POST["nuevoDescripcion"]) &&
			   preg_match('/^[a-zA-Z]+$/',$_POST["nuevoMarca"]) &&
			   preg_match('/^[a-zA-Z]+$/', $_POST["nuevoProveedor"]) && 
			   preg_match('/^[a-zA-Z]+$/', $_POST["nuevoCategoria"]) && 
			   preg_match('/^[0-9]+$/', $_POST["nuevoCantidad"]) && 
			   preg_match('/^[0-9]+$/',$_POST["nuevoPrecioCompra"]) ){

				$datos = array("codigo"=> $_POST["nuevoCodigo"],
							   "descripcion"=> $_POST["nuevoDescripcion"],	
				               "foto"=> "#",		   
				               "marca"=> $_POST["nuevoMarca"],	
				               "proveedor"=> $_POST["nuevoProveedor"],
				               "categoria"=> $_POST["nuevoCategoria"],	
				               "nombre"=> $_POST["nuevoProducto"],	
				               "cantidad"=> $_POST["nuevoCantidad"],
				               "precio_compra"=> $_POST["nuevoPrecioCompra"]
				           );

				$url = 'https://km29vlujn4.execute-api.us-east-2.amazonaws.com/api/productos/v0';
				//create a new cURL resource
				$ch = curl_init($url);
				//setup request to send json via POST
				$payload = json_encode(array("data" => $datos));
				//Indicamos que nuestra petición sera Post
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);				 
				//Adjuntamos el json a nuestra petición
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
				$token = "TokenID: ".$_SESSION["token"]; 
				//Agregamos los encabezados del contenido
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));
				//Ejecutamos la petición				
				$result = curl_exec($ch);
				curl_close($ch);

				$obj = json_decode($result);

				$respuesta = $obj->response;

				if( $respuesta== 'ok'){
					echo '<script>

					swal({

						type: "success",
						title: "¡El producto se registro correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "productos";

						}

					});

				</script>';

				}

				if( $respuesta == 'error'){
					echo '<script>

					swal({

						type: "error",
						title: "¡El producto ya se encuentra registrado",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "productos";

						}

					});

					</script>';
				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El producto no se registro por datos invalidos",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "productos";

						}

					});

				</script>';

			}
			
		
		}
	
	}


	public function ctrPrecioVenta(){

		if(isset($_POST["precioVenta"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["codigoProducto"]) &&
			   preg_match('/^[0-9]+$/', $_POST["precioVenta"]) && 
			   preg_match('/^[0-9]+$/',$_POST["precioCompra"])){

				$datos = array("codigo"=> $_POST["codigoProducto"],
							   "precio_compra"=> $_POST["precioCompra"],	
				               "precio_venta"=> $_POST["precioVenta"]		   
				           );

				$url = 'https://km29vlujn4.execute-api.us-east-2.amazonaws.com/api/productos/v0';
				//create a new cURL resource
				$ch = curl_init($url);
				//setup request to send json via POST
				$payload = json_encode(array("data" => $datos));
				//Indicamos que nuestra petición sera Post

				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH"); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);				 
				//Adjuntamos el json a nuestra petición
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
				//Agregamos los encabezados del contenido

				$token = "TokenID: ".$_SESSION["token"];
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));
				//Ejecutamos la petición
				$result = curl_exec($ch);

				curl_close($ch);

				$obj = json_decode($result);

				$respuesta = $obj->response;


				//if( $respuesta== 'ok'){
					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente'.$obj->data.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "precioVenta";

						}

					});

				</script>';

				//}

				if( $respuesta == 'error'){
					echo '<script>

					swal({

						type: "error",
						title: "¡El usuario ya se encuentra registrado",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "precioVenta";

						}

					});

					</script>';
				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El usuario no puede ir vacio o llevar caracteres especiales",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "precioVenta";

						}

					});

				</script>';

			}

		}

	}

	public function ctrIntroducirCompra(){

		if(isset($_POST["numFactura"] ) ) {
						
			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["numFactura"]) &&
			   preg_match('/^[0-9]+$/', $_POST["proveedor"]) && 
			   preg_match('/^[0-9\/]+$/',$_POST["fecha"]) &&
			   preg_match('/^[a-zA-Z]+$/',$_POST["nuevoMarca"]) &&
			   preg_match('/^[a-zA-Z]+$/', $_POST["nuevoProveedor"]) && 
			   preg_match('/^[a-zA-Z]+$/', $_POST["nuevoCategoria"]) && 
			   preg_match('/^[0-9]+$/', $_POST["nuevoCantidad"]) && 
			   preg_match('/^[0-9]+$/',$_POST["nuevoPrecioCompra"]) ){

				$datos = array("codigo"=> $_POST["nuevoCodigo"],
							   "descripcion"=> $_POST["nuevoDescripcion"],	
				               "foto"=> "#",		   
				               "marca"=> $_POST["nuevoMarca"],	
				               "proveedor"=> $_POST["nuevoProveedor"],
				               "categoria"=> $_POST["nuevoCategoria"],	
				               "nombre"=> $_POST["nuevoProducto"],	
				               "cantidad"=> $_POST["nuevoCantidad"],
				               "precio_compra"=> $_POST["nuevoPrecioCompra"]
				           );

				$url = 'https://km29vlujn4.execute-api.us-east-2.amazonaws.com/api/productos/v0';
				//create a new cURL resource
				$ch = curl_init($url);
				//setup request to send json via POST
				$payload = json_encode(array("data" => $datos));
				//Indicamos que nuestra petición sera Post
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);				 
				//Adjuntamos el json a nuestra petición
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
				$token = "TokenID: ".$_SESSION["token"]; 
				//Agregamos los encabezados del contenido
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));
				//Ejecutamos la petición				
				$result = curl_exec($ch);
				curl_close($ch);

				$obj = json_decode($result);

				$respuesta = $obj->response;

				if( $respuesta== 'ok'){
					echo '<script>

					swal({

						type: "success",
						title: "¡El producto se registro correctamente",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "productos";

						}

					});

				</script>';

				}

				if( $respuesta == 'error'){
					echo '<script>

					swal({

						type: "error",
						title: "¡El producto ya se encuentra registrado",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "productos";

						}

					});

					</script>';
				}

			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡El producto no se registro por datos invalidos",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "productos";

						}

					});

				</script>';

			}
			
		
		}
	
	}

	public function ctrRegistroCompra(){

		if(isset($_FILES["nuevoArchivo"]["tmp_name"])){

			$data1 = new Spreadsheet_Excel_Reader();
			$data1->setOutputEncoding('CP1251');
			$data1->read($_FILES["nuevoArchivo"]["tmp_name"]);

		$arraylistado = [];

		for ($i = 1; $i <= $data1->sheets[0]['numRows']; $i++) {
			for ($j = 1; $j <= $data1->sheets[0]['numCols']; $j++) {
				$arraylistado[]=$data1->sheets[0]['cells'][$i][$j];
			}
		}


			
					echo '<script>

					swal({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente '.$arraylistado[5].'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "compras";

						}

					});

				</script>';

				//}

				if( $respuesta == 'error'){
					echo '<script>

					swal({

						type: "error",
						title: "¡El usuario ya se encuentra registrado",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						closeOnConfirm: false

					}).then((result)=>{

						if(result.value){

							window.location = "compras";

						}

					});

					</script>';
				}


		}

	}
	

	public function ctrModificarProveedor(){

				$datos = array("RUC"=> "00345678910",
				               "celular"=> "015820221"
				           );

				$url = 'https://km29vlujn4.execute-api.us-east-2.amazonaws.com/api/proveedores/v0';
				//create a new cURL resource
				$ch = curl_init($url);
				//setup request to send json via POST
				$payload = json_encode(array("data" => $datos));
				//Indicamos que nuestra petición sera Post
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);				 
				//Adjuntamos el json a nuestra petición
				curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
				$token = "TokenID: ".$_SESSION["token"]; 
				//Agregamos los encabezados del contenido
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));
				//Ejecutamos la petición		
				$result = curl_exec($ch);

				curl_close($ch);

				
	}

	
}

