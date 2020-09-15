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
  <!-- <link rel="stylesheet" href="../css/estilos.css?v=1.0.1"> -->

  <meta property="og:title" content="LatinEdit.com"/>
  <meta property="og:description" content="The best of the record pool of djs" /> 
  <meta property="og:image" content="../../img/perfil-facebook.png" />      
  <meta property="og:url" content="https://www.LatinEdit.com/" />
  <!-- =====================UNDER LINE ===================== -->
   <link rel="stylesheet" href="../../underline/underline.css">
</head>
<body>



<header>
<style>
    .navbar.navbar-light .breadcrumb .nav-item.active>.nav-link, .navbar.navbar-light .navbar-nav .nav-item.active>.nav-link {
    background-color: rgba(0,0,0,0.0); 
    margin-top: -8px;
    color: #007bff;
}
.special-color {
    background-color: #252222 !important;
}


.navbar .mega-dropdown .dropdown-menu.mega-menu .sub-menu ul li a:hover {
    background-color: #007bff !important;

}
</style>

<script >
    var a=2;
    var b=3;
    while(b>1){
        console.log("xxxx");
        b--;
    }
</script>

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
                   
                            <a class="nav-link dropdown-toggle text-uppercase border-right" id="navbarDropdownMenuLink2" data-toggle="dropdown"
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
                            <!-- <span class="clearfix d-none d-sm-inline-block"> Car </span> -->
                        </span>
                    </li>

                    <li class="nav-item">

                        <span class="underline-closing"><a href=""><i class="fas fa-question-circle"></i> Support</a></span>
                    </li>
         
                </ul>

            </div>

            </div>
        </nav>
        <!-- Navbar -->
      
        <!-- Navbar -->
</header>





<style>


.wrapper{
  height: 960px;
  overflow: hidden;
}

.header-shader{
 background-color:rgba(0, 0, 0, .6);
 display:block;
  width:100%;
  height:310px;
  z-index:1;
  padding:20px;
}

.header{
  z-index:0;
  background-image:url('https://farm3.staticflickr.com/2821/10175044984_7f21a5ba43.jpg');
  background-position:0px -190px;
  background-repeat:no-repeat;
  background-size:cover;
  color:#FFF;
  height:335px;
  width:100%;
  margin:0 auto;
  overflow:hidden;
}

.artist-info{
  position:relative;;
  top:130px;
}

.profile-img img{
  width:105px;
  height:105px;
  display:block;
  border-radius:100%;
  float:left;
  margin-right:20px;
}

h3{
  float:left;
  text-transform:uppercase;
  font-size:11px;
  font-family:"lato", sans-serif;
  letter-spacing:.7px;
  color:#9B9B9B;
  line-height:-.5px;
}

h1{
  font-size:47px;
  font-family:"lato", sans-serif;
  font-weight:100;
  color:rgba(255, 255, 255, .9);
  letter-spacing:.5px;
  padding-top:7px;
    position: relative;
  left: -5px;
}

.controls{
  float:left;
  padding-top:17px;
}

button{
  padding:6px 20px;
  margin:0 10px 0 0;
  border-radius:25px;
  background:#040505;
  border:1px solid #88898C;
  color:#DEDFE5;
  text-transform:uppercase;
  font-size:12px;
  letter-spacing:3px;
  font-family:"lato", sans-serif;
  font-weight:300;
}

button:hover{border:1px solid #648f00; color:#FFF;}




.circle{
  padding:6px 7px;
  border-radius:100%;
  text-align:center;
}

.circle:hover{
  border:1px solid #FFF;
}

.stats{
  float:right;
  margin:20px;
  display:block;
  font-family:"lato", sans-serif;
  font-weight:300;
  color:#88898C;
  text-align:right;
  font-size:15px;
  position: absolute;
  top: 145px;
  right: 20px;
}

.stats ul{
    margin:20px 20px 0;
  display:block;
}

.stats ul li{
  margin:5px 0;
  display:block;
  line-height:20px;
  text-transform:uppercase;
}

.stats ul li:hover{
  color:#FFF;
  cursor:pointer;
 }

.player-top{
  display:block;
  background:rgba(0, 0, 0, .9);
  width:100%;
  padding:20px 0 0;
  position:relative;
  top:-57px;
}

.player-top ul{
  padding:0 25px;
}

.player-top ul li{
color:#FFF;  
  display:inline-block;
  text-transform:uppercase;
  margin:0 25px 0 0;
  font-family:"lato", sans-serif;
  font-weight:400;
  font-size:14px;
  letter-spacing:.9px;
  color:#88898C;
    -webkit-transition: color 0.4s ease 0s;
  -moz-transition: color 0.4s ease 0s;
  transition: color 0.4s ease 0s;
}

.active-tab, .active-a{
  border-bottom:3px solid #84BD00;
  padding-bottom:20px;
  color:#FFF !important;
}

 .player-top ul li:hover{
   color:#FFF !important;
   cursor:pointer;
 }

.likes-this{
  float:right;
  position:relative;
  top:-96px;
  color:#FFF;
  right:60px;
  font-family:"lato", sans-serif;
  font-size:13px;
  padding-top:2px;
  font-weight:200;
  color:#88898C;
}  

.likes-this img{
  width:30px;
  border-radius:100%;
  vertical-align:center;
  position:relative;
  top:10px;
  padding-left:10px
}

a.tooltips {
  position: relative;
  display: inline;
}
a.tooltips span {
  margin-top:5px;
  position: absolute;
  width:100px;
  color: #88898C;
  background: #2E2F33;
  height: 31px;
  line-height: 31px;
  text-align: center;
  visibility: hidden;
  border-radius: 7px;
}
a.tooltips span:after {
  content: '';
  position: absolute;
  bottom: 100%;
  left: 80%;
  margin-left: -8px;
  width: 0; height: 0;
  border-bottom: 8px solid #2E2F33;
  border-right: 8px solid transparent;
  border-left: 8px solid transparent;
}
a:hover.tooltips span {
  visibility: visible;
  opacity: 1;
  top: 30px;
  left: 50%;
  margin-left: -76px;
  z-index: 999;
}

.playlist{
  background:#121314;
  width:100%;
  display:block;
  height:60vh;
  margin-top:-58px;
  padding:30px 25px;
}

.popular{
  width:60%;
  float:left;
  display:block;
  margin:0 20px 0 0;
}

.related-artist{
  width:35%;
  float:left;
  display:block;
  margin: -32px 0 0 20px;
}

h4{
  color:#88898C;
  font-family:"lato", sans-serif;
  text-transform:uppercase;
  letter-spacing:1.4px;
  font-weight:400;
  font-size:15px;
  padding-bottom:15px;
}

.popular-songs li, .related-artist li{
  border-top:2px solid #222326;
  border-bottom:2px solid #222326;
  height:40px;
}

.popular-songs .doubles .plus{
    margin-left: -9px;
}

.popular-songs li:hover, .related-artist li:hover{
  background:#222326;
}

.related-artist li:hover{
  color:#FFF;
}

.popular-songs .doubles:hover .plus{
  margin-left:-.5px;
}

.popular-songs li:hover .explicit{
  color:#FFF;
  border-color:#88898C;
}

.popular-songs li:hover > .misc{
  visibility:visible;
  cursor:pointer;
}

.popular-songs li .number{
  font-family: 'FontAwesome';
  position: relative;
  content: '1';
  top:0px;
}
.popular-songs li:hover .number span{
  display: none;
}
.popular-songs li:hover .number:after{
  font-family: 'FontAwesome';
  content: "\f04b";
  border:1.3px solid #88898C;
  padding: 8px;
  border-radius:100%;
  left:-10px;
  margin-right:19px;
  position:relative;
  top:13px;
  color:#DFE0E6;
}

.popular-songs li .number:hover:after{
  color:#FFF;
  border-color:#FFF;
}

.popular-songs span{
  color:#88898C;
  margin:0 40px 0 0;
  position:relative;
  top: 13px;
  font-family:"lato", sans-serif;
  font-weight:400;
  font-size:14px;
}

.album-cover img{
  width:40px;
  height:auto;
  displau:block;
  float:left;
  margin-right:20px;
}

.popular-songs .title{
  color:#DEDFE5;
}

.popular-songs .explicit{
  text-transform:uppercase;
  font-size:10px;
  border:1px solid;
  padding:2px 7px;
  border-radius:2px;
  font-weight:500;
  position:relative;
  margin-right:-75px;
}

.popular-songs .misc{
  position:relative;
  float:right;
  right:90px;
  visibility:hidden;
  color:#FFF;
}

.popular-songs .total-plays{
  float:right;
  position:relative;
  right:-80px;
}

.popular-songs button{
  margin:15px 0;
}

.popular-songs button:hover{
  border-color:#FFF;
  color:#FFF;
}

.related-artist ul li{
  color:#FFF;
  height:45px;
}

.related-artist ul li .album-cover img{
  width:45px;
  border-radius:100%;
}

.related-artist ul li .title, .title{
  position:relative;
  top:14px;
  font-family:"lato", sans-serif;
  font-size:14px;
  color:#DFE0E6;
  letter-spacing:.4px;
}


.related-group{
    margin-top: 60px;
    height:80vh;
  display:block;
  width:100%;
  padding:20px 0;
  overflow:scroll;
}

.artist{
  margin: 15px 10px;
  overflow:hidden;
  display:block;
  position: relative;
  margin-top: -220px;
  z-index: 0;
  width:220px;
  float:left;
  
}

.picture-shader{
  height: 220px;
  width: 220px;
  display: block;
  background: rgba(0,0,0,.01);
  position: absolute;
  margin-top: 219px;
  z-index: 2;
  display: block;
  color:#FFF;
}

.picture-shader .play-me{
  display:none;
}

.picture-shader:hover{
  display:block;
  background: rgba(0,0,0,.7);
}

.picture-shader .fa{
  position:relative;
  left:-4px;
}

.picture-shader:hover .play-me:hover{
  color:#FFF;
  border-color:#FFF;
  background:rgba(0,0,0,.5);
  cursor:pointer;
}

.picture-shader:hover .play-me{
    display: block;
  font-size: 36px;
  border: 2px solid #88898C;
  color:#88898C;
  text-align: center;
  vertical-align: middle;
  border-radius: 100%;
  width: 10px;
  height: 10px;
  padding: 27px 30px 27px 25px;
  margin: 0 auto;
  position: relative;
  top: 75px;
  letter-spacing: 50px;
  line-height: 12px;
}

.artist-shader{
  background: rgba(0,0,0,.75);
  display:block;
  width: 220px;
  height: 220px;
  position: relative;
  z-index:1;
  top:220px;
}

.rounded-prof img{
  display:block;
  width:170px;
  height:170px;
  border-radius:100%;
  position:absolute;
  z-index:1;
  margin:0 auto;
  margin-top:20px;
  margin-left:20px;
}

.prof-img img{
  width:220px; 
  background:Red;
  float:left;
  display:block;
  height:220px;
}

.band-name{
  width:206px;
  height:50px;
  background:#222326;
  display:block;
  clear:both;
  padding:5px 7px 20px;
}

.text-container{
  width:350px;
  margin:0 auto;
  margin-top:30px;
}

.text-container img{
  text-align:center;
  width:170px;
  display:block;
  margin:0 auto;
  padding-bottom:30px;
}

.band-name .title{
  position:relative;
  top:5px;
}

.bio-text{
  color:#88898C;
  font-family:"lato", sans-serif;
  font-weight:300;
  font-size:14px;
  line-height:19px;
}

.lead-in{
  font-size:17px;
  line-height:19px;
  padding-bottom:7px;
  display:block;
}

</style>

