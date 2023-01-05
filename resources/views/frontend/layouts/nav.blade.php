 <style>
     .mobileDashboard {
         display: flex;
         justify-content: center;
         text-align: center;
         align-items: center;
     }

     .navbar-collapse {
         /* background-color: white; */
         padding: 10px;
     }
 </style>

 <nav class="navbar navbar-expand-lg">
     <div class="container">
         <a class="navbar-brand" href="/">
             <img src="{{ site()->logo }}" alt="" />
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
             aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-auto">


                 <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="/">Home</a>
                 </li>

                 <li class="nav-item">
                     <a class="nav-link" aria-current="page" href="/pages/contact-us">Contact Us</a>
                 </li>

                 @if (Auth::check())
                 @else
                     <li class="nav-item">
                         <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
                     </li>
                 @endif

             </ul>
             <div class="mobileDashboard">


                 @if (Auth::check())
                     @if (Auth::user()->role == 'user')
                         <a href="{{ route('post-job') }}" class="btn tasker-btn text-white btn-primary "
                             style="margin-right: 10px; color:white !important">
                             Request a quote
                         </a>
                         <form class="d-flex" role="search">
                             <a href={{ route('user.dashboard') }} class="btn tasker-btn" type="submit">
                                 Dashboard
                             </a>
                         </form>
                     @endif
                     @if (Auth::user()->role == 'company')
                         <form class="d-flex" role="search">
                             <a href={{ route('tasker.dashboard') }} class="btn tasker-btn" type="submit">
                                 Dashboard
                             </a>
                         </form>
                     @endif
                 @else
                     <a href="{{ route('post-job') }}" class="btn tasker-btn text-white btn-primary "
                         style="margin-right: 10px; color:white !important">
                         Request a quote
                     </a>
                     <form class="d-flex" role="search" style="margin-right: 10px;">
                         <a href={{ route('signUp') }} class="btn tasker-btn" type="submit">
                             Become a Tradexpert
                         </a>
                     </form>
                 @endif

                 @if (Auth::check())
                     <form class="d-flex" role="search" action="{{ route('logout') }}" method="POST">
                         @csrf
                         <button class="btn btn-danger ms-2 " type="submit">
                             Logout
                         </button>
                     </form>
                 @endif
             </div>

         </div>
     </div>
 </nav>
