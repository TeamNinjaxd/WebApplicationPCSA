<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Proveedores
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Proveedores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedores">

          Agregar Proveedores
        
        </button>       

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            
            <tr>

              <th style="width:10px">#</th>
              <th>RUC</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Celular</th>
              <th>Direccion</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

               <?php
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, 'https://km29vlujn4.execute-api.us-east-2.amazonaws.com/api/proveedores/v0');
                $token = "TokenID: ".$_SESSION["token"]; 
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));
                $result = curl_exec($ch);
                curl_close($ch);
                $arrayObj = json_decode($result);
                $arrayData = $arrayObj->data;
                $proveedoresArray = $arrayData->proveedores;
                $i=0;
                foreach ($proveedoresArray as $key => $value){
                echo '
                  <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$value->RUC.'</td>
                    <td>'.$value->nombre.'</td>
                    <td>'.$value->correo.'</td>
                    <td>'.$value->celular.'</td>
                    <td>'.$value->direccion.'</td>
                    <td><button class="btn btn-success btn-xs">Activado</button></td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarProveedor" idProveedor="'.$value->RUC.'" data-toggle="modal" data-target="#modalEditarProveedor"><i class="fa fa-pencil"></i></button>

                        <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>
                    
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
MODAL AGREGAR PROVEEDOR
======================================-->


<div id="modalAgregarProveedores" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data" >
     
      <div class="modal-header" style="background: #3c8dbc; color: white">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">Agregar Proveedores</h4>
      
      </div>
      
      <div class="modal-body">
                  
          <div class="box-body">
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombreProveedor" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoRUCProveedor" placeholder="Ingresar DNI" required>

              </div>

            </div>  


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoCorreoProveedor" placeholder="Ingresar correo" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefonoProveedor" placeholder="Ingresar telefono" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDireccionProveedor" placeholder="Ingresar direccion" required>

              </div>

            </div>

          </div>
      
      </div>
      
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Agregar Proveedor</button>
      
      </div>

      <?php

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearProveedor();

      ?>

    </form>
    
    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->


<div id="modalEditarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data" >
     
      <div class="modal-header" style="background: #3c8dbc; color: white">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">Editar Proveedores</h4>
      
      </div>
      
      <div class="modal-body">
                  
          <div class="box-body">
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="EditarNombreProveedor" value="" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="EditarRUCProveedor" value="" required>

              </div>

            </div>  


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="EditarCorreoProveedor" value="" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="EditarTelefonoProveedor" value="" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="EditarDireccionProveedor" value="" required>

              </div>

            </div>

          </div>
      
      </div>
      
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Modificar Proveedor</button>
      
      </div>

      

    </form>
    
    </div>

  </div>

</div>
