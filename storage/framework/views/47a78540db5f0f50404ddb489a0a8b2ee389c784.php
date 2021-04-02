<?php $__env->startSection('admin_title'); ?>
    <?php echo e(__('Tablero')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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

                       <nav class="tabbable sticky" style="top: <?php echo e(config('app.isqrsaas') ? 64:88); ?>px;">
                        <ul class="nav nav-pills bg-white mb-2">
                          <!--   <li class="nav-item nav-item-category ">
                                <a class="nav-link  mb-sm-3 mb-md-0 active" data-toggle="tab" role="tab" href=""><?php echo e(__('All categories')); ?></a>
                            </li> -->

                            <li class="nav-item nav-item-category">
                                <a class="nav-link mb-sm-3 mb-md-0"   href="<?php echo e(Request::Url()."?status_id=1"); ?>" >Pedido Nuevo</a>
                            </li>
                             <li class="nav-item nav-item-category">
                                <a class="nav-link mb-sm-3 mb-md-0"   href="<?php echo e(Request::Url()."?status_id=2"); ?>" >Preparacion</a>
                            </li>
                             <li class="nav-item nav-item-category">
                                <a class="nav-link mb-sm-3 mb-md-0"   href="<?php echo e(Request::Url()."?status_id=3"); ?>" >Repartidor</a>
                            </li>



                        </ul>


                    </nav>
                    </div>

                </div>
    
    
    </div>
    <div class="col-12">
        <?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <?php if(count($orders)): ?>

    <div class="table-responsive">
        <table class="table align-items-center">

              <thead class="thead-light">
    <tr>
        <th scope="col"><?php echo e(__('ID')); ?></th>
       
      
       
       
 
        <?php if(auth()->check() && auth()->user()->hasRole('admin|owner|driver')): ?>
            <th class="table-web" scope="col"><?php echo e(__('Client')); ?></th>
        <?php endif; ?>
       
        <?php if(auth()->user()->hasRole('owner')): ?>
            <th class="table-web" scope="col"><?php echo e(__('Items')); ?></th>
        <?php endif; ?>
      
        <th class="table-web" scope="col"><?php echo e(__('Price')); ?></th>
      
        <?php if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('owner') || auth()->user()->hasRole('driver')): ?>
            <th scope="col"><?php echo e(__('Actions')); ?></th>
        <?php endif; ?>
    </tr>
</thead>
<tbody>
<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<tr>
    <td >
        
     
             <mods-component  v-bind:roles="<?php echo e(json_encode($order)); ?>"></mods-component>
    </td>
  

    


    <?php if(auth()->check() && auth()->user()->hasRole('admin|owner|driver')): ?>
    <td class="table-web">
       <?php echo e($order['client']); ?>

    </td>
    <?php endif; ?>
  

        <td class="table-web">
            <?php $__currentLoopData = $order['item']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php echo e($item['name']); ?>|
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
        </td>

   
    <td class="table-web">
        <?php echo money($order['price'] , config('settings.cashier_currency'),config('settings.do_convertion')); ?>

    </td>
   
   

        <?php
$lastStatusAlisas=$order['last_status'] ;
?>

   <td>
   
 
                   <?php if($lastStatusAlisas == "Accepted by admin"): ?>
                <a href="<?php echo e(url('updatestatus/accepted_by_restaurant/'.$order['id'].'?dashboard=1')); ?>" class="btn btn-success btn-sm order-action"><?php echo e(__('Accept')); ?></a>
                <a href="<?php echo e(url('updatestatus/rejected_by_restaurant/'.$order['id'].'?dashboard=1')); ?>" class="btn btn-danger btn-sm order-action"><?php echo e(__('Reject')); ?></a>
            <?php elseif($lastStatusAlisas == "Assigned to driver"||$lastStatusAlisas == "Accepted_by_restaurant"): ?>
                <a href="<?php echo e(url('updatestatus/prepared/'.$order['id'].'?dashboard=1')); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Prepared')); ?></a>
            <?php elseif(config('app.allow_self_deliver')&&$lastStatusAlisas == "Accepted by restaurant"): ?>
                <a href="<?php echo e(url('updatestatus/prepared/'.$order['id'].'?dashboard=1')); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Prepared')); ?></a>
            <?php elseif(config('app.allow_self_deliver')&&$lastStatusAlisas == "Prepared "): ?>
                <a href="<?php echo e(url('updatestatus/delivered/'.$order['id'].'?dashboard=1')); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Delivered')); ?></a>
            <?php elseif($lastStatusAlisas == "Prepared"&&$order['delivery_method']=="2"): ?>
                <a href="<?php echo e(url('updatestatus/delivered/'.$order['id'].'?dashboard=1')); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Delivered')); ?></a>
              <?php elseif($lastStatusAlisas == "Prepared"&&$order['delivery_method'] != "2"): ?>

               <?php if($order['driver_id']): ?>

                   <a href="<?php echo e(url('updatestatus/delivered/'.$order['id'].'?dashboard=3')); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Delivered')); ?></a>
                 <?php else: ?>
                        <button type="button" class="btn btn-primary btn-sm order-action" onClick="setCurrentItem(<?php echo e($order['id']); ?>)"  data-toggle="modal" data-target="#modal-asign-driver"><?php echo e(__('Assign to driver')); ?></a> 
                <?php endif; ?>  
            <?php elseif($lastStatusAlisas == "Rejected by driver"&&$order['delivery_method'] != "2"): ?>

               <?php if($order['driver_id']): ?>

                   <a href="<?php echo e(url('updatestatus/delivered/'.$order['id'].'?dashboard=3')); ?>" class="btn btn-primary btn-sm order-action"><?php echo e(__('Delivered')); ?></a>
                 <?php else: ?>
                        <button type="button" class="btn btn-primary btn-sm order-action" onClick="setCurrentItem(<?php echo e($order['id']); ?>)"  data-toggle="modal" data-target="#modal-asign-driver"><?php echo e(__('Assign to driver')); ?></a> 
                <?php endif; ?>  

            <?php else: ?>
                <small><?php echo e(__('No actions for you right now!')); ?></small>
            <?php endif; ?>

     
    </td>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>


        </table>
    </div>
    <?php endif; ?>
    <div class="card-footer py-4">
        <?php if(count($orders)): ?>
        <nav class="d-flex justify-content-end" aria-label="...">
          
        </nav>
        <?php else: ?>
            <h4><?php echo e(__('You don`t have any orders')); ?> ...</h4>
        <?php endif; ?>
    </div>
</div>
                <!-- vinl card -->
            </div>
        </div>
        <?php echo $__env->make('layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('orders.partials.modals2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="modal fade" id="modal-asign-driver" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-title-new-item"><?php echo e(__('Assign Driver')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form id="form-assing-driver" method="GET" action="<?php echo e(url('home')."?status_id=1"); ?>">
                                           <div class="modal-body">
                                        
                                             <input name="orden" id="orden" class="form-control"  type="text"  value="" hidden="true">
                                        </div>
                            
                                <?php echo $__env->make('partials.fields',$fields, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4"><?php echo e(__('Save')); ?></button>
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
                                                                <label class="form-control-label"><?php echo e(__('Select your options')); ?></label>
                                                                <div id="variants-area-inside">
                                                                </div>
                                                            </div>
                                                            <div id="exrtas-area">
                                                                <br />
                                                                <label class="form-control-label" for="quantity"><?php echo e(__('Extras')); ?></label>
                                                                <div id="exrtas-area-inside">
                                                                </div>
                                                            </div>
                                                            <?php if(  !(isset($canDoOrdering)&&!$canDoOrdering)   ): ?>
                                                            <div class="quantity-area">
                                                                <div class="form-group">
                                                                    <br />
                                                                    <label class="form-control-label" for="quantity"><?php echo e(__('Quantity')); ?></label>
                                                                    <input type="number" name="quantity" id="quantity" class="form-control form-control-alternative" placeholder="1" value="1" required autofocus>
                                                                </div>
                                                                <div class="quantity-btn">
                                                                    <div id="addToCart1">
                                                                        <button class="btn btn-primary" v-on:click='addToCartAct'><?php echo e(__('Add To Cart')); ?></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
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
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/aanpdrqr/public_html/resources/views/dashboard.blade.php ENDPATH**/ ?>