<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Clientes Empresas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Clientes Empresas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarClienteEmpresa">

          Agregar Cliente Empresa
        
        </button>       

      </div>

      <div class="box-body">
        
        <table class="table table-bordered table-striped dt-responsive tablas">
          
          <thead>
            
            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>RUC</th>
              <th>Correo</th>
              <th>Telefono</th>
              <th>Direccion</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <tr>
              
              <td>1</td>
              <td>UNMSM</td>
              <td>201412546</td>
              <td>unmsm@edu.pe</td>
              <td>5820221</td>
              <td>Ciudad Universitaria</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>

                <div class="btn-group">
                    
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                </div>  

              </td>

            </tr>

            <tr>
              
              <td>2</td>
              <td>PCSA</td>
              <td>201512546</td>
              <td>pcsa@gmail.com</td>
              <td>5820221</td>
              <td>Su direccion</td>
              <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
              <td>

                <div class="btn-group">
                    
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                </div>  

              </td>

            </tr>
          
          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE EMPRESA
======================================-->


<div id="modalAgregarClienteEmpresa" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data" >
     
      <div class="modal-header" style="background: #3c8dbc; color: white">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">Agregar Cliente Empresa</h4>
      
      </div>

      <?php
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      curl_setopt($ch, CURLOPT_URL, 'https://uuz4zciyz3.execute-api.us-east-2.amazonaws.com/v0/clientes/78542210/detalle');

      $datos = array("TokenId : eyJraWQiOiIya3V5Ymw3QVVGSFByd29IV0ZJbkFLck53eGZVSHpPdWZGVmpQWDhGNm5NPSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiJkNGIxM2NkNi1hNzkzLTQ4ZDgtYTY2My1lMzg4OTY3YThmNTYiLCJjb2duaXRvOmdyb3VwcyI6WyJwcm9kdWN0b3MiXSwiZW1haWxfdmVyaWZpZWQiOnRydWUsImFkZHJlc3MiOnsiZm9ybWF0dGVkIjoiU2FuIEx1aXMifSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMi5hbWF6b25hd3MuY29tXC91cy1lYXN0LTJfMzlubWl2SWNaIiwicGhvbmVfbnVtYmVyX3ZlcmlmaWVkIjp0cnVlLCJjb2duaXRvOnVzZXJuYW1lIjoic21hc2giLCJjb2duaXRvOnJvbGVzIjpbImFybjphd3M6aWFtOjowODc2ODIzNjk4NjE6cm9sZVwvYWRtaW4tZGJsYW1iZGEiXSwiYXVkIjoibzE0NTJnZ2hma2Vha3RqYzhtcmhvaGM1aCIsImV2ZW50X2lkIjoiM2RkYzY1NzEtYmY5MC0xMWU4LThmODgtNjdlMGEwMTEzZWExIiwidG9rZW5fdXNlIjoiaWQiLCJhdXRoX3RpbWUiOjE1Mzc3NDg2ODcsIm5hbWUiOiJKZXN1cyIsInBob25lX251bWJlciI6Iis1MTkwOTA5MDkwOSIsImV4cCI6MTUzNzc1MjI4NywiaWF0IjoxNTM3NzQ4Njg3LCJmYW1pbHlfbmFtZSI6IlZpbGxhIiwiZW1haWwiOiJqZXN1cy52aWxsYUB1bm1zbS5lZHUucGUifQ.ZAENDX3QvQtTG3R1ubYc2qr3bCfG7H3RKtGlF-fNH7UVC2ddle2S2kk2Ptyq748qWNJLCE4w0Ul8-oN0GSuCSo2z8y41kpKrlyh4nFFSyexvI-5Ikq9mOPX-xkFV_dkn9zNU_IZIc_6ima8_dCWki3Q29OzDVdwV3PUrJxvjShXFpbCbCqRHeH4nzBWbyPGEXwRGAM7iE5BjI9_YdMAKUTSQ-8TjzZP_VIw4eYKngawSOY4LHxDYKrlYqmVzfqJIzfnYiL9YDcGJeLWWFtUs0nt6XYBpan8v4zndhXDmEo740YqHpnS5NVdmTcgiQDQF_cU58nVlFsyhe37ek2oj_A");

      curl_setopt($ch, CURLOPT_HTTPHEADER,$datos);

      $result = curl_exec($ch);

      curl_close($ch);



      $obj = json_decode($result);

      echo var_dump($obj);

      ?>
      
      <div class="modal-body">
                  
          <div class="box-body">
            
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombreClienteEmpresa" placeholder="Ingresar nombre de la empresa" required>

              </div>

            </div>


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoRUCClienteEmpresa" placeholder="Ingresar RUC" required>

              </div>

            </div>  


            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoCorreoClienteEmpresa" placeholder="Ingresar correo" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefonoClienteEmpresa" placeholder="Ingresar telefono" required>

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDireccionClienteEmpresa" placeholder="Ingresar direccion" required>

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
        $crearUsuario -> ctrCrearClienteEmpresa();

      ?>

    </form>
    
    </div>

  </div>

</div>
