<?php $__env->startSection('content'); ?>
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
                                <h3 class="mb-0"><?php echo e("#".$order->id." - ".$order->created_at->format(config('settings.datetime_display_format'))); ?></h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-sm btn-primary"><?php echo e(__('Back')); ?></a>
                            </div>
                        </div>
                    </div>
                <div class="card-body">

                        <?php if(config('app.isft')): ?>
         <h6 class="heading-small text-muted mb-4"><?php echo e(__('Client Information')); ?></h6>
         <div class="pl-lg-4">
             <h3><?php echo e($order->client->name); ?></h3>
             <h4><?php echo e($order->client->email); ?></h4>
            
              <?php if($order->address): ?>
             <a href="https://www.google.com/maps/place/<?php echo e($order->address->address); ?>"><?php echo e($order->address->address); ?></a><br>
              <?php endif; ?>
             <?php if(!empty($order->address->apartment)): ?>
                 <h4><?php echo e(__("Apartment number")); ?>: <?php echo e($order->address->apartment); ?></h4>
             <?php endif; ?>
             <?php if(!empty($order->address->entry)): ?>
                 <h4><?php echo e(__("Entry number")); ?>: <?php echo e($order->address->entry); ?></h4>
             <?php endif; ?>
             <?php if(!empty($order->address->floor)): ?>
                 <h4><?php echo e(__("Floor")); ?>: <?php echo e($order->address->floor); ?></h4>
             <?php endif; ?>
             <?php if(!empty($order->address->intercom)): ?>
                 <h4><?php echo e(__("Intercom")); ?>: <?php echo e($order->address->intercom); ?></h4>
             <?php endif; ?>
             <?php if(!empty($order->client->phone)): ?>
             <br/>
             <h4><?php echo e(__('Contact')); ?>:</h4>
                   <a href="tel:<?php echo e($order->client->phone); ?>"><?php echo e($order->client->phone); ?> </a> 
             <?php endif; ?>
         </div>
         <hr class="my-4" />
   
        
     <?php endif; ?>
<!--     <h6 class="heading-small text-muted mb-4"><?php echo e(__('Restaurant information')); ?></h6>
     <?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <div class="pl-lg-4">
         <h3><?php echo e($order->restorant->name); ?></h3>
          <a href="https://www.google.com/maps/place/<?php echo e($order->restorant->address); ?>"><?php echo e($order->restorant->address); ?></a><br>

         <a href="tel:<?php echo e($order->restorant->phone); ?>"><?php echo e($order->restorant->phone); ?> </a> 
    
         <h4><?php echo e($order->restorant->user->name.", ".$order->restorant->user->email); ?></h4>
     </div>
     <hr class="my-4" /> -->
 
 
     
 
 
     
     <h6 class="heading-small text-muted mb-4"><?php echo e(__('Order')); ?></h6>
     <?php 
                 $currency=config('settings.cashier_currency');
                 $convert=config('settings.do_convertion');
             ?>
  
    
     <hr />
     <?php if(config('app.isft')): ?>
         <h4><?php echo e(__("Delivery method")); ?>: <?php echo e($order->delivery_method==1?__('Delivery'):__('Pickup')); ?></h4>
       
     <?php else: ?>
         <h4><?php echo e(__("Dine method")); ?>: <?php echo e($order->delivery_method==3?__('Dine in'):__('Takeaway')); ?></h4>
    
     <?php endif; ?>
 
 
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
         <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php 
                 $theItemPrice= ($item->pivot->variant_price?$item->pivot->variant_price:$item->price);
             ?>
             <li><h4><?php echo e($item->pivot->qty." X ".$item->name); ?> -  <?php echo money($theItemPrice, $currency,$convert); ?>  =  ( <?php echo money($item->pivot->qty*$theItemPrice, $currency,true); ?> )
                 <?php if(auth()->check() && auth()->user()->hasRole('admin|driver|owner')): ?>
                     <?php if($item->pivot->vatvalue>0): ?>)
                     <span class="small">-- <?php echo e(__('VAT ').$item->pivot->vat."%: "); ?> ( <?php echo money($item->pivot->vatvalue, $currency,$convert); ?> )</span>
                     <?php endif; ?>
                 <?php endif; ?>
             </h4>
                 <?php if(strlen($item->pivot->variant_name)>2): ?>
                     <br />
                     <table class="table align-items-center">
                         <thead class="thead-light">
                             <tr>
                                 <?php $__currentLoopData = $item->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <th><?php echo e($option->name); ?></th>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
 
                             </tr>
                         </thead>
                         <tbody class="list">
                             <tr>
                                 <?php $__currentLoopData = explode(",",$item->pivot->variant_name); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <td><?php echo e($optionValue); ?></td>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </tr>
                         </tbody>
                     </table>
                 <?php endif; ?>
 
                 <?php if(strlen($item->pivot->extras)>2): ?>
                     <br /><span><?php echo e(__('Extras')); ?></span><br />
                     <ul>
                         <?php $__currentLoopData = json_decode($item->pivot->extras); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <li> <?php echo e($extra); ?></li>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </ul><br />
                 <?php endif; ?>
                 <br />
             </li>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </ul>
      <?php if(!empty($order->comment)): ?>
        <br/>
        <h4><?php echo e(__('Comment')); ?>: <?php echo e($order->comment); ?></h4>
     <?php endif; ?>
     <?php if(strlen($order->phone)>2): ?>
        <h4><?php echo e(__('Phone')); ?>: <?php echo e($order->phone); ?></h4>
     <?php endif; ?>
     <br />

     <?php if(auth()->check() && auth()->user()->hasRole('admin|driver|owner')): ?>
     <h5><?php echo e(__("NET")); ?>: <?php echo money($order->order_price-$order->vatvalue, $currency ,true); ?></h5>
     <h5><?php echo e(__("VAT")); ?>: <?php echo money($order->vatvalue, $currency,$convert); ?></h5>
 
     <?php endif; ?>
     <h4><?php echo e(__("Sub Total")); ?>: <?php echo money($order->order_price, $currency,$convert); ?></h4>
     <?php if(config('app.isft')): ?>
     <h4><?php echo e(__("Delivery")); ?>: <?php echo money($order->delivery_price, $currency,$convert); ?></h4>
     <?php endif; ?>
     <hr />
     <h3><?php echo e(__("TOTAL")); ?>: <?php echo money($order->delivery_price+$order->order_price, $currency,true); ?></h3>
     <hr />
     <h4><?php echo e(__("Payment method")); ?>: <?php echo e(__(strtoupper($order->payment_method))); ?></h4>
     <h4><?php echo e(__("Payment status")); ?>: <?php echo e(__(ucfirst($order->payment_status))); ?></h4>
     <?php if($order->payment_status=="unpaid"&&strlen($order->payment_link)>5): ?>
         <button onclick="location.href='<?php echo e($order->payment_link); ?>'" class="btn btn-success"><?php echo e(__('Pay now')); ?></button>
     <?php endif; ?>
      </div>
    </div>
  </div>


</div>







                   <!-- <?php echo $__env->make('orders.partials.actions.buttons',['order'=>$order], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> -->
                </div>
            </div>
            <div class="col-xl-5  mb-5 mb-xl-0">
          
                <br/>
                <div class="card card-profile shadow">
                    <div class="card-header">
                        <h5 class="h3 mb-0"><?php echo e(__("Status History")); ?></h5>
                    </div>
                    <?php echo $__env->make('orders.partials.orderstatus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                </div>
                <?php if(auth()->user()->hasRole('client')): ?>
                <?php if($order->status->pluck('alias')->last() == "delivered"): ?>
                    <br/>
                    <?php echo $__env->make('orders.partials.rating',['order'=>$order], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $__env->make('layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('orders.partials.modals',['order'=>$order], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
    <link type="text/css" href="<?php echo e(asset('custom')); ?>/css/rating.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Google Map -->
<script async defer src= "https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=<?php echo config('settings.google_maps_api_key'); ?>"> </script>
  

    <script src="<?php echo e(asset('custom')); ?>/js/ratings.js"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', ['title' => __('Orders')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/aanpdrqr/public_html/resources/views/orders/show2.blade.php ENDPATH**/ ?>