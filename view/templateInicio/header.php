<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta property="og:title" content="LatinEdit.com"/>
  <meta property="og:description" content="Los Mejores Remixes para Djs" /> 
  <meta property="og:image" content="../../img/perfil-facebook.png" />      
  <meta property="og:url" content="https://www.LatinEdit.com/" />
  <!-- MDB icon -->
  <base href="appMTD/AppMaterial/">
  <title>LatinEdit.com &#8211 Los Mejores Remixes para Djs</title>
  <link rel="icon" href="../../img/logo latinedit.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css?v=2.0.0">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css?v=2.0.0">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css?v=2.0.0">
  <!-- Your custom styles (optional) -->
   <link rel="stylesheet" href="css/style.css?v=2.0.0">
  <!-- =================== APP==================== -->
   <link rel="stylesheet" href="../../view/estilos/estilos.css?v=2.0.1"> 

  <!-- =====================UNDER LINE ===================== -->
   <link rel="stylesheet" href="../../text_hover/css/text_hover.css?v=2.0.0">
   <link rel="stylesheet" href="../../view/estilos/tablaSpotify.css?v=2.0.2">

  <!-- ===================================SILIDER CON IMAGNES ============================== -->
  <link rel="stylesheet" href="../../Logo-carousel/css/style.css?v=2.0.1">
  <link rel="stylesheet" href="../css/appIndex.css?v=2.0.2">
<!-- ===================================SILIDER CON IMAGNES ============================== -->
  <link rel="stylesheet" href="../../Floating-WhatsApp/floating-wpp.css">

  
  <!-- ===================================HOVER CSS ============================== -->
  <!-- <link rel="stylesheet" href="../../imagehoverCSS/css/demo-page.css"> -->
  <link rel="stylesheet" href="../../imagehoverCSS/css/imagehover.css?v=2.0.0">
  <link rel="stylesheet" href="../../imagehoverCSS/css/imagehover.min.css?v=2.0.0">


</head>
<body>

    <header>

            <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar d-flex justify-content-center">
                <div class="container">
                <!-- Brand -->

                <a class="navbar-brand waves-effect" href="../../" >
                    
                    <strong class="blue-text"><img src="../../img/logo latinedit.png" style="width: 100%;" alt="" class="animated flip "></strong>
                </a>
                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Links -->
                <div class="collapse navbar-collapse " id="navbarSupportedContent">

                    <!-- Left -->
                    <ul class="navbar-nav mr-auto ">
                        <li class="nav-item active">
                            <span class="text-hover text-hover-underline-opening"><a href="../../" style="  font-weight: 700 ;"><i class="fas fa-home"></i> HOME</a></span>
                        </li>
                            <!-- Features -->
                        <li class="nav-item dropdown mega-dropdown  active">
                                
                            <a class="nav-link dropdown-toggle text-uppercase" id="navbarDropdownMenuLink2" data-toggle="dropdown" style="  font-weight: 700 ;"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="text-hover text-hover-underline-opening"><i class="fa fa-headphones" aria-hidden="true"></i> REMIXERS</span> 
                                <span class="sr-only">(current)</span> 
                            </a>
                            <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-5 px-3 "
                                aria-labelledby="navbarDropdownMenuLink2">
                                <div class="row">
                            <?php 
                                $proveedor=ModeloProveedor::sql_lisartar_proveedor();
                                $numTotalProveedor=count($proveedor);
                                $numColumaImprimirProveedor=$numTotalProveedor/4;
                                $contProveedor=0;
                                                
                                for($i=0; $i <4; $i++){
                                    echo'<div class="col-md-6 col-xl-3 sub-menu mb-xl-0 mb-4 ">
                            
                                        <ul class="list-unstyled">';
                                    for ($j=0; $j <round($numColumaImprimirProveedor) ; $j++) { 
                                    if($contProveedor<$numTotalProveedor){
                                        
                                        echo'<li>
                                                                        <span class="text-hover text-hover-underline-opening">
                                                                            <a class="menu-item pl-0" href="../../?nameRemixer='.$proveedor[$contProveedor]['apodo'].'&remixer='.$proveedor[$contProveedor]['id'].'">
                                                <i class="fas fa-caret-right pl-1 pr-3"></i>'.$proveedor[$contProveedor]['apodo'].'
                                                                            </a>
                                                                        </span> 
                                        </li>';
                                        }
                                        $contProveedor++;
                                    }
                                        echo '	</ul>
                                        </div>';
                                }
                                ?>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <!-- <span class="text-hover text-hover-underline-opening"><a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank"><i class="fas fa-folder"></i> MEMBRESIAS </a></span> -->
                        </li>
                        <li class="nav-item">
                            <span class="text-hover text-hover-underline-opening">
                                <a href="../../latinPlus.php" style="  font-weight: 700 ;">$ RECARGAR MONEDERO</a>
                            </span>
                        </li>
                         <li class="nav-item">
                            <span class="text-hover text-hover-underline-opening">
                                <a style="  font-weight: 700 ;" href="../../membresias.php" ><i class="fa fa-folder" aria-hidden="true"></i> MEMBRESIAS</a>
                            </span>
                        </li> 
                        <!-- Dropdown -->
                        <li class="nav-item dropdown">
                            <a style="font-weight: 700;"  class="nav-link dropdown-toggle text-uppercase " id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="text-hover text-hover-underline-opening">
                                    <i class="fas fa-user"></i> MI CUENTA 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                            <?php 
                                    if(isset($_SESSION['usuario'])){// si no existe session presentar esto admin_cliente
                                        switch (@$_SESSION['tipo_usuario']) {
                                            case 'cliente':

                                                    echo '<a class="dropdown-item" href="../../adminCliente.php"">Hola: '.$_SESSION['usuario'].'</a>';
                                                break;
                                            case 'proveedor':  
                                                    echo ' <a class="dropdown-item " href="../../view/admin/index_admin.php"> Bienvenido : '.$_SESSION['usuario'].'</a>';
                                                break;
                                            case 'admin':
                                                    echo ' <div class="dropdown header-top-dropdown">
                                                                <a class="dropdown-item " href="../../view/admin/index_admin.php"> Hi  : '.$_SESSION['usuario'].'</a>
                                                                
                                                            </div> ';
                                                break;
                                        }
                                    }else{
                                        echo '<a class="dropdown-item" href="../../login.php">Login</a>
                                        <a class="dropdown-item" href="../../registro.php">Registrarme</a>';
                                    }
                                ?>
                            </div>
                        </li>
                    </ul>
                    <!-- Right -->
                    <ul class="navbar-nav nav-flex-icons">
                        <li class="nav-item">
                        <span class="text-hover text-hover-underline-opening">
                            <a href="../../car.php">
                            
                                    <span class="badge red z-depth-1 mr-1 cart-notification"> 0 </span>
                                    <i class="fas fa-shopping-cart"></i>
                            
                            </a> 
                        </span>
                        </li>
                        <li class="nav-item tabla">
                        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Flatinedit&width=225&layout=button_count&action=like&size=large&share=true&height=46&appId" width="140" height="30" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                        </li>
                    </ul>

                </div>

                </div>
            </nav>
            <!-- Navbar -->
    </header>




