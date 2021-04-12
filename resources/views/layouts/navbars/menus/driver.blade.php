<ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="ni ni-collection text-pink"></i> Mi perfil
                    </a>
                </li>


                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-basket text-orange"></i> Pedidos
                    </a>
                </li>
                                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('share.menu') }}">
                        <i class="ni ni-send text-green"></i> Compartir
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ni ni-button-power text-orange"></i> {{ __('Cerrar Sesión') }}
                    </a>
                </li>
            </ul>
