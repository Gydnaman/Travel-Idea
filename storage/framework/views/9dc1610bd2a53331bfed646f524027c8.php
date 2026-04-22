<?php $__env->startSection('content'); ?>
<div class="hero-section text-center">
    <div class="container">
        <h1 class="display-4">Welcome to Travel Ideas</h1>
        <p class="lead">Discover your next adventure with us.</p>
        <div class="mt-4">
            <a href="<?php echo e(route('travel-ideas.index')); ?>" class="btn btn-primary btn-lg">Browse Ideas</a>
            <a href="<?php echo e(route('travel-ideas.advanced-search')); ?>" class="btn btn-outline-secondary btn-lg">Advanced Search</a>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center mb-4">
            <h2>Recommended Ideas</h2>
        </div>
        <?php $__currentLoopData = $randomIdeas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <div class="card mb-4 border-0 shadow h-100 trip-card" style="border-radius: 20px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                <div class="card-body p-4 d-flex flex-column position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h4 class="card-title mb-0 fw-bold" style="color: #2c3e50; letter-spacing: -0.5px;"><?php echo e($idea->title); ?></h4>
                        <span class="badge rounded-pill border shadow-sm px-3 py-2 fs-6" style="background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%); color: #4a90e2;">
                            <i class="bi bi-geo-alt-fill me-1"></i><?php echo e($idea->destination); ?>

                        </span>
                    </div>
                    <p class="card-text text-muted flex-grow-1" style="line-height: 1.6; font-size: 1.05rem;">
                        <?php echo e(Str::limit($idea->description ?? 'No description provided.', 90)); ?>

                    </p>
                    <div class="mt-2 mb-4 d-flex flex-wrap gap-2">
                        <?php $__currentLoopData = explode(',', $idea->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($loop->index < 3): ?>
                                <span class="badge rounded-pill px-3 py-2 fs-6 shadow-sm" style="background-color: #ebf5ff; color: #0066cc; font-weight: 500;">
                                    <?php echo e(trim($tag)); ?>

                                </span>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top border-light">
                        <a href="<?php echo e(route('travel-ideas.show', $idea->id)); ?>" class="btn btn-primary px-4 py-2 fw-bold" style="border-radius: 12px; background: linear-gradient(135deg, #0ba360 0%, #3cba92 100%); border: none;">
                            Explore Trip <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                        <small class="text-secondary fw-medium"><i class="bi bi-clock me-1"></i><?php echo e($idea->created_at->diffForHumans()); ?></small>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<style>
.trip-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\HKU\ICOM6034\GroupProject\resources\views\welcome.blade.php ENDPATH**/ ?>