     <header class="app-header">
         <nav class="navbar navbar-expand-lg navbar-light">
             <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                 <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                     <li class="nav-item dropdown">
                         <a class="nav-link nav-icon-hover" href="{{ route('profile') }}">
                             <img src="{{ \App\Helpers\FiturHelper::getProfileImage() }}" alt="Profile Image"
                                 width="35" height="35" class="rounded-circle">
                         </a>
                     </li>
                 </ul>
             </div>
         </nav>
     </header>
