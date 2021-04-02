<ul class="navbar-nav">
   

    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('service.edit',  auth()->user()->restorant->id)); ?>">
            <i class="ni ni-shop text-info"></i> Mi Negocio
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('items.index')); ?>">
            <i class="ni ni-collection text-pink"></i> Servicios
        </a>
    </li>

  <!--   <?php if(config('app.isqrsaas') && (!config('settings.qrsaas_disable_odering') || config('settings.enable_guest_log'))): ?>
        <?php if(!config('settings.is_whatsapp_ordering_mode')): ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('admin.restaurant.tables.index')); ?>">
                    <i class="ni ni-ungroup text-red"></i> <?php echo e(__('Tables')); ?>

                </a>
            </li>
        <?php endif; ?>
    <?php endif; ?>
 -->

 <!--    <?php if(config('settings.enable_pricing')): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('plans.current')); ?>">
                <i class="ni ni-credit-card text-orange"></i> <?php echo e(__('Plan')); ?>

            </a>
        </li>
    <?php endif; ?> -->



          <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>">
            <i class="ni ni-collection text-pink"></i> Mi cuenta
        </a>
        </li>
        <!--
        <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('admin.restaurant.coupons.index')); ?>">
                <i class="ni ni-tag text-pink"></i> <?php echo e(__('Coupons')); ?>

            </a>
        </li>
    -->


    <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('share.menu')); ?>">
                <i class="ni ni-send text-green"></i> Compartir
            </a>
    </li>

</ul>
<?php /**PATH C:\xampp\htdocs\delivery\Admin\resources\views/layouts/navbars/menus/service.blade.php ENDPATH**/ ?>