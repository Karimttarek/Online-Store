<div class="sidebar">
    <div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
        <a href="{{url('/'.LaravelLocalization::getCurrentLocale())}}" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
            <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-5 fw-semibold">{{config('app.name','Laravel')}}</span>
        </a>
        <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    Home
                </button>
                <div class="collapse show" id="home-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark rounded">Overview</a></li>
                        <li><a href="#" class="link-dark rounded">Updates</a></li>
                        <li><a href="#" class="link-dark rounded">Reports</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#ecommerce-collapse" aria-expanded="false">
                    E-Commerce
                </button>
                <div class="collapse" id="ecommerce-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{route('allproducts')}}" class="link-dark rounded">Product</a></li>
                        <li><a href="{{route('cart')}}" class="link-dark rounded">Your Cart</a></li>
                        <li><a href="#" class="link-dark rounded">wishlist</a></li>
                        <li><a href="#" class="link-dark rounded">Annually</a></li>
                    </ul>
                </div>
            </li>
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                    Orders
                </button>
                <div class="collapse" id="orders-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark rounded">New</a></li>
                        <li><a href="#" class="link-dark rounded">Processed</a></li>
                        <li><a href="#" class="link-dark rounded">Shipped</a></li>
                        <li><a href="#" class="link-dark rounded">Returned</a></li>
                    </ul>
                </div>
            </li>
            <li class="border-top my-3"></li>
            <li class="mb-1">
                <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    Account
                </button>
                <div class="collapse" id="account-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark rounded">New...</a></li>
                        <li><a href="" class="link-dark rounded">Profile</a></li>
                        <li><a href="#" class="link-dark rounded">Settings</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form></li>
                    </ul>
                </div>
            </li>
            <li class="border-top my-3"></li>
            {{-- Dashboard --}}
            @if (isset(Auth::user()->name) && Auth::user()->admin != 0)
                <li class="mb-1">
                    <a href="{{url('dashboard')}}" class="btn btn-toggle align-items-center rounded collapsed">Dashboard</a>
                    {{-- <div class="collapse" id="dashboard-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{route('products.all')}}" class="link-dark rounded">Products</a></li>
                        <li><a href="{{route('profile')}}" class="link-dark rounded">Profile</a></li>
                        <li><a href="#" class="link-dark rounded">Settings</a></li>
                        </ul>
                    </div> --}}
                </li>
            @endif

        </ul>
    </div>

</div>

@push('script')
    <script>
        function barsToggle(){

            // get the element
            let bars = document.querySelector('.logo .fa-bars');
            let sidebar = document.querySelector('.sidebar');
            let body = document.querySelector('body');

            bars.onclick = function(){
                sidebar.classList.toggle('toggle');

                if (sidebar.classList.contains('toggle')) {

                    body.style.paddingLeft = '300px';
                    body.style.transition = '.5s';
                }
                else{

                    body.style.paddingLeft = '0';
                    body.style.transition = '.5s';
                }
            };
        };

        barsToggle();
    </script>
@endpush
