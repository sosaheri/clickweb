<thead class="thead-light">
    <tr>
        <th scope="col">{{ __('ID') }}</th>
        @hasrole('admin|driver')
            <th scope="col">{{ __('Restaurant') }}</th>
        @endif
        <th class="table-web" scope="col">Fecha</th>
     

      
        @hasrole('admin|owner|driver')
            <th class="table-web" scope="col">Cliente</th>
        @endif
    
        @if(auth()->user()->hasRole('owner')|auth()->user()->hasRole('client'))
            <th class="table-web" scope="col">Producto</th>
            <th class="table-web" scope="col">{{ __('Price') }}</th>
        @endif
        @hasrole('admin|owner')
            <th class="table-web" scope="col">Repartidor</th>
        @endif
          <th scope="col"> Último estado  </th>
      
   
         @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('driver'))
            <th scope="col">{{ __('Actions') }}</th>
        @endif -->
    </tr>
</thead>
<tbody>
@foreach($orders as $order)
<tr>
    <td>
        
        <a class="btn badge badge-success badge-pill" href="{{ route('orders.show',$order->id )}}">#{{ $order->id }}</a>
    </td>
    @hasrole('admin|driver')
    <th scope="row">
        <div class="media align-items-center">
            <a class="avatar-custom mr-3">
                <img class="rounded" alt="..." src={{ $order->restorant->icon }}>
            </a>
            <div class="media-body">
                <span class="mb-0 text-sm">{{ $order->restorant->name }}</span>
            </div>
        </div>
    </th>
    @endif

    <td class="table-web">
        {{ $order->created_at->format(config('settings.datetime_display_format')) }}
    </td>

   
    @hasrole('admin|owner|driver')
    <td class="table-web">
       {{ $order->client->name }}
    </td>
    @endif
 
    @if(auth()->user()->hasRole('owner')|auth()->user()->hasRole('client'))
        <td class="table-web">
            {{ count($order->items) }}
        </td>
          <td class="table-web">
        @money( $order->order_price, config('settings.cashier_currency'),config('settings.do_convertion'))
    </td>
    @endif
    @hasrole('admin|owner')
        <td class="table-web">
            {{ !empty($order->driver->name) ? $order->driver->name : "" }}
        </td>
    @endif
     <td>
        @include('orders.partials.laststatus')
    </td>
 
     @include('orders.partials.actions.table',['order' => $order ]) 
</tr>
@endforeach
</tbody>
