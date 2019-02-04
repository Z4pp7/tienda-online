<!DOCTYPE html>
<?php
  include '../../controller/con_carrito.php';
  require_once '../../model/Mod_Producto.php';

 ?>

<html lang="en" dir="ltr">
  <head>
    <?php include '../html/head.php'; ?>
    <link href="../css/sidebar-p.css" rel="stylesheet">
    <link href="../css/producto.css" rel="stylesheet">
    <link href="../css/card.css" rel="stylesheet">
  <body>

    <?php
      if(!empty($_SESSION['session'])){
        include '../html/navbar-l.php';
      }else{
        include '../html/navbar.php';
      }
     ?>
    <div class="container">
      <nav class="navbar navbar-light bg-light">
        <span class="navbar-text">
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar . . ." aria-label="Search">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Buscar</button>
          </form>
          <div>

          </div>
        </span>
      </nav>

<?php
$producto= new Mod_Producto();
//$lista=$producto->getProductos();
$categorias=$producto->getCategorias();
 ?>


      <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <ul class="list-unstyled components">
              <li>
                  <form method="post">
                    <input type="hidden" name="opcion" value="todo"/>
                    <button class="btn-sidebar btn-block" type="submit">
                    <i class="icon-s fas fa-tags"></i>Ver todo</button>
                 </form>

              </li>

              <?php
              foreach ($categorias as $cat) {
               ?>
              <li >
                <form method="post">
                   <input type="hidden" name="categoria" value="<?php echo $cat->getNombre_ca(); ?>"/>
                  <input type="hidden" name="opcion" value="filtrar"/>
                 <button class="btn-sidebar btn-block" type="submit">
                   <i class="icon-s fas fa-tag"></i><?php echo $cat->getNombre_ca(); ?>
                 </button>
               </form>
              </li>
              <?php
              }
               ?>

            </ul>
          </nav>
        <!-- Page Content -->
        <div id="content">
          <div class="row">

            <?php

            if (isset($_SESSION['listafiltrada'])) {

                $lista = unserialize($_SESSION['listafiltrada']);

                    foreach ($lista as $dato) {
            ?>

            <div class="col-4">
                <div class="card text-center" >
                   <img
                   class="card-img-top"
                   title="<?php echo $dato->getNombre_pr(); ?>"
                   src=" <?php echo  $dato->getImagen_pr(); ?>"
                   data-toggle="popover"
                   data-trigger="hover"
                   data-content="<?php echo $dato->getDescripcion_pr(); ?>"
                   >
                    <div class="card-body">
                      <h5 class="card-title">  <?php echo  $dato->getNombre_pr();  ?></h5>
                      <p class="card-text"><?php echo  $dato->getValor_unitario_pr();  ?></p>

                      <form action="" method="post">

                        <input type="hidden" name="codigo_pr" id="codigo_pr" value="<?php echo openssl_encrypt($dato->getCodigo_pr(),cod,key); ?>">
                        <input type="hidden" name="nombre_pr" id="nombre_pr" value="<?php echo openssl_encrypt($dato->getNombre_pr(),cod,key); ?>">
                        <input type="hidden" name="valor_pr" id="valor_pr"value="<?php echo openssl_encrypt($dato->getValor_unitario_pr(),cod,key);?>">
                        <input type="hidden" name="cantidad_pr" id="cantidad_pr" value="<?php echo openssl_encrypt(1,cod,key);?>">
                        <input type="hidden" name="opcion" value="agregar">
                        <button class="btn btn-secondary" type="submit">
                          Añadir al carrito
                        </button>
                      </form>

                    </div>
                  </div>
                </br>

              </div>
          <?php }
        }
        ?>
          </div>

      </div>
      </div>
    </div>
    <script>
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
    </script>
  </body>
  <?php include '../html/footer.php'; ?>
    </html>