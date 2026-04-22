<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-bold">Booking Details #<?php echo e($booking->id); ?></h5>
                </div>
                <div class="card-body p-4 bg-light">
                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Customer Name</div>
                            <div class="col-sm-8"><?php echo e($booking->name); ?></div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Email Address</div>
                            <div class="col-sm-8"><a href="mailto:<?php echo e($booking->email); ?>"><?php echo e($booking->email); ?></a></div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Phone Number</div>
                            <div class="col-sm-8"><?php echo e($booking->phone); ?></div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Travel Package / Idea</div>
                            <div class="col-sm-8 text-primary fw-bold"><?php echo e($booking->item_name); ?></div>
                        </div>
                        <div class="row mb-3 border-bottom pb-2">
                            <div class="col-sm-4 text-muted fw-bold">Preferred Booking Date</div>
                            <div class="col-sm-8"><?php echo e($booking->booking_date); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted fw-bold">Request Created At</div>
                            <div class="col-sm-8"><?php echo e($booking->created_at->format('Y-m-d H:i:s')); ?></div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mb-4">
                        <a href="<?php echo e(route('bookings.index')); ?>" class="btn btn-outline-secondary px-4 py-2">
                            <i class="bi bi-arrow-left me-2"></i>Back to Requests
                        </a>
                    </div>
                    
                    <?php if(isset($hotels) && count($hotels) > 0): ?>
                        <div class="mt-5">
                            <h4 class="fw-bold mb-4 border-bottom pb-2 text-primary">
                                <i class="bi bi-building me-2"></i>Recommended Hotels via Makcorps API
                                <br><small class="text-muted fs-6" style="font-weight: normal;">Based on your destination: <?php echo e($booking->item_name); ?></small>
                            </h4>
                            <div class="row g-4">
                                <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4">
                                        <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden" style="transition: transform 0.2s;">
                                            <img src="<?php echo e($hotel['image']); ?>" class="card-img-top" alt="<?php echo e($hotel['name']); ?>" style="height: 180px; object-fit: cover;">
                                            <div class="card-body position-relative">
                                                <div class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-start shadow-sm" style="margin-top: -15px;">
                                                    <i class="bi bi-star-fill text-warning me-1"></i> <?php echo e($hotel['rating']); ?>

                                                </div>
                                                <h5 class="card-title fw-bold text-dark mb-1"><?php echo e($hotel['name']); ?></h5>
                                                <p class="text-muted mb-3 small"><i class="bi bi-shop me-1"></i> <?php echo e($hotel['vendor'] ?? 'Partner OTA'); ?></p>
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <span class="fs-5 fw-bold text-success"><?php echo e($hotel['price']); ?></span>
                                                    <button onclick="alert('Redirecting to <?php echo e($hotel['vendor'] ?? 'our partner'); ?> to complete your booking for <?php echo e(addslashes($hotel['name'])); ?>...')" class="btn btn-sm btn-outline-primary rounded-pill px-3">Booking Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\HKU\ICOM6034\GroupProject\resources\views\travel_bookings\show.blade.php ENDPATH**/ ?>