<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="{{ url('/') }}"><img width="250" src="images/logo zalira.png" alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('view_all_product') }}">Products</a>
                        </li>
                        

                        

                        <form action="{{url('search_product')}}" method="GET">

                           @csrf
                           <input type="search" name="search" value="" placeholder="Search product" class="form-control"/>
                        </form>

                        @if (Route::has('login'))
                            
                        @auth
                        
                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('show_cart') }}">Shopping Cart</a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('show_orders') }}">Orders</a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="{{ url('edit_address') }}">Change Address</a>
                        </li>

                        <li class="nav-item">
                           <x-app-layout>

                           </x-app-layout>
                        </li>

                        @else

                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>

                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                        @endif
                        
                     </ul>
                  </div>
               </nav>
            </div>
         </header>