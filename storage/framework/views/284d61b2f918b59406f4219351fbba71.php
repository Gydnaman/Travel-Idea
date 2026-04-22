<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0"><i class="bi bi-building"></i> Local Hotels in <?php echo e($travelIdea->destination); ?></h2>
            <p class="text-muted mb-0 mt-1">Sourced via Makcorps Hotel API</p>
        </div>
        <a href="<?php echo e(route('travel-ideas.show', $travelIdea->id)); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Idea
        </a>
    </div>

    <?php if(isset($hotels) && count($hotels) > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden" style="transition: transform 0.2s;">
                        <img src="<?php echo e($hotel['image']); ?>" class="card-img-top" alt="<?php echo e($hotel['name']); ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body position-relative">
                            <div class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-start shadow-sm" style="margin-top: -15px;">
                                <i class="bi bi-star-fill text-warning me-1"></i> <?php echo e($hotel['rating']); ?>

                            </div>
                            <h5 class="card-title fw-bold text-dark mb-1"><?php echo e($hotel['name']); ?></h5>
                            <p class="text-muted mb-3 small"><i class="bi bi-shop me-1"></i> Provided by <?php echo e($hotel['vendor'] ?? 'Partner'); ?></p>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <span class="fs-4 fw-bold text-success"><?php echo e($hotel['price']); ?></span>
                                <?php 
                                    $vendorName = $hotel['vendor'] ?? 'partner'; 
                                    $hotelName = $hotel['name'];
                                ?>
                                <button onclick="alert('Redirecting to <?php echo e(addslashes($vendorName)); ?> to complete your booking for <?php echo e(addslashes($hotelName)); ?>...')" class="btn btn-outline-primary rounded-pill px-4">Booking Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="text-center py-5">
            <div class="display-1 text-muted mb-3"><i class="bi bi-emoji-frown"></i></div>
            <h4 class="text-muted">No hotels found in this area.</h4>
            <p>We couldn't retrieve hotel data for <?php echo e($travelIdea->destination); ?>. Please check back later.</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\HKU\ICOM6034\TravelIdeas\GroupProject\resources\views/travel_ideas/hotels.blade.php ENDPATH**/ ?>