<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Registro de Movimientos del Almacen
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Registro de Movimientos del Almacen</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalRegistrarMovimiento">

          Registrar Movimiento
        
        </button>       

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL REGISTRAR MOVIMIENTO
======================================-->


<div id="modalRegistrarMovimiento" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

    <form role="form" method="post" enctype="multipart/form-data" >
     
      <div class="modal-header" style="background: #3c8dbc; color: white">
        
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        <h4 class="modal-title">Registrar Movimiento</h4>
      
      </div>
      
      <div class="modal-body">
                  
          <div class="box-body">
            
            <div class="form-group">
              
              <div class="panel">SUBIR ARCHIVO</div>

              <input type="file" name="nuevoArchivo">

              <p class="help-block">El archivo debe ser formato xls</p>

            </div>

          </div>
      
      </div>
      
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        <button type="submit" class="btn btn-primary">Guardar Compra</button>
      
      </div>

    </form>
    
    </div>

  </div>

</div>