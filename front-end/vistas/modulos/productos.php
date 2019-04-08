<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProductos">

          Agregar Productos
        
        </button>       

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            
            <tr>

              <th style="width:10px">#</th>
              <th>Codigo</th>
              <th>Nombre</th>
              <th>Foto</th>
              <th>Descripcion</th>
              <th>Categoria</th>
              <th>Proveedor</th>
              <th>Marca</th>

            </tr>

          </thead>

          <tbody>

               <?php
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, 'https://km29vlujn4.execute-api.us-east-2.amazonaws.com/api/productos/v0');
                $token = "TokenID: ".$_SESSION["token"]; 
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json",$token));
                $result = curl_exec($ch);
                curl_close($ch);
                $arrayObj = json_decode($result);
                $arrayData = $arrayObj->data;
                $productosArray = $arrayData->productos;
                $i=0;
                foreach ($productosArray as $key => $value){
                echo '
                  <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$productosArray[$i]->Codigo.'</td>
                    <td>'.$productosArray[$i]->Nombre.'</td>
                    <td>'.$productosArray[$i]->Foto.'</td>
                    <td>'.$productosArray[$i]->Descripcion.'</td>
                    <td>'.$productosArray[$i]->Categoria.'</td>
                    <td>'.$productosArray[$i]->Proveedor.'</td>
                    <td>'.$productosArray[$i]->Marca.'</td>
                    
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
MODAL AGREGAR Productos
======================================-->


<div id="modalAgregarProductos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data" >
     
      <div class="modal-header" style="background: #3c8dbc; color: white">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">Agregar Producto</h4>
      
      </div>
      
      <div class="modal-body">
                  
          <div class="box-body">
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoProducto" placeholder="Ingresar Nombre del producto" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" required>

              </div>

            </div>


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDescripcion" placeholder="Ingresar Descripcion" required>

              </div>

            </div>  


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-star"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoMarca" placeholder="Ingresar Marca" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoProveedor" placeholder="Ingresar Proveedor" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-star"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCategoria" placeholder="Ingresar Categoria" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCantidad" placeholder="Ingresar Cantidad" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-money"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoPrecioCompra" placeholder="Ingresar Precio de Compra" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" id="nuevaFoto" name="nuevaFotoProducto">

              <p class="help-block">Peso maximo de la foto 200 MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px">

            </div>

          </div>
      
      </div>
      
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Agregar Producto</button>
      
      </div>

      <?php

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearProducto();

      ?>

    </form>
    
    </div>

  </div>

</div>
