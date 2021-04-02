<?php $__env->startSection('admin_title'); ?>
   Empleados
<?php $__env->stopSection(); ?>


 <?php $__env->startSection('content'); ?>
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <!-- Order Card -->
                                <div class="card shadow">
                                    <div class="card-header border-0">
                                        <?php if(count($drivers)): ?>
                                        <form method="GET">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h3 class="mb-0">Pedidos</h3>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <a href="<?php echo e(url('new/employ/register')); ?>" class="btn btn-success btn-sm order-action">Nuevo Empleado</a>
                                                </div>
                                            </div>
                                            <br/>
                                   
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-12">
                                        <?php echo $__env->make('partials.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <?php if(count($drivers)): ?>
                                    <div class="table-responsive">
                                        <table class="table align-items-center">
                                       
                                                             <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col"><?php echo e(__('ID')); ?></th>

                                                                  
                                                                    <th class="table-web" scope="col">Nombre</th>
                                                                    <th class="table-web" scope="col">Estado</th>
                                                                  
                                                                   
                                                                    <th scope="col"><?php echo e(__('Actions')); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $__currentLoopData = $drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td>

                                                                        <a class="btn badge badge-success badge-pill">#<?php echo e($driver->id); ?></a>
                                                                    </td>
                                                          

                                                                 
                                                                    <td class="table-web">
                                                                        <?php echo e($driver->name); ?>

                                                                    </td>
                                                                    <td class="table-web">
                                                                        <?php if($driver->active == 1): ?>
                                                                          Activo
                                                                        <?php else: ?>
                                                                       Desactivado
                                                                           <?php endif; ?>
                                                                    </td>
                                                                           <td class="table-web">
                                                                     <?php if($driver->active == 1): ?>
                                                                                     <a href="<?php echo e(url('employ/updatestatus/0/'.$driver->id )); ?>" class="btn btn-danger btn-sm order-action">Desactivar</a>
                                                                                <?php else: ?>
                                                                                       <a href="<?php echo e(url('employ/updatestatus/1/'.$driver->id )); ?>" class="btn btn-success btn-sm order-action">Activar</a>
                                                                              
                                                                                <?php endif; ?>
                                                                    </td>
                                                                               
                                                                            </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>

                               
                                        </table>
                                    </div>
                                    <?php endif; ?>
                                    <div class="card-footer py-4">
                                      
                                    </div>
                                </div>
        
            </div>
        </div>
        <?php echo $__env->make('layouts.footers.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
       
    </div>


<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.app', ['title' => __('Orders')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\delivery\Admin\resources\views/restorants/employes_list.blade.php ENDPATH**/ ?>