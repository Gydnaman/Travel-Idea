<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Advanced Search</div>
                <div class="card-body">
                    <form action="<?php echo e(route('travel-ideas.advanced-search')); ?>" method="GET">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?php echo e(request('title')); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" name="destination" id="destination" class="form-control" value="<?php echo e(request('destination')); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" name="tags" id="tags" class="form-control" value="<?php echo e(request('tags')); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Find Ideas</button>
                    </form>
                </div>
            </div>

            <?php if($hasSearch): ?>
                <div id="advanced-results">
                    <h3>Search Results</h3>
                    <?php echo $__env->make('travel_ideas.partials.search_results', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\HKU\ICOM6034\GroupProject\resources\views/travel_ideas/advanced_search.blade.php ENDPATH**/ ?>