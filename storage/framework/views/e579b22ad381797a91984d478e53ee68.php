<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4 text-center">Our Travel Agencies & Partners</h1>
    
    <div class="row mb-5">
        <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <img src="<?php echo e(asset('Images/photos/' . $photo)); ?>" class="card-img-top" alt="Travel Photo" onerror="this.src='https://via.placeholder.com/400x300?text=<?php echo e($photo); ?>'">
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="row">
        <?php $__empty_1 = true; $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary"><?php echo e($store->store_name); ?></h5>
                    <p class="card-text"><strong>Address:</strong> <?php echo e($store->store_address); ?></p>
                    <p class="card-text"><strong>Tel:</strong> <?php echo e($store->tel_no); ?></p>
                    <?php if($store->email): ?>
                    <p class="card-text"><strong>Email:</strong> <?php echo e($store->email); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12 text-center">
            <div class="alert alert-info">No agencies found in the database.</div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\HKU\ICOM6034\GroupProject\resources\views/stores/index.blade.php ENDPATH**/ ?>