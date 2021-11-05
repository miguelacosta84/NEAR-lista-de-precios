<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    <li class="nav-item" >
      <a href="#" class="{{ Request::is('mylist*') ? 'active' : '' }} nav-link" style="background-color: #567a78!important;">
        <i class="fas fa-database"></i>
        <p>
           Lista
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="{{ Request::is('mylist*') ? 'active' : '' }} nav-item"><a href="{{ route('mylist.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Mis Listas</p></a></li>
        <li class="nav-item"><a href="../../index2.html" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Ver lista</p></a></li>
      </ul>
    </li>
  </ul>
