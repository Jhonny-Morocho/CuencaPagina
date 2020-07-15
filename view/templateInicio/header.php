<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design for Bootstrap</title>
  <!-- MDB icon -->
  <base href="appMTD/AppMaterial/">
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/style.css?v=1">
  <!-- =================== APP==================== -->
  <link rel="stylesheet" href="../css/estilos.css?v=1">

</head>
<body>

<!--Main Navigation-->
<header>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
        <!-- <a class="navbar-brand" href="#"><strong>Navbar</strong></a> -->
        <img src="../../img/logoLatinEdit.png" alt=""  width="10%">
        <!-- <img src="..." alt="..." class="img-thumbnail"> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ulNavegacion">
                
                <li class="nav-item active">
                    <a class="nav-link" href="../../">INICIO <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown multi-level-dropdown remixerDropdown">
                    <a href="#" id="menu" data-toggle="dropdown" class="nav-link dropdown-toggle text-uppercase">REMIXERS</a>
                    <ul class="dropdown-menu mt-2 rounded-0 special-color-dark darken-4 border-0 z-depth-1 ">
                        <?php
                            //include'model/mdlCliente.php';
                            $proveedor=ModeloProveedor::sql_lisartar_proveedor();
                            foreach ($proveedor as $key => $value) {
                            echo '<li class="dropdown-item dropdown-submenu p-0 "><a href="#"  class="text-white w-100">'.$value['apodo'].' </a></li>';
                            }
                        ?>
                    </ul>
                </li>

    

                <li class="nav-item">
                    <a class="nav-link" href="#">MEMBRESIAS</a>
                </li>
                <li class="nav-item">

                <?php 
                    if(isset($_SESSION['usuario'])){// si no existe session presentar esto admin_cliente
                        
                        switch (@$_SESSION['tipo_usuario']) {
                            case 'cliente':
                                    echo ' <a class="nav-link active contenedorCarrito" href="../../adminCliente.php">'.$_SESSION['usuario'].'</a>';
                                break;
                        }
                        
                    }else{
                        echo'<a class="nav-link" href="#" data-toggle="modal" data-target="#modalLRForm" >CUENTA</a> ';
                    }
                    ?>
                    <!-- <a class="nav-link" href="#" data-toggle="modal" data-target="#modalLRForm" >CUENTA</a> -->
                </li>
                <li class="nav-item">
                    <div class="contenedorCarrito">
                      <a class="nav-link" href="../../car.php"  ><span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>  CARRITO <span class="cart-notification">0</span> </a>
                    </div>
                    
                </li>
            </ul>
        </div>
    </nav>

</header>
