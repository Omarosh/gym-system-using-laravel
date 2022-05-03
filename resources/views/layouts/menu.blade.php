<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('city_managers') }}" class="nav-link {{ Request::is('gym_managers') ? 'active' : '' }}">
        <!-- <i class="nav-icon fas fa-home"></i> -->
        <p>Gym Managers</p>
    </a>
</li>