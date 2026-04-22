<?php if($travelIdeas instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
    <h5 class="mb-3 text-secondary">Total Match: <?php echo e($travelIdeas->total()); ?> records</h5>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Destination</th>
                <th>Date (MM/YYYY)</th>
                <th>Comments</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $travelIdeas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($idea->title); ?></td>
                <td><?php echo e($idea->destination); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($idea->start_date)->format('m/Y')); ?></td>
                <td><span class="badge bg-secondary"><?php echo e($idea->comments_count); ?></span></td>
                <td><span class="badge bg-info text-dark"><?php echo e($idea->tags); ?></span></td>
                <td class="d-flex gap-2">
                    <a href="<?php echo e(route('travel-ideas.show', $idea->id)); ?>" class="btn action-btn btn-primary">View</a>
                    <?php if(Auth::id() == $idea->user_id): ?>
                        <a href="<?php echo e(route('travel-ideas.edit', $idea->id)); ?>" class="btn action-btn btn-warning">Edit</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6" class="text-center">No travel ideas found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-3">
    <?php echo e($travelIdeas->links()); ?>

</div>
<?php /**PATH C:\Users\Lenovo\Desktop\HKU\ICOM6034\TravelIdeas\GroupProject\resources\views/travel_ideas/partials/search_results.blade.php ENDPATH**/ ?>