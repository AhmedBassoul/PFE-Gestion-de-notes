<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
        </div>
        <div class="sidebar-brand-text mx-3">Espace Enseignant</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="https://www.fsdm.usmba.ac.ma">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('FSDM') }}</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="http://e-fsdm.usmba.ac.ma">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('Moodle') }}</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-window-maximize"></i>
            <span>Saisir les notes</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('saisir', ['ids' => 1]) }}">Session <b>Normal</b></a>
                <a class="collapse-item" href="{{ route('saisir', ['ids' => 2]) }}">Session <b>Rattrapage</b></a>
            </div>
        </div>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="https://www.fsdm.usmba.ac.ma/Student/PFE">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('PFE') }}</span></a>
    </li>


 <!-- <hr class="sidebar-divider">
   <div class="version" id="version-ruangadmin"></div>-->
</ul>
<!-- Sidebar -->
