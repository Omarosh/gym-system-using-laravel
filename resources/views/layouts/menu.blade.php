<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('city_managers') }}" class="nav-link {{ Request::is('city_managers') ? 'active' : '' }}">
        <!-- <i class="nav-icon fas fa-home"></i> -->
        <p>City Managers</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('trainees') }}" class="nav-link {{ Request::is('trainees') ? 'active' : '' }}">
        <!-- <i class="nav-icon fas fa-home"></i> -->
        <p>Trainees</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('trainingPackages') }}" class="nav-link {{ Request::is('training_packages') ? 'active' : '' }}">
        <p>Training Packages</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('gyms') }}" class="nav-link {{ Request::is('gyms') ? 'active' : '' }}">
        <p>Gyms</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('attendance') }}" class="nav-link {{ Request::is('attendance') ? 'active' : '' }}">
        <p>Attendance</p>
    </a>
</li>