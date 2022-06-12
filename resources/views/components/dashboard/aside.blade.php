<!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
        <!-- Brand Logo -->
        <a href="{{route('dashboard')}}" class="brand-link">
            <img src="{{URL::asset('dist/img/AdminLTELogo.png')}}" alt="{{config('app.name')}} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">{{{__('dashboard.dashboard')}}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{URL::asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                        @if(isset(Auth::user()->name))
                            {{Auth::user()->name}}
                        @endif
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- ############################################# Add-ons  #############################################-->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fab fa-accusoft nav-icon"></i>
                            <p>
                                {{__('dashboard.addons')}}
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('category.index')}}" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>{{__('dashboard.categories')}}</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('subcategory.index')}}" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>{{__('dashboard.subcategories')}}</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('brand.index')}}" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>{{__('dashboard.brands')}}</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('product.index')}}" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>{{__('dashboard.products')}}</p>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <!--  ############################################# add-ons ############################################# -->
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

