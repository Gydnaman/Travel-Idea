<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1>Browse Travel Ideas</h1>
        </div>
        <div class="col-auto">
            <a href="<?php echo e(route('travel-ideas.create')); ?>" class="btn btn-success">Add New Idea</a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <div class="input-group">
                <input type="text" id="search" name="q" class="form-control" placeholder="Search by title, destination, or tags..." aria-label="Search">
                <button class="btn btn-primary" type="button" id="search-btn">Search</button>
            </div>
        </div>
    </div>

    <div id="results-container">
        <?php echo $__env->make('travel_ideas.partials.search_results', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    function fetchResults(query = '', page = 1) {
        $.ajax({
            url: "<?php echo e(route('travel-ideas.search')); ?>",
            method: 'GET',
            data: { q: query, page: page },
            success: function(data) {
                $('#results-container').html(data);
            }
        });
    }

    $('#search-btn').on('click', function() {
        let query = $('#search').val();
        fetchResults(query);
    });

    $('#search').on('keyup', function(e) {
        if (e.keyCode === 13) {
            let query = $(this).val();
            fetchResults(query);
        }
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let query = $('#search').val();
        fetchResults(query, page);
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\HKU\ICOM6034\GroupProject\resources\views\travel_ideas\index.blade.php ENDPATH**/ ?>