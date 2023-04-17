 <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>

                <ul class="nav navbar-nav">
                  @can('create_pos_sales')
                    <li class="nav-item d-none d-lg-block">
                        <a class="btn btn-relief-primary round btn-sm {{ request()->routeIs('app.pos.index') ? 'disabled' : '' }}" href="{{ route('app.pos.index') }}">
                            <span class="iconify" data-icon="bx:cart"></span></i> Punto de venta
                        </a>
                    </li>
                    @endcan
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                 <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                 @can('show_notifications')
                <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">
                     @php
                        $low_quantity_products = \Modules\Product\Entities\Product::select('id', 'product_quantity', 'product_stock_alert', 'product_code')->whereColumn('product_quantity', '<=', 'product_stock_alert')
                        ->where('category_id','<>',2)
                        ->get();
                        echo $low_quantity_products->count();
                    @endphp
                </span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">Notificaciones</h4>
                                <div class="badge badge-pill badge-light-primary">{{ $low_quantity_products->count() }} Nuevas</div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                            @forelse($low_quantity_products as $product)
                               <a class="dropdown-item" href="{{ route('products.show', $product->id) }}">
                                <span class="iconify text-primary fa-2x" data-icon="fa-brands:slack-hash"></span></i> Producto: "{{ $product->product_code }}" ¡Cantidad baja!
                            </a>
                             @empty
                                <a class="dropdown-item" href="#">
                                    <span class="iconify  mr-2 text-danger fa-2x mb-1" data-icon="ant-design:alert-twotone"></span></i>No hay notificaciones disponibles.
                                </a>
                            @endforelse

                        </li>

                    </ul>
                </li>
                @endcan
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ Auth::user()->name }}</span><span class="user-status">{{ \Auth::user()->role->name }}</span></div><span class="avatar"><img class="round" src="{{ asset('/images/perfiles/'.\Auth::user()->image) }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="mr-50" data-feather="user"></i> Perfil</a>
                        <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mfe-2  bi bi-box-arrow-left" style="font-size: 1.2rem;"></i> Salir del sistema
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
