<ul class="navbar-nav">
   

    <li class="nav-item">
        <a class="nav-link" href="{{ route('service.edit',  auth()->user()->restorant->id) }}">
            <i class="ni ni-shop text-info"></i> Mi Negocio
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="ni ni-collection text-pink"></i> Servicios
        </a>
    </li>

  <!--   @if (config('app.isqrsaas') && (!config('settings.qrsaas_disable_odering') || config('settings.enable_guest_log')))
        @if(!config('settings.is_whatsapp_ordering_mode'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.restaurant.tables.index') }}">
                    <i class="ni ni-ungroup text-red"></i> {{ __('Tables') }}
                </a>
            </li>
        @endif
    @endif
 -->

 <!--    @if(config('settings.enable_pricing'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('plans.current') }}">
                <i class="ni ni-credit-card text-orange"></i> {{ __('Plan') }}
            </a>
        </li>
    @endif -->



          <li class="nav-item">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="ni ni-collection text-pink"></i> Mi cuenta
        </a>
        </li>
        <!--
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.restaurant.coupons.index') }}">
                <i class="ni ni-tag text-pink"></i> {{ __('Coupons') }}
            </a>
        </li>
    -->


    <li class="nav-item">
            <a class="nav-link" href="{{ route('share.menu') }}">
                <i class="ni ni-send text-green"></i> Compartir
            </a>
    </li>

</ul>
