<ul class="navbar-nav">
    <!--     <li class="nav-item">-->
    <!--        <a class="nav-link" href="{{ route('show.link') }}">-->
    <!--            <i class="ni ni-tv-2 text-primary"></i>Listado de links-->
    <!--        </a>-->
    <!--    </li>-->
    <!--     <li class="nav-item">-->
    <!--    <a class="nav-link" href=#>-->
    <!--        <i class="ni ni-shop text-info"></i> Restaurante-->
    <!--    </a>-->
    <!--</li>-->
    <!-- <li class="nav-item">-->
    <!--    <a class="nav-link" href=#>-->
    <!--        <i class="ni ni-shop text-info"></i> Tiendas-->
    <!--    </a>-->
    <!--</li>-->
    <!-- <li class="nav-item">-->
    <!--    <a class="nav-link" href=#  >-->
    <!--        <i class="ni ni-shop text-info"></i> Servicios-->
    <!--    </a>-->
    <!--</li>-->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">
             <i class="ni ni-circle-08 text-pink"></i> {{ __('Mi Perfil') }}
        </a>
    </li>
    <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="ni ni-glasses-2 text-pink"></i>  {{ __('Buscador') }}
                    </a>
    </li>
    <li class="nav-item">
                    <a class="nav-link" href="/linklist">
                        <i class="ni ni-collection text-pink"></i>  {{ __('Billetera') }}
                    </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">
            <i class="ni ni-cart text-pink"></i> {{ __('Mis Ordenes') }}
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('addresses.index') }}">
            <i class="ni ni-map-big text-green"></i> Mis Direcciones
        </a>
    </li> --}}

    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="ni ni-button-power text-orange"></i> {{ __('Cerrar Sesión') }}
        </a>
    </li>

</ul>
