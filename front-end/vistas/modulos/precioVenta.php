<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Precio de Venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Precio de Venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalEstablecerPrecioVenta">

          Establecer Precio de Venta
        
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
                $proveedoresArray = $arrayData->productos;
                $i=0;
                foreach ($proveedoresArray as $key => $value){
                echo '
                  <tr>
                    <td>'.($i+1).'</td>
                    <td>'.$proveedoresArray[$i]->Codigo.'</td>
                    <td>'.$proveedoresArray[$i]->Nombre.'</td>
                    <td>'.$proveedoresArray[$i]->Foto.'</td>
                    <td>'.$proveedoresArray[$i]->Marca.'</td>
                    
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
MODAL AGREGAR CLIENTE EMPRESA
======================================-->


<div id="modalEstablecerPrecioVenta" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data" >
     
      <div class="modal-header" style="background: #3c8dbc; color: white">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">Establecer Precio de Venta</h4>
      
      </div>
      
      <div class="modal-body">
                  
          <div class="box-body">
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="codigoProducto" placeholder="Ingresar el codigo del producto" required>

              </div>

            </div>


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-money"></i></span>

                <input type="text" class="form-control input-lg" name="precioCompra" placeholder="Ingresar el precio de compra" required>

              </div>

            </div>  


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-money"></i></span>

                <input type="text" class="form-control input-lg" name="precioVenta" placeholder="Ingresar el precio de venta" required>

              </div>

            </div>

          </div>
      
      </div>
      
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Establecer Precio</button>
      
      </div>

      <?php

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrPrecioVenta();

      ?>

    </form>
    
    </div>

  </div>

</div>