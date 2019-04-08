<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Clientes Individuales
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Clientes Individuales</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarClienteIndividual">

          Agregar Cliente Indivual
        
        </button>       

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            
            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>DNI</th>
              <th>email</th>
              <th>telefono</th>
              <th>situacion</th>
              <th>Confirmacion</th>

            </tr>

          </thead>

          <tbody>

               <?php
                $datos=array("ruta"=>$_GET["ruta"]);
                $json=json_encode($datos);

                $ch = curl_init('https://km29vlujn4.execute-api.us-east-2.amazonaws.com/api/users/v0/clientes/');
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                
                
                

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

               

                $token = "TokenID: ".$_SESSION["token"];
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));
                $result = curl_exec($ch);
                curl_close($ch);
                $arrayObj = json_decode($result);
                echo var_dump($arrayObj);
                echo var_dump($datos);
                $arrayData = $arrayObj->data;
                $clientesiArray = $arrayData->clientes;
                $i=0;
                foreach ($clientesiArray as $key => $value){
                  echo '
                    <tr>
                      <td>'.($i+1).'</td>
                      <td>'.$clientesiArray[$i]->name.'</td>
                      <td>'.$clientesiArray[$i]->Username.'</td>
                      <td>'.$clientesiArray[$i]->email.'</td>
                      <td>'.$clientesiArray[$i]->phone_number.'</td>
                      <td>'.$clientesiArray[$i]->Enabled.'</td>
                      <td>'.$clientesiArray[$i]->UserStatus.'</td>
                      
                    </tr>
                  ';
                  $i=$i+1;
                }
                              
                ?>
          
          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE INDIVIDUAL
======================================-->


<div id="modalAgregarClienteIndividual" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data" >
     
      <div class="modal-header" style="background: #3c8dbc; color: white">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">Agregar Cliente Individual</h4>
      
      </div>
      
      <div class="modal-body">
                  
          <div class="box-body">
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombreClienteIndividual" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoApellidoClienteIndividual" placeholder="Ingresar Apellido" required>

              </div>

            </div>


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDNIClienteIndividual" placeholder="Ingresar DNI" required>

              </div>

            </div>  


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoCorreoClienteIndividual" placeholder="Ingresar correo" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefonoClienteIndividual" placeholder="Ingresar telefono" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDireccionClienteIndividual" placeholder="Ingresar direccion" required>

              </div>

            </div>

          </div>
      
      </div>
      
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Agregar Cliente</button>
      
      </div>

      <?php

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearClienteIndividual();

      ?>

    </form>
    
    </div>

  </div>

</div>
