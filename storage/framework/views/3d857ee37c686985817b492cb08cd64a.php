<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>All Booking Requests</h1>
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Item</th>
                            <th>Date</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($booking->id); ?></td>
                            <td><?php echo e($booking->name); ?></td>
                            <td><?php echo e($booking->email); ?></td>
                            <td><?php echo e($booking->item_name); ?></td>
                            <td><?php echo e($booking->booking_date); ?></td>
                            <td><?php echo e($booking->created_at->format('Y-m-d H:i')); ?></td>
                            <td>
                                <a href="<?php echo e(route('bookings.show', $booking->id)); ?>" class="btn action-btn btn-sm btn-info text-white">View</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center">No bookings found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\HKU\ICOM6034\GroupProject\resources\views\travel_bookings\index.blade.php ENDPATH**/ ?>