@extends('layouts.app')
@section('admin_title')
    {{__('Tablero')}}
@endsection

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>


    <div class="container-fluid mt--7" id="app">
        <div class="row">
            <div class="col">
                <!-- Order Card -->
               <div class="card shadow">
    <div class="card-header border-0">

           <div class="row" >
                    <div class="col-md-6">

                       <nav class="tabbable sticky" style="top: {{ config('app.isqrsaas') ? 64:88 }}px;">
                        <ul class="nav nav-pills bg-white mb-2">
                          <!--   <li class="nav-item nav-item-category ">
                                <a class="nav-link  mb-sm-3 mb-md-0 active" data-toggle="tab" role="tab" href="">{{ __('All categories') }}</a>
                            </li> -->

                            <li class="nav-item nav-item-category">
                                <a class="nav-link mb-sm-3 mb-md-0"   href="{{Request::Url()."?status_id=1" }}" >Pedido Nuevo</a>
                            </li>
                             <li class="nav-item nav-item-category">
                                <a class="nav-link mb-sm-3 mb-md-0"   href="{{Request::Url()."?status_id=2" }}" >Preparacion</a>
                            </li>
                             <li class="nav-item nav-item-category">
                                <a class="nav-link mb-sm-3 mb-md-0"   href="{{Request::Url()."?status_id=3" }}" >Repartidor</a>
                            </li>



                        </ul>


                    </nav>
                    </div>

                </div>


    </div>
    <div class="col-12">
        @include('partials.flash')
    </div>
    @if(count($orders))

    <div class="table-responsive">
        <table class="table align-items-center">

              <thead class="thead-light">
    <tr>
        <th scope="col">{{ __('ID') }}</th>
        @hasrole('admin|owner|driver')
            <th class="table-web" scope="col">{{ __('Client') }}</th>
        @endif

        @if(auth()->user()->hasRole('owner'))
            <th class="table-web" scope="col">{{ __('Items') }}</th>
        @endif

        <th class="table-web" scope="col">{{ __('Price') }}</th>

        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('driver'))
            <th scope="col">{{ __('Actions') }}</th>
        @endif
    </tr>
</thead>
<tbody>
@foreach($orders as $order)

<tr>

    <td >
        <a class="btn badge badge-success badge-pill" href="{{ route('orders.show', $order['id'] )}}">#{{  $order['id'] }}</a>


    </td>





    @hasrole('admin|owner|driver')
    <td class="table-web">
       {{ $order['client']  }}
    </td>
    @endif


        <td class="table-web">
            @foreach($order['item'] as $item)
             {{ $item['name']  }}|
            @endforeach

        </td>


    <td class="table-web">
        @money( $order['price'] , config('settings.cashier_currency'),config('settings.do_convertion'))

    </td>



        <?php
$lastStatusAlisas=$order['last_status'] ;
?>

   <td>


                   @if($lastStatusAlisas == "Accepted by admin")
                <a href="{{ url('updatestatus/accepted_by_restaurant/'.$order['id'].'?dashboard=1') }}" class="btn btn-success btn-sm order-action">{{ __('Accept') }}</a>
                <a href="{{ url('updatestatus/rejected_by_restaurant/'.$order['id'].'?dashboard=1') }}" class="btn btn-danger btn-sm order-action">{{ __('Reject') }}</a>
            @elseif($lastStatusAlisas == "Assigned to driver"||$lastStatusAlisas == "Accepted_by_restaurant")
                <a href="{{ url('updatestatus/prepared/'.$order['id'].'?dashboard=1') }}" class="btn btn-primary btn-sm order-action">{{ __('Prepared') }}</a>
            @elseif(config('app.allow_self_deliver')&&$lastStatusAlisas == "Accepted by restaurant")
                <a href="{{ url('updatestatus/prepared/'.$order['id'].'?dashboard=1') }}" class="btn btn-primary btn-sm order-action">{{ __('Prepared') }}</a>
            @elseif(config('app.allow_self_deliver')&&$lastStatusAlisas == "Prepared ")
                <a href="{{ url('updatestatus/delivered/'.$order['id'].'?dashboard=1') }}" class="btn btn-primary btn-sm order-action">{{ __('Delivered') }}</a>
            @elseif($lastStatusAlisas == "Prepared"&&$order['delivery_method']=="2")
                <a href="{{ url('updatestatus/delivered/'.$order['id'].'?dashboard=1') }}" class="btn btn-primary btn-sm order-action">{{ __('Delivered') }}</a>
              @elseif($lastStatusAlisas == "Prepared"&&$order['delivery_method'] != "2")

               @if($order['driver_id'])

                   <a href="{{ url('updatestatus/delivered/'.$order['id'].'?dashboard=3') }}" class="btn btn-primary btn-sm order-action">{{ __('Delivered') }}</a>
                 @else
                        <button type="button" class="btn btn-primary btn-sm order-action" onClick="setCurrentItem({{ $order['id'] }})"  data-toggle="modal" data-target="#modal-asign-driver">{{ __('Assign to driver') }}</a>
                @endif
            @elseif($lastStatusAlisas == "Rejected by driver"&&$order['delivery_method'] != "2")

               @if($order['driver_id'])

                   <a href="{{ url('updatestatus/delivered/'.$order['id'].'?dashboard=3') }}" class="btn btn-primary btn-sm order-action">{{ __('Delivered') }}</a>
                 @else
                        <button type="button" class="btn btn-primary btn-sm order-action" onClick="setCurrentItem({{ $order['id'] }})"  data-toggle="modal" data-target="#modal-asign-driver">{{ __('Assign to driver') }}</a>
                @endif

            @else
                <small>{{ __('No actions for you right now!') }}</small>
            @endif


    </td>

</tr>
@endforeach
</tbody>


        </table>
    </div>
    @endif
    <div class="card-footer py-4">
        @if(count($orders))
        <nav class="d-flex justify-content-end" aria-label="...">

        </nav>
        @else
            <h4>{{ __('You don`t have any orders') }} ...</h4>
        @endif
    </div>
</div>
                <!-- vinl card -->
            </div>
        </div>
        @include('layouts.footers.auth')
        @include('orders.partials.modals2')
    </div>

    <div class="modal fade" id="modal-asign-driver" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-new-item">{{ __('Assign Driver') }}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form id="form-assing-driver" method="GET" action="{{url('home')."?status_id=1"}}">
                                           <div class="modal-body">

                                             <input name="orden" id="orden" class="form-control"  type="text"  value="" hidden="true">
                                        </div>

                                @include('partials.fields',$fields)

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-orden" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-new-item"></h3>
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-0" id="app1">



                                                <div class="card bg-secondary shadow border-0">
                                                    <div class="card-body px-lg-5 py-lg-5">
                                                       <div class="row">
                                                        <div class="col-sm col-md col-lg text-center" id="modalImgPart">
                                                            <img id="modalImg" src="" width="295px" height="200px">
                                                        </div>
                                                        <div class="col-sm col-md col-lg col-lg" id="modalItemDetailsPart">
                                                            <input id="modalID" type="hidden"></input>
                                                            <span id="modalPrice" class="new-price"></span>
                                                            <p id="modalDescription"></p>
                                                            <div id="variants-area">
                                                                <label class="form-control-label">{{ __('Select your options') }}</label>
                                                                <div id="variants-area-inside">
                                                                </div>
                                                            </div>
                                                            <div id="exrtas-area">
                                                                <br />
                                                                <label class="form-control-label" for="quantity">{{ __('Extras') }}</label>
                                                                <div id="exrtas-area-inside">
                                                                </div>
                                                            </div>
                                                            @if(  !(isset($canDoOrdering)&&!$canDoOrdering)   )
                                                            <div class="quantity-area">
                                                                <div class="form-group">
                                                                    <br />
                                                                    <label class="form-control-label" for="quantity">{{ __('Quantity') }}</label>
                                                                    <input type="number" name="quantity" id="quantity" class="form-control form-control-alternative" placeholder="1" value="1" required autofocus>
                                                                </div>
                                                                <div class="quantity-btn">
                                                                    <div id="addToCart1">
                                                                        <button class="btn btn-primary" v-on:click='addToCartAct'>{{ __('Add To Cart') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@section('js')

    <script src="{{ asset('js/app.js') }}" defer></script>
<script>
    "use strict";
    var items=[];
    var currentItem=null;
    var currentItemSelectedPrice=null;
    var lastAdded=null;
    var previouslySelected=[];
    var extrasSelected=[];
    var variantID=null;
    var CASHIER_CURRENCY = "<?php echo  config('settings.cashier_currency') ?>";
    var LOCALE="<?php echo  App::getLocale() ?>";
    var debug=true;

    function debugMe(title,message){
        if(debug){
            console.log("#"+title);
            console.log(message);
            console.log("--------");
        }
    }


 <?php

    function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
     }

    $items=[];





        foreach ($orders as $key => $item) {

            //Now add the variants and optins to the item data
            // $itemOptions=$item->options;

            $theArray=[

                'id'=>$item['id'],

                'delivery_method'=>$item['delivery_method'],
                'item'=>$item['item'],
                'driver_id'=>$item['driver_id'],
                 'client'=>$item['client'],
                 'price'=>$item['price'],

            ];
            echo "items[".$item['id']."]=".json_encode($theArray).";";
        }

    ?>


    function setCurrentItem(id){

    $(".modal-body #orden").val( id);

    }


    function CurrentItem(id ){
         var item=items[id];
   console.log(items);
    $('#modalTitle').text(item.driver_id);
        $('#modalName').text('item.name');
        $('#modalPrice').html(items[id].price);
        $('#modalID').text('item.id');

    if (items[id].delivery_method == 1) {
        $(".modal-header #modal-title").text("Recogida");
    }else{
         $(".modal-header #modal-title").text('Entrega');
    }

    }



</script>

@endsection
