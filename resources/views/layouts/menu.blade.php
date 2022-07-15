 <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-semi-dark/index.html"><span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                        <h2 class="brand-text">Vuexy</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="index.html"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning badge-pill ml-auto mr-1">1</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a class="d-flex align-items-center" href="dashboard-ecommerce.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Inicio">Inicio</span></a>
                        </li>
                    </ul>
                </li>
                 @can('access_product_categories')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->routeIs('product-categories.*') ? 'active' : '' }}" href="{{ route('product-categories.index') }}">
                            <i class="c-sidebar-nav-icon bi bi-collection" style="line-height: 1;"></i> Categorías
                        </a>
                    </li>
                    @endcan
               @can('access_products')
                    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('products.*')  ? 'open' : '' }}">
                        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                            <i class="c-sidebar-nav-icon bi bi-journal-bookmark" style="line-height: 1;"></i> Productos
                        </a>
                        <ul class="c-sidebar-nav-dropdown-items">
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}" href="{{ route('products.index') }}">
                                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Listado general
                                </a>
                            </li>
                             @can('create_products')
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}" href="{{ route('products.create') }}">
                                    <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Nuevo producto
                                </a>
                            </li>
                            @endcan
                            @can('print_barcodes')
                               <li class="c-sidebar-nav-item">
                                   <a class="c-sidebar-nav-link {{ request()->routeIs('barcode.print') ? 'active' : '' }}" href="{{ route('barcode.print') }}">
                                       <i class="c-sidebar-nav-icon bi bi-printer" style="line-height: 1;"></i> Print Barcode
                                   </a>
                               </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('access_adjustments')
                        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('adjustments.*') ? 'open' : '' }}">
                            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="c-sidebar-nav-icon bi bi-clipboard-check" style="line-height: 1;"></i> Ajuste de inventario
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                <li class="c-sidebar-nav-item">
                                    <a class="c-sidebar-nav-link {{ request()->routeIs('adjustments.index') ? 'active' : '' }}" href="{{ route('adjustments.index') }}">
                                        <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Listado general
                                    </a>
                                </li>
                                  @can('create_adjustments')
                                    <li class="c-sidebar-nav-item {{ request()->routeIs('adjustments.create') ? ' active' : '' }}">
                                        <a class="c-sidebar-nav-link" href="{{ route('adjustments.create') }}">
                                            <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Nuevo ajuste
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('access_quotations')
                    <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('quotations.*') ? 'open' : '' }}">
                        <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                            <i class="c-sidebar-nav-icon bi bi-cart-check" style="line-height: 1;"></i> Presupuestos
                        </a>
                        <ul class="c-sidebar-nav-dropdown-items">
                            <li class="c-sidebar-nav-item">
                                <a class="c-sidebar-nav-link {{ request()->routeIs('quotations.index') ? 'active' : '' }}" href="{{ route('quotations.index') }}">
                                    <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Listado general
                                </a>
                            </li>
                              @can('create_adjustments')
                                <li class="c-sidebar-nav-item">
                                    <a class="c-sidebar-nav-link {{ request()->routeIs('quotations.create') ? 'active' : '' }}" href="{{ route('quotations.create') }}">
                                        <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Nuevo Presupuesto
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('access_purchases')
                        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('purchases.*') || request()->routeIs('purchase-payments*') || request()->routeIs('purchase-returns.*')? 'open' : '' }}">
                            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="c-sidebar-nav-icon bi bi-bag" style="line-height: 1;"></i> Compras
                            </a>
                             <ul class="c-sidebar-nav-dropdown-items">
                                <li class="c-sidebar-nav-item">
                                    <a class="c-sidebar-nav-link {{ request()->routeIs('purchases.index') ? 'active' : '' }}" href="{{ route('purchases.index') }}">
                                        <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Listado general
                                    </a>
                                </li>
                            </ul>
                            @can('create_purchase')
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('purchases.create') ? 'active' : '' }}" href="{{ route('purchases.create') }}">
                                            <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Nueva compra
                                        </a>
                                    </li>
                                </ul>
                                @endcan
                                 <ul class="c-sidebar-nav-dropdown-items">
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('purchase-returns.index') ? 'active' : '' }}" href="{{ route('purchase-returns.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Devoluciones
                                        </a>
                                    </li>
                               </ul>
                                 @can('create_purchase_returns')
                                    <ul class="c-sidebar-nav-dropdown-items">
                                        <li class="c-sidebar-nav-item">
                                            <a class="c-sidebar-nav-link {{ request()->routeIs('purchase-returns.create') ? 'active' : '' }}" href="{{ route('purchase-returns.create') }}">
                                                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Nueva devolución
                                            </a>
                                        </li>
                                    </ul>
                                @endcan

                        </li>
                    @endcan
                    @can('access_sales')
                            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('sales.*') || request()->routeIs('sale-payments*')  || request()->routeIs('sale-returns*')? 'open' : '' }}">
                                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="c-sidebar-nav-icon bi bi-receipt" style="line-height: 1;"></i> Ventas
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('sales.index') ? 'active' : '' }}" href="{{ route('sales.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Listado general
                                        </a>
                                    </li>
                                </ul>
                                @can('create_sales')
                                    <ul class="c-sidebar-nav-dropdown-items">
                                        <li class="c-sidebar-nav-item">
                                            <a class="c-sidebar-nav-link {{ request()->routeIs('sales.create') ? 'active' : '' }}" href="{{ route('sales.create') }}">
                                                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Nueva venta
                                            </a>
                                        </li>
                                    </ul>
                                @endcan
                                @can('access_sale_returns')
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('sale-returns.index') ? 'active' : '' }}" href="{{ route('sale-returns.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Devoluciones
                                        </a>
                                    </li>
                                </ul>
                                 @can('create_sale_returns')
                                    <ul class="c-sidebar-nav-dropdown-items">
                                        <li class="c-sidebar-nav-item">
                                            <a class="c-sidebar-nav-link {{ request()->routeIs('sale-returns.create') ? 'active' : '' }}" href="{{ route('sale-returns.create') }}">
                                                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Nueva devolución
                                            </a>
                                        </li>
                                    </ul>
                                @endcan
                            @endcan

                            </li>
                        @endcan
                        @can('access_expenses')
                            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('expenses.*') || request()->routeIs('expense-categories.*') ? 'open' : '' }}">
                                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="c-sidebar-nav-icon bi bi-wallet2" style="line-height: 1;"></i> Gastos
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    @can('access_expense_categories')
                                        <li class="c-sidebar-nav-item">
                                            <a class="c-sidebar-nav-link {{ request()->routeIs('expense-categories.*') ? 'active' : '' }}" href="{{ route('expense-categories.index') }}">
                                                <i class="c-sidebar-nav-icon bi bi-collection" style="line-height: 1;"></i> Categorías
                                            </a>
                                        </li>
                                    @endcan
                                     <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('expenses.index') ? 'active' : '' }}" href="{{ route('expenses.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-journals" style="line-height: 1;"></i> Listado general
                                        </a>
                                    </li>
                                    @can('create_expenses')
                                        <li class="c-sidebar-nav-item">
                                            <a class="c-sidebar-nav-link {{ request()->routeIs('expenses.create') ? 'active' : '' }}" href="{{ route('expenses.create') }}">
                                                <i class="c-sidebar-nav-icon bi bi-journal-plus" style="line-height: 1;"></i> Nuevo gasto
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('access_customers|access_suppliers')
                            @can('access_customers')
                                <li class="c-sidebar-nav-item">
                                    <a class="c-sidebar-nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                                        <i class="c-sidebar-nav-icon bi bi-people-fill" style="line-height: 1;"></i> Clientes
                                    </a>
                                </li>
                            @endcan
                            @can('access_suppliers')
                                <li class="c-sidebar-nav-item">
                                    <a class="c-sidebar-nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">
                                        <i class="c-sidebar-nav-icon bi bi-people-fill" style="line-height: 1;"></i> Proveedores
                                    </a>
                                </li>
                            @endcan
                        @endcan
                        @can('access_reports')
                            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('*-report.index') ? 'open' : '' }}">
                                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="c-sidebar-nav-icon bi bi-graph-up" style="line-height: 1;"></i> Reportes
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('profit-loss-report.index') ? 'active' : '' }}" href="{{ route('profit-loss-report.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i> Pérdidas y ganancias
                                        </a>
                                    </li>
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('payments-report.index') ? 'active' : '' }}" href="{{ route('payments-report.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i> Pagos
                                        </a>
                                    </li>
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('sales-report.index') ? 'active' : '' }}" href="{{ route('sales-report.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i> Ventas
                                        </a>
                                    </li>
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('purchases-report.index') ? 'active' : '' }}" href="{{ route('purchases-report.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i> Compras
                                        </a>
                                    </li>
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('sales-return-report.index') ? 'active' : '' }}" href="{{ route('sales-return-report.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i> Ventas (Devolución)
                                        </a>
                                    </li>
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('purchases-return-report.index') ? 'active' : '' }}" href="{{ route('purchases-return-report.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-clipboard-data" style="line-height: 1;"></i> Compras (Devolución)
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        @can('access_user_management')
                            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('roles*') || request()->routeIs('users.*') ? 'open' : '' }}">
                                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="c-sidebar-nav-icon bi bi-people" style="line-height: 1;"></i> Gestión de usuarios
                                </a>
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('users.create') ? 'active' : '' }}" href="{{ route('users.create') }}">
                                            <i class="c-sidebar-nav-icon bi bi-person-plus" style="line-height: 1;"></i> Create User
                                        </a>
                                    </li>
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-person-lines-fill" style="line-height: 1;"></i> All Users
                                        </a>
                                    </li>
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-key" style="line-height: 1;"></i> Roles & Permissions
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('access_currencies|access_settings')
                            <li class="c-sidebar-nav-item c-sidebar-nav-dropdown {{ request()->routeIs('currencies*') ? 'open' : '' }}">
                                <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
                                    <i class="c-sidebar-nav-icon bi bi-gear" style="line-height: 1;"></i> Settings
                                </a>
                                @can('access_currencies')
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('currencies*') ? 'active' : '' }}" href="{{ route('currencies.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-cash-stack" style="line-height: 1;"></i> Currencies
                                        </a>
                                    </li>
                                </ul>
                                @endcan
                                @can('access_settings')
                                <ul class="c-sidebar-nav-dropdown-items">
                                    <li class="c-sidebar-nav-item">
                                        <a class="c-sidebar-nav-link {{ request()->routeIs('settings*') ? 'active' : '' }}" href="{{ route('settings.index') }}">
                                            <i class="c-sidebar-nav-icon bi bi-sliders" style="line-height: 1;"></i> System Settings
                                        </a>
                                    </li>
                                </ul>
                                @endcan
                            </li>
                        @endcan
 </div>
</div>
    <!-- END: Main Menu-->
