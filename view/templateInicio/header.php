<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>LatinEdit.com</title>
  <!-- MDB icon -->
  <base href="appMTD/AppMaterial/">
  <link rel="icon" href="../../img/logo-png-pagina.png" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css?v=1.0.0">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css?v=1.0.0">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css?v=1.0.0">
  <!-- Your custom styles (optional) -->
  <!-- <link rel="stylesheet" href="css/style.css?v=1.0.0"> -->
  <!-- =================== APP==================== -->
   <link rel="stylesheet" href="../../view/estilos/estilos.css?v=1.0.1"> 

  <meta property="og:title" content="LatinEdit.com"/>
  <meta property="og:description" content="The best of the record pool of djs" /> 
  <meta property="og:image" content="../../img/perfil-facebook.png" />      
  <meta property="og:url" content="https://www.LatinEdit.com/" />
  <!-- =====================UNDER LINE ===================== -->
   <link rel="stylesheet" href="../../underline/underline.css">
   <link rel="stylesheet" href="../../view/estilos/tablaSpotify.css">
</head>
<body>
<header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container">
            <!-- Brand -->
            <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
                <strong class="blue-text">MDB</strong>
            </a>
            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <span class="underline-closing"><a href=""><i class="fas fa-home"></i> HOME</a></span>
                    </li>
                    	<!-- Features -->
                    <li class="nav-item dropdown mega-dropdown  active">
                            
                          <a class="nav-link dropdown-toggle text-uppercase" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                              <span class="underline-closing"><i class="fa fa-headphones" aria-hidden="true"></i> REMIXERS</span> 
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
                                                                    <span class="underline-closing">
                                                                        <a class="menu-item pl-0" href="../../?remixer='.$j['id'].'">
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
                        <!-- <span class="underline-closing"><a class="nav-link waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank"><i class="fas fa-folder"></i> MEMBRESIAS </a></span> -->
                    </li>
                    <li class="nav-item">
                        <span class="underline-closing"><a href=""><i class="fa fa-plus" aria-hidden="true"></i> LATIN EDIT PLUS</a></span>
                    </li>
                    <li class="nav-item active">
                        <span class="underline-closing"><a href="../../membresias.php"><i class="fa fa-folder" aria-hidden="true"></i> MEMBRRESIAS</a></span>
                    </li>
                    <li class="nav-item">
                        <span class="underline-closing"><a href=""><i class="fas fa-user-check"></i> LOGIN/REGISTER</a></span>
                    </li>
    
                </ul>
                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <span class="underline-closing">
                            <span class="badge red z-depth-1 mr-1"> 1 </span>
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                    </li>
                    <li class="nav-item tabla">

                        <span class="underline-closing"><a href=""><i class="fas fa-question-circle"></i> Support</a></span>
                    </li>
                </ul>

            </div>

            </div>
        </nav>
        <!-- Navbar -->
</header>





