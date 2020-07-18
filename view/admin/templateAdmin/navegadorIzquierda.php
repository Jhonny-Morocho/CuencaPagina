
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
      
          <img src="<?php echo"../img/proveedores/". @$_SESSION['img']?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo @$_SESSION['apodo']?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
      <?php if($_SESSION['tipo_usuario']=="admin"){?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user" aria-hidden="true"></i> <span>Djs-Remixer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../view/admin/formProveedor.php"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a></li>
            <li><a href="../view/admin/listarProveedor.php"><i class="fa fa-list-ul" aria-hidden="true"></i> Listar</a></li>
          </ul>
        </li>
  
        <li class="treeview">
          <a href="#">
            <i class="fa fa-music" ></i> <span>Genero</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../view/admin/formGenero.php"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a></li>
            <li ><a href="../view/admin/listarGenero.php"><i class="fa fa-list-ul" aria-hidden="true"></i> Listar</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-shopping-cart"></i><span>Informe Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a href="../view/admin/listarVentas.php"><i class="fa fa-list-ul" aria-hidden="true"></i> Listar</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-users"></i><span>Clientes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a href="../view/admin/listarClientes.php"><i class="fa fa-list-ul" aria-hidden="true"></i> Listar</a></li>
          </ul>
        </li>

        <?php } //end if admin solo puede ver ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-volume-up"></i> <span>Productos-Edits</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../view/admin/formProducto.php"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a></li>
            <?php if($_SESSION['tipo_usuario']=="admin"){?>
            <li><a href="../view/admin/listarProductos.php"><i class="fa fa-list-ul" aria-hidden="true"></i> Listar Todos</a></li>
            <?php } ?>
            <li><a href="../view/admin/listarMisProductos.php"><i class="fa fa-list-ul" aria-hidden="true"></i> Listar mis Edits</a></li>
            <li><a href="../view/admin/listarMisVentas.php"><i class="fa fa-list-ul" aria-hidden="true"></i> Listar mis Ventas</a></li>
            
          </ul>
        </li> 

    </section>
    <!-- /.sidebar -->
  </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard LatinEdits.com
        <small>Version 2.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../view/admin/index_admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

