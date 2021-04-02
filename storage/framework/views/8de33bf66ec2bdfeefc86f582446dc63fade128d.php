<a href="#" class="btn btn-neutral btn-icon web-menu" data-toggle="dropdown" role="button">
    <span class="btn-inner--icon">
        <i class="fa fa-user mr-2"></i>
      </span>
    <span class="nav-link-inner--text"><?php echo e(Auth::user()->name); ?></span>
</a>
<a href="#" class="nav-link nav-link-icon mobile-menu" data-toggle="dropdown" role="button">
    <span class="btn-inner--icon">
        <i class="fa fa-user mr-2"></i>
      </span>
    <span class="nav-link-inner--text"><?php echo e(Auth::user()->name); ?></span>
</a>
<div class="dropdown-menu">
    <a href="/profile" class="dropdown-item">My Prefile</a>
    <?php if(auth()->user()->hasRole('admin')): ?>
        <a href="/home" class="dropdown-item"><?php echo e(__('Dashboard')); ?></a>
        <a class="dropdown-item " href="/live"><?php echo e(__('Live Orders')); ?></a>
        <a href="/orders" class="dropdown-item"><?php echo e(__('Orders')); ?></a>
        <a href="/restaurants" class="dropdown-item"><?php echo e(__('Restaurants')); ?></a>
        <a href="<?php echo e(route('reviews.index')); ?>" class="dropdown-item"><?php echo e(__('Reviews')); ?></a>
        <?php if(config('settings.multi_city')): ?>
            <a href="<?php echo e(route('cities.index')); ?>" class="dropdown-item"><?php echo e(__('Cities')); ?></a>
        <?php endif; ?>
        <a href="/drivers" class="dropdown-item"><?php echo e(__('Drivers')); ?></a>
        <a href="/clients" class="dropdown-item"><?php echo e(__('Clients')); ?></a>
        <a href="/pages" class="dropdown-item"><?php echo e(__('Pages')); ?></a>
        <?php if(config('settings.enable_pricing')): ?>
            <a href="<?php echo e(route('plans.index')); ?>" class="dropdown-item"><?php echo e(__('Pricing plans')); ?></a>
        <?php endif; ?>
        <?php if(config('app.ordering')&&config('settings.enable_finances_admin')): ?>
            <a href="<?php echo e(route('finances.admin')); ?>" class="dropdown-item"><?php echo e(__('Finances')); ?></a>
        <?php endif; ?>
        <a href="/settings" class="dropdown-item"><?php echo e(__('Settings')); ?></a>
    <?php endif; ?>
    <?php if(auth()->user()->hasRole('owner')): ?>
        <a href="/home" class="dropdown-item"><?php echo e(__('Dashboard')); ?></a>
        <a class="dropdown-item " href="/live"><?php echo e(__('Live Orders')); ?></a>
        <a href="/orders" class="dropdown-item"><?php echo e(__('Orders')); ?></a>
        <a href="<?php echo e(route('admin.restaurants.edit', auth()->user()->restorant->id)); ?>" class="dropdown-item"><?php echo e(__('Restaurant')); ?></a>
        <a href="/items" class="dropdown-item"><?php echo e(__('Menu')); ?></a>
        <?php if(config('app.ordering')&&config('settings.enable_finances_owner')): ?>
            <a href="<?php echo e(route('finances.owner')); ?>" class="dropdown-item"><?php echo e(__('Finances')); ?></a>
        <?php endif; ?>
        <?php if(config('settings.enable_pricing')): ?>
            <a href="<?php echo e(route('plans.current')); ?>" class="dropdown-item"><?php echo e(__('Plan')); ?></a>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->user()->hasRole('client')): ?>
        <a href="/linklist" class="dropdown-item">Listado de Links</a>
        <a href="/" class="dropdown-item">Restaurante</a>
        <a href="/shop" class="dropdown-item">Tiendas</a>
        <a href="/service" class="dropdown-item">Servicios</a>
        <a href="/orders" class="dropdown-item">Mis Ordeness</a>
        <a href="/addresses" class="dropdown-item">Mis direcciones</a>
    <?php endif; ?>
    <?php if(auth()->user()->hasRole('driver')): ?>
        <a href="/orders" class="dropdown-item"><?php echo e(__('Orders')); ?></a>
    <?php endif; ?>

   <a href="<?php echo e(route('logout')); ?>" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span>Cerrar sesion</span>
    </a>
</div>
<?php /**PATH C:\xampp\htdocs\delivery\Admin\resources\views/layouts/menu/partials/authn.blade.php ENDPATH**/ ?>