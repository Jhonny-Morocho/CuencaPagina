<template>
  <div id="nav">
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>|
    <router-link to="/car">CAR</router-link>
  </div>


  <header>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar d-flex justify-content-center">
      <div class="container">
          <a class="navbar-brand waves-effect" href="../../" >
              <strong class="blue-text"><img src="" style="width: 100%;" alt="" class="animated flip "></strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto ">
                  <li class="nav-item active">
                      <span class="text-hover text-hover-underline-opening"><a href="../../" style="  font-weight: 700 ;"><i class="fas fa-home"></i> HOME</a></span>
                  </li>
                  <li class="nav-item dropdown mega-dropdown  active">
                      <a class="nav-link dropdown-toggle text-uppercase" id="navbarDropdownMenuLink2" data-toggle="dropdown" style="  font-weight: 700 ;"
                          aria-haspopup="true" aria-expanded="false">
                          <span class="text-hover text-hover-underline-opening"><i class="fa fa-headphones" aria-hidden="true"></i> REMIXERS</span> 
                          <span class="sr-only">(current)</span> 
                      </a>
                      <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-5 px-3 "
                          aria-labelledby="navbarDropdownMenuLink2">
                          <div class="row">
                              <div class="col-md-6 col-xl-3 sub-menu mb-xl-0 mb-4 ">
                                  <ul class="list-unstyled">';
                                    <li>
                                        <span class="text-hover text-hover-underline-opening">
                                          <a class="menu-item pl-0" href="../../?nameRemixer='.$proveedor[$contProveedor]['apodo'].'&remixer='.$proveedor[$contProveedor]['id'].'">
                                            <i class="fas fa-caret-right pl-1 pr-3"></i>APDODO
                                          </a>
                                        </span> 
                                    </li>
                                  </ul>
                              </div>
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
                      <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4" id="nav-login">
                          <a class="dropdown-item" href="../../adminCliente.php" v-if="loginUsuario">{{nombreUsuario}}</a>
                          <a class="dropdown-item" href="../../login.php" v-if="!loginUsuario">LOGIN</a>
                          <a class="dropdown-item" href="../../registro.php" v-if="!loginUsuario">REGISTRO</a>
                      </div>
                  </li>
              </ul>
              <!-- Right -->
              <ul class="navbar-nav nav-flex-icons " >
                  <li class="nav-item">
                  <span class="text-hover text-hover-underline-opening">
                      <a href="../../car.php">
                          <span class="badge red z-depth-1 mr-1 cart-notification" id="numProductos"> 0 </span>
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
  </header>
  <router-view/>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}


</style>
