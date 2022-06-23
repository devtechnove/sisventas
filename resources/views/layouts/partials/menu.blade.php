<!-- Menu -->
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal  menu bg-menu-theme flex-grow-0">
  <div class="container-xxl d-flex h-100">
    <ul class="menu-inner">

      <!-- Dashboards -->
        @can('Módulo de seguridad')
          <li class="menu-item @if (Route::is('usuario.index') ||(Route::is('logins.index')) || Route::is('roles.index') || Route::is('permisos.index') )active @endif">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-lock"></i>
          <div data-i18n="Seguridad">Seguridad</div>
        </a>
        <ul class="menu-sub">
          @can('Ver Usuarios')
              <li class="menu-item @if(Route::is('usuario.index')) active @endif">
            <a href="{{ url('/usuario') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-user"></i>
              <div data-i18n="Usuarios">Usuarios</div>
            </a>
          </li>
          @endcan
           @can('Ver Roles')
           <li class="menu-item @if (Route::is('roles.index')) active @endif">
            <a href="{{ url('/roles') }}" class="menu-link">
              <i class="menu-icon tf-icons iconify" data-icon="mdi:police-badge-outline"></i>
              <div data-i18n="Roles">Roles</div>
            </a>
          </li>
          @endcan
          @can('Ver Permisos')
            <li class="menu-item @if (Route::is('permisos.index')) active @endif">
            <a href="{{ url('/permisos') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-shield"></i>
              <div data-i18n="Permisos">Permisos</div>
            </a>
          </li>
          @endcan
          @can('Ver Logins')
            <li class="menu-item @if (Route::is('logins.index')) active @endif">
            <a href="{{ url('/logins') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-log-in"></i>
              <div data-i18n="Historial de logins">Historial de logins</div>
            </a>
          </li>
          @endcan
        </ul>
      </li>
     @endcan
     @can('Módulo de punto de venta')
          <li class="menu-item @if (Route::is('categoria.index') || Route::is('qty_adjustment.index')   || (Route::is('products.index') || Route::is('brand.index')))active @endif">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-card"></i>
          <div data-i18n="Punto de venta">Punto de venta</div>
        </a>
        <ul class="menu-sub">
        @can('Ver Marca')
              <li class="menu-item @if(Route::is('brand.index')) active @endif">
            <a href="{{ url('/brand') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-list-plus"></i>
              <div data-i18n="Marcas">Marcas</div>
            </a>
          </li>
          @endcan
          @can('Ver Categoria')
              <li class="menu-item @if(Route::is('categoria.index')) active @endif">
            <a href="{{ url('/categoria') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-list-plus"></i>
              <div data-i18n="Categorias">Categorias</div>
            </a>
          </li>
          @endcan   
           @can('Ver Producto')
              <li class="menu-item @if(Route::is('products.index')) active @endif">
            <a href="{{ url('/products') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-list-plus"></i>
              <div data-i18n="Productos">Productos</div>
            </a>
          </li>
          @endcan 
           @can('Ver Ajuste de Producto')
              <li class="menu-item @if(Route::is('qty_adjustment.index')) active @endif">
            <a href="{{ url('/qty_adjustment') }}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-list-plus"></i>
              <div data-i18n="Ajuste de Productos">Ajuste de Productos</div>
            </a>
          </li>
          @endcan 
        </ul>
      </li>
     @endcan 
    </ul>   
  </div>
</aside>
<!-- / Menu -->