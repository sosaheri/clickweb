@extends('layouts.app', ['title' => __('Orders')])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-7 ">
                <br/>
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ "#".$order->id." - ".$order->created_at->format(config('settings.datetime_display_format')) }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('orders.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                <div class="card-body">

                        @if (config('app.isft'))
         <h6 class="heading-small text-muted mb-4">{{ __('Client Information') }}</h6>
         <div class="pl-lg-4">
             <h3>{{ $order->client->name }}</h3>
             <h4>{{ $order->client->email }}</h4>
            
              @if ($order->address)
             <a href="https://www.google.com/maps/place/{{$order->address->address }}">{{ $order->address->address }}</a><br>
              @endif
             @if(!empty($order->address->apartment))
                 <h4>{{ __("Apartment number") }}: {{ $order->address->apartment }}</h4>
             @endif
             @if(!empty($order->address->entry))
                 <h4>{{ __("Entry number") }}: {{ $order->address->entry }}</h4>
             @endif
             @if(!empty($order->address->floor))
                 <h4>{{ __("Floor") }}: {{ $order->address->floor }}</h4>
             @endif
             @if(!empty($order->address->intercom))
                 <h4>{{ __("Intercom") }}: {{ $order->address->intercom }}</h4>
             @endif
             @if(!empty($order->client->phone))
             <br/>
             <h4>{{ __('Contact')}}:</h4>
                   <a href="tel:{{$order->client->phone}}">{{ $order->client->phone}} </a> 
             @endif
         </div>
         <hr class="my-4" />
   
        
     @endif
<!--     <h6 class="heading-small text-muted mb-4">{{ __('Restaurant information') }}</h6>
     @include('partials.flash')
     <div class="pl-lg-4">
         <h3>{{ $order->restorant->name }}</h3>
          <a href="https://www.google.com/maps/place/{{$order->restorant->address}}">{{ $order->restorant->address }}</a><br>

         <a href="tel:{{$order->restorant->phone}}">{{ $order->restorant->phone}} </a> 
    
         <h4>{{ $order->restorant->user->name.", ".$order->restorant->user->email }}</h4>
     </div>
     <hr class="my-4" /> -->
 
 
     
 
 
     
     <h6 class="heading-small text-muted mb-4">{{ __('Order') }}</h6>
     <?php 
                 $currency=config('settings.cashier_currency');
                 $convert=config('settings.do_convertion');
             ?>
  
    
     <hr />
     @if(config('app.isft'))
         <h4>{{ __("Delivery method") }}: {{ $order->delivery_method==1?__('Delivery'):__('Pickup') }}</h4>
       
     @else
         <h4>{{ __("Dine method") }}: {{ $order->delivery_method==3?__('Dine in'):__('Takeaway') }}</h4>
    
     @endif
 
 
 </div>  

             <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
         Ticket
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
                 <ul id="order-items">
         @foreach($order->items as $item)
             <?php 
                 $theItemPrice= ($item->pivot->variant_price?$item->pivot->variant_price:$item->price);
             ?>
             <li><h4>{{ $item->pivot->qty." X ".$item->name }} -  @money($theItemPrice, $currency,$convert)  =  ( @money( $item->pivot->qty*$theItemPrice, $currency,true) )
                 @hasrole('admin|driver|owner')
                     @if($item->pivot->vatvalue>0))
                     <span class="small">-- {{ __('VAT ').$item->pivot->vat."%: "}} ( @money( $item->pivot->vatvalue, $currency,$convert) )</span>
                     @endif
                 @endif
             </h4>
                 @if (strlen($item->pivot->variant_name)>2)
                     <br />
                     <table class="table align-items-center">
                         <thead class="thead-light">
                             <tr>
                                 @foreach ($item->options as $option)
                                     <th>{{ $option->name }}</th>
                                 @endforeach
 
 
                             </tr>
                         </thead>
                         <tbody class="list">
                             <tr>
                                 @foreach (explode(",",$item->pivot->variant_name) as $optionValue)
                                     <td>{{ $optionValue }}</td>
                                 @endforeach
                             </tr>
                         </tbody>
                     </table>
                 @endif
 
                 @if (strlen($item->pivot->extras)>2)
                     <br /><span>{{ __('Extras') }}</span><br />
                     <ul>
                         @foreach(json_decode($item->pivot->extras) as $extra)
                             <li> {{  $extra }}</li>
                         @endforeach
                     </ul><br />
                 @endif
                 <br />
             </li>
         @endforeach
     </ul>
      @if(!empty($order->comment))
        <br/>
        <h4>{{ __('Comment') }}: {{ $order->comment }}</h4>
     @endif
     @if(strlen($order->phone)>2)
        <h4>{{ __('Phone') }}: {{ $order->phone }}</h4>
     @endif
     <br />

     @hasrole('admin|driver|owner')
     <h5>{{ __("NET") }}: @money( $order->order_price-$order->vatvalue, $currency ,true)</h5>
     <h5>{{ __("VAT") }}: @money( $order->vatvalue, $currency,$convert)</h5>
 
     @endif
     <h4>{{ __("Sub Total") }}: @money( $order->order_price, $currency,$convert)</h4>
     @if(config('app.isft'))
     <h4>{{ __("Delivery") }}: @money( $order->delivery_price, $currency,$convert)</h4>
     @endif
     <hr />
     <h3>{{ __("TOTAL") }}: @money( $order->delivery_price+$order->order_price, $currency,true)</h3>
     <hr />
     <h4>{{ __("Payment method") }}: {{ __(strtoupper($order->payment_method)) }}</h4>
     <h4>{{ __("Payment status") }}: {{ __(ucfirst($order->payment_status)) }}</h4>
     @if ($order->payment_status=="unpaid"&&strlen($order->payment_link)>5)
         <button onclick="location.href='{{$order->payment_link}}'" class="btn btn-success">{{ __('Pay now') }}</button>
     @endif
      </div>
    </div>
  </div>


</div>







                   <!-- @include('orders.partials.actions.buttons',['order'=>$order]) -->
                </div>
            </div>
            <div class="col-xl-5  mb-5 mb-xl-0">
          
                <br/>
                <div class="card card-profile shadow">
                    <div class="card-header">
                        <h5 class="h3 mb-0">{{ __("Status History")}}</h5>
                    </div>
                    @include('orders.partials.orderstatus')
                    
                </div>
                @if(auth()->user()->hasRole('client'))
                @if($order->status->pluck('alias')->last() == "delivered")
                    <br/>
                    @include('orders.partials.rating',['order'=>$order])
                @endif
                @endif
            </div>
        </div>
        @include('layouts.footers.auth')
        @include('orders.partials.modals',['order'=>$order])
    </div>
@endsection

@section('head')
    <link type="text/css" href="{{ asset('custom') }}/css/rating.css" rel="stylesheet">
@endsection

@section('js')
<!-- Google Map -->
<script async defer src= "https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=<?php echo config('settings.google_maps_api_key'); ?>"> </script>
  

    <script src="{{ asset('custom') }}/js/ratings.js"></script>
@endsection

