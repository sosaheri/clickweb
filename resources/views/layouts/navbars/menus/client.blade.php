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
        <a class="nav-link" href="{{ route('orders.index') }}">
            <i class="ni ni-basket text-orange"></i> Mis Pedidos
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('addresses.index') }}">
            <i class="ni ni-map-big text-green"></i> Mis Direcciones
        </a>
    </li>
          <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="ni ni-collection text-pink"></i> Perfil
                    </a>
                </li>
</ul>
