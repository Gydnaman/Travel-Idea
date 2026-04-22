<?php $__env->startSection('content'); ?>
<div class="detail-hero" style="background-image: url('<?php echo e($travelIdea->image_url ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2073&auto=format&fit=crop'); ?>');">
    <div class="container h-100 d-flex flex-column justify-content-end pb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-2">
                <li class="breadcrumb-item"><a href="<?php echo e(route('travel-ideas.index')); ?>" class="text-white-50 text-decoration-none">Browse</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page"><?php echo e($travelIdea->destination); ?></li>
            </ol>
        </nav>
        <h1 class="display-3 text-white fw-bold mb-0"><?php echo e($travelIdea->title); ?></h1>
        <p class="text-white-50 fs-5 mb-5"><i class="bi bi-geo-alt-fill me-2"></i><?php echo e($travelIdea->destination); ?></p>
    </div>
</div>

<div class="container detail-content-wrap">
    <div class="row">
        <!-- Main Content Column -->
        <div class="col-lg-8">
            <div class="card glass-card shadow-lg mb-4">
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="info-icon-box bg-white shadow-sm text-primary" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-right: 15px; font-size: 1.5rem;">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <h5 class="mb-0 fw-bold">Duration</h5>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="fs-5 fw-bold"><?php echo e(\Carbon\Carbon::parse($travelIdea->start_date)->format('M d')); ?> - <?php echo e(\Carbon\Carbon::parse($travelIdea->end_date)->format('M d, Y')); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="info-icon-box bg-white shadow-sm text-warning" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; border-radius: 12px; margin-right: 15px; font-size: 1.5rem;">
                                            <i class="bi bi-wallet2"></i>
                                        </div>
                                        <h5 class="mb-0 fw-bold">Budget</h5>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="fs-5 fw-bold text-primary">$<?php echo e(number_format($travelIdea->budget, 0)); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="fw-bold mb-3">About this Idea</h4>
                    <p class="card-text text-muted fs-5 leading-relaxed mb-4">
                        <?php echo e($travelIdea->description ?? 'No detailed description available for this travel idea yet. Embark on this journey to discover the hidden gems and unique experiences awaiting in ' . $travelIdea->destination . '.'); ?>

                    </p>

                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Activities & Tags</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <?php $__currentLoopData = explode(',', $travelIdea->tags); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge rounded-pill bg-light text-primary border px-4 py-2 fs-6 shadow-sm"><?php echo e(trim($tag)); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <hr class="my-5 opacity-10">



                    <?php if(isset($aviationData) && isset($aviationData['metar'])): ?>
                        <?php $metar = $aviationData['metar']; ?>
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="card border-0 bg-soft-primary shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fw-bold mb-0 text-primary"><i class="bi bi-cloud-sun me-2"></i>Aviation Weather Report (METAR)</h6>
                                            <span class="badge bg-primary rounded-pill"><?php echo e($metar['name'] ?? 'Local Station'); ?></span>
                                        </div>
                                        <div class="row text-center g-3">
                                            <div class="col-3">
                                                <div class="small text-muted">Temperature</div>
                                                <div class="fw-bold fs-5"><?php echo e($metar['temp'] ?? 'N/A'); ?>°C</div>
                                            </div>
                                            <div class="col-3">
                                                <div class="small text-muted">Flight Category</div>
                                                <div class="fw-bold fs-5"><?php echo e($metar['fltCat'] ?? 'VFR'); ?></div>
                                            </div>
                                            <div class="col-3">
                                                <div class="small text-muted">Wind Speed</div>
                                                <div class="fw-bold fs-5"><?php echo e($metar['wspd'] ?? 0); ?> kt</div>
                                            </div>
                                            <div class="col-3">
                                                <div class="small text-muted">Visibility</div>
                                                <div class="fw-bold fs-5"><?php echo e($metar['visib'] ?? 'N/A'); ?> SM</div>
                                            </div>
                                        </div>
                                        <div class="mt-3 small text-muted text-end">
                                            <em>Observed: <?php echo e($metar['reportTime'] ?? 'Recently'); ?></em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Reviews Section -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Community Reviews</h4>
                        <span class="badge bg-soft-primary px-3 py-2 rounded-pill"><?php echo e($travelIdea->comments->count()); ?> Reviews</span>
                    </div>

                    <div id="comments-list" class="mb-5">
                        <?php
                            $topComments = \App\Models\Comment::with('user', 'replies.user')
                                ->withCount([
                                    'interactions as likes_count' => function ($q) { $q->where('type', 'like'); },
                                    'interactions as dislikes_count' => function ($q) { $q->where('type', 'dislike'); }
                                ])
                                ->where('travel_idea_id', $travelIdea->id)
                                ->whereNull('parent_id')
                                ->latest()
                                ->get();
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $topComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="d-flex mb-4 comment-item" data-id="<?php echo e($comment->id); ?>">
                                <div class="comment-avatar me-3 flex-shrink-0">
                                    <?php echo e(strtoupper(substr($comment->user->name, 0, 1))); ?>

                                </div>
                                <div class="flex-grow-1">
                                    <div class="bg-light rounded-4 p-3 position-relative">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <h6 class="fw-bold mb-0"><?php echo e($comment->user->name); ?></h6>
                                            <div class="text-warning small">
                                                <?php for($i = 0; $i < 5; $i++): ?>
                                                    <i class="bi bi-star<?php echo e($i < $comment->rating ? '-fill' : ''); ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-0"><?php echo $comment->content; ?></p>
                                    </div>
                                    
                                    <div class="mt-2 d-flex align-items-center" style="font-size: 0.85rem;">
                                        <small class="text-muted"><?php echo e($comment->created_at->diffForHumans()); ?></small>
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php
                                                $uId = Auth::id();
                                                $liked = $comment->interactions()->where('user_id', $uId)->where('type', 'like')->exists();
                                                $disliked = $comment->interactions()->where('user_id', $uId)->where('type', 'dislike')->exists();
                                            ?>
                                            <button class="btn btn-sm btn-link text-muted ms-3 p-0 px-2 interact-btn" data-type="like" data-id="<?php echo e($comment->id); ?>"><i class="bi bi-hand-thumbs-up<?php echo e($liked ? '-fill' : ''); ?>"></i> <span class="likes-count"><?php echo e($comment->likes_count); ?></span></button>
                                            <button class="btn btn-sm btn-link text-muted p-0 px-2 interact-btn" data-type="dislike" data-id="<?php echo e($comment->id); ?>"><i class="bi bi-hand-thumbs-down<?php echo e($disliked ? '-fill' : ''); ?>"></i> <span class="dislikes-count"><?php echo e($comment->dislikes_count); ?></span></button>
                                            <button class="btn btn-sm btn-link text-muted p-0 px-2 reply-toggle-btn" data-id="<?php echo e($comment->id); ?>">Reply</button>
                                        <?php else: ?>
                                            <span class="text-muted ms-3 p-0 px-2"><i class="bi bi-hand-thumbs-up"></i> <?php echo e($comment->likes_count); ?></span>
                                            <span class="text-muted p-0 px-2"><i class="bi bi-hand-thumbs-down"></i> <?php echo e($comment->dislikes_count); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Reply Form -->
                                    <div class="reply-form mt-2" id="reply-form-<?php echo e($comment->id); ?>" style="display:none;">
                                        <form class="nested-comment-form" data-url="<?php echo e(route('comments.store', $travelIdea->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="parent_id" value="<?php echo e($comment->id); ?>">
                                            <div class="input-group">
                                                <input type="text" name="content" class="form-control form-control-sm" placeholder="Write a reply..." maxlength="255" required>
                                                <button type="submit" class="btn btn-primary btn-sm submit-reply-ajax">Reply</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Nested Replies -->
                                    <div class="replies-container mt-3 ms-2" id="replies-<?php echo e($comment->id); ?>">
                                        <?php $__currentLoopData = $comment->replies()->with('user')->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="d-flex mb-3 comment-item" data-id="<?php echo e($reply->id); ?>">
                                                <div class="comment-avatar me-2 flex-shrink-0" style="width:30px;height:30px;font-size:14px;">
                                                    <?php echo e(strtoupper(substr($reply->user->name, 0, 1))); ?>

                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="bg-light rounded-4 p-2">
                                                        <h6 class="fw-bold mb-0" style="font-size:0.9rem;"><?php echo e($reply->user->name); ?></h6>
                                                        <p class="text-muted mb-0 small"><?php echo $reply->content; ?></p>
                                                    </div>
                                                    <div class="mt-1 d-flex align-items-center" style="font-size: 0.75rem;">
                                                        <small class="text-muted"><?php echo e($reply->created_at->diffForHumans()); ?></small>
                                                        <?php if(auth()->guard()->check()): ?>
                                                            <?php
                                                                $rLiked = $reply->interactions()->where('user_id', Auth::id())->where('type', 'like')->exists();
                                                                $rDisliked = $reply->interactions()->where('user_id', Auth::id())->where('type', 'dislike')->exists();
                                                            ?>
                                                            <button class="btn btn-sm btn-link text-muted ms-2 p-0 px-2 interact-btn" data-type="like" data-id="<?php echo e($reply->id); ?>"><i class="bi bi-hand-thumbs-up<?php echo e($rLiked ? '-fill' : ''); ?>"></i> <span class="likes-count"><?php echo e($reply->interactions()->where('type', 'like')->count()); ?></span></button>
                                                            <button class="btn btn-sm btn-link text-muted p-0 px-2 interact-btn" data-type="dislike" data-id="<?php echo e($reply->id); ?>"><i class="bi bi-hand-thumbs-down<?php echo e($rDisliked ? '-fill' : ''); ?>"></i> <span class="dislikes-count"><?php echo e($reply->interactions()->where('type', 'dislike')->count()); ?></span></button>
                                                        <?php else: ?>
                                                            <span class="text-muted ms-2 p-0 px-2"><i class="bi bi-hand-thumbs-up"></i> <?php echo e($reply->interactions()->where('type', 'like')->count()); ?></span>
                                                            <span class="text-muted p-0 px-2"><i class="bi bi-hand-thumbs-down"></i> <?php echo e($reply->interactions()->where('type', 'dislike')->count()); ?></span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-5 no-reviews">
                                <div class="mb-3 text-muted display-6"><i class="bi bi-chat-dots"></i></div>
                                <p class="text-muted">No reviews yet. Share your thoughts on this idea!</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <div class="bg-light rounded-4 p-4">
                            <h5 class="fw-bold mb-3">Leave a Review</h5>
                            <form id="comment-form" data-url="<?php echo e(route('comments.store', $travelIdea->id)); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="rating" class="form-label small text-muted">Your Rating</label>
                                        <select name="rating" id="rating" class="form-select border-0 shadow-sm">
                                            <option value="5">5 - Excellent</option>
                                            <option value="4">4 - Very Good</option>
                                            <option value="3">3 - Good</option>
                                            <option value="2">2 - Fair</option>
                                            <option value="1">1 - Poor</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="content" class="form-label small text-muted">Your Experience</label>
                                        <textarea name="content" id="content" rows="3" class="form-control border-0 shadow-sm" placeholder="Tell us what you think..." maxlength="255" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary px-4 py-2" id="submit-ajax">
                                            <i class="bi bi-send-fill me-2"></i>Post Review
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4 bg-light rounded-4">
                            <p class="mb-0">Ready to join the conversation? <a href="<?php echo e(route('login')); ?>" class="fw-bold text-decoration-none">Login</a> to leave your review.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 5;">
                <div class="card book-now-card border-0 shadow-lg mb-4">
                    <div class="card-body p-4 text-white">
                        <h5 class="card-title fw-bold mb-3 text-white">Find Accommodation?</h5>
                        <p class="card-text opacity-75 mb-4 text-white">Explore top-rated hotel recommendations around <?php echo e($travelIdea->destination); ?> today!</p>
                        <a href="<?php echo e(route('travel-ideas.hotels', $travelIdea->id)); ?>" class="btn btn-primary w-100 fw-bold shadow-lg">
                            <i class="bi bi-building me-2"></i>FIND LOCAL HOTELS
                        </a>
                        <div class="mt-3 text-center">
                            <small class="opacity-50 text-white"><i class="bi bi-shield-check me-1"></i> Secure Booking Guarantee</small>
                        </div>
                    </div>
                </div>

                <?php if(Auth::id() == $travelIdea->user_id): ?>
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                            <h6 class="fw-bold mb-0">Management Tools</h6>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-grid gap-2">
                                <a href="<?php echo e(route('travel-ideas.edit', $travelIdea->id)); ?>" class="btn btn-warning">
                                    <i class="bi bi-pencil-square me-2"></i>Edit Trip
                                </a>
                                <form action="<?php echo e(route('travel-ideas.destroy', $travelIdea->id)); ?>" method="POST" class="d-grid">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Archive this travel idea?')">
                                        <i class="bi bi-trash3 me-2"></i>Delete Trip
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    let lastCommentId = $('.comment-item').length > 0 ? $('.comment-item').first().data('id') : 0;
    // ensure lastCommentId accurately captures the max id of both top comments and replies
    $('.comment-item').each(function(){
        let id = $(this).data('id');
        if(id > lastCommentId) lastCommentId = id;
    });

    const fetchUrl  = "<?php echo e(route('comments.latest', $travelIdea->id)); ?>";

    function buildCommentHtml(comment) {
        let isReply = comment.parent_id != null;
        let initial = comment.user.name.charAt(0).toUpperCase();
        let dateStr = comment.human_date || 'Just now';
        
        let likes = comment.likes_count || 0;
        let dislikes = comment.dislikes_count || 0;
        let upIcon = comment.user_liked ? '-fill' : '';
        let downIcon = comment.user_disliked ? '-fill' : '';

        // Shared Author/Unauth Interaction Buttons
        let interactionTemplate = "";
        <?php if(auth()->guard()->check()): ?>
            interactionTemplate = `
                <button class="btn btn-sm btn-link text-muted ms-2 p-0 px-2 interact-btn" data-type="like" data-id="${comment.id}"><i class="bi bi-hand-thumbs-up${upIcon}"></i> <span class="likes-count">${likes}</span></button>
                <button class="btn btn-sm btn-link text-muted p-0 px-2 interact-btn" data-type="dislike" data-id="${comment.id}"><i class="bi bi-hand-thumbs-down${downIcon}"></i> <span class="dislikes-count">${dislikes}</span></button>
                ${!isReply ? `<button class="btn btn-sm btn-link text-muted p-0 px-2 reply-toggle-btn" data-id="${comment.id}">Reply</button>` : ''}
            `;
        <?php else: ?>
            interactionTemplate = `
                <span class="text-muted ms-2 p-0 px-2"><i class="bi bi-hand-thumbs-up"></i> ${likes}</span>
                <span class="text-muted p-0 px-2"><i class="bi bi-hand-thumbs-down"></i> ${dislikes}</span>
            `;
        <?php endif; ?>

        if (isReply) {
            return `
            <div class="d-flex mb-3 comment-item" data-id="${comment.id}" style="display:none;">
                 <div class="comment-avatar me-2 flex-shrink-0" style="width:30px;height:30px;font-size:14px;">
                     ${initial}
                 </div>
                 <div class="flex-grow-1">
                     <div class="bg-light rounded-4 p-2">
                        <h6 class="fw-bold mb-0" style="font-size:0.9rem;">${comment.user.name}</h6>
                        <p class="text-muted mb-0 small">${comment.content}</p>
                     </div>
                     <div class="mt-1 d-flex align-items-center" style="font-size:0.75rem;">
                        <small class="text-muted">${dateStr}</small>
                        ${interactionTemplate}
                     </div>
                 </div>
             </div>`;
        }

        let stars = '';
        for(let i=0; i<5; i++) stars += `<i class="bi bi-star${i < comment.rating ? '-fill' : ''}"></i>`;

        return `
        <div class="d-flex mb-4 comment-item" data-id="${comment.id}" style="display:none;">
            <div class="comment-avatar me-3 flex-shrink-0">
                ${initial}
            </div>
            <div class="flex-grow-1">
                <div class="bg-light rounded-4 p-3 position-relative">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <h6 class="fw-bold mb-0">${comment.user.name}</h6>
                        <div class="text-warning small">
                            ${stars}
                        </div>
                    </div>
                    <p class="text-muted mb-0">${comment.content}</p>
                </div>
                
                <div class="mt-2 d-flex align-items-center" style="font-size: 0.85rem;">
                    <small class="text-muted">${dateStr}</small>
                    ${interactionTemplate}
                </div>

                <div class="reply-form mt-2" id="reply-form-${comment.id}" style="display:none;">
                    <form class="nested-comment-form" data-url="${ $('#comment-form').length ? $('#comment-form').data('url') : '' }">
                        <input type="hidden" name="parent_id" value="${comment.id}">
                        <div class="input-group">
                            <input type="text" name="content" class="form-control form-control-sm" placeholder="Write a reply..." maxlength="255" required>
                            <button type="submit" class="btn btn-primary btn-sm submit-reply-ajax">Reply</button>
                        </div>
                    </form>
                </div>

                <div class="replies-container mt-3 ms-2" id="replies-${comment.id}"></div>
            </div>
        </div>`;
    }

    // Polling Mechanism
    setInterval(function(){
        $.get(fetchUrl, { last_comment_id: lastCommentId }, function(response){
            if(response.success && response.comments.length > 0){
                $('.no-reviews').hide();
                response.comments.forEach(function(comment){
                    if($('.comment-item[data-id="'+comment.id+'"]').length === 0){
                        let $html = $(buildCommentHtml(comment));
                        
                        if (comment.parent_id) {
                            let $container = $('#replies-' + comment.parent_id);
                            if ($container.length) {
                                $container.append($html);
                                $html.slideDown();
                            }
                        } else {
                            $('#comments-list').prepend($html);
                            $html.slideDown();
                        }
                        
                        if(comment.id > lastCommentId) lastCommentId = comment.id;
                    }
                });
            }
        });
    }, 5000);

    // Primary Formulation Submit
    $('#comment-form').on('submit', function(e) {
        e.preventDefault();
        
        let $btn = $('#submit-ajax');
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Posting...');
        
        let formData = {
            rating: $('#rating').val(),
            content: $('#content').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        
        $.ajax({
            url: $(this).data('url'),
            method: 'POST',
            data: formData,
            success: function(response){
                if(response.success){
                    $('#content').val('');
                    if(response.comment.id > lastCommentId) lastCommentId = response.comment.id;
                    $('.no-reviews').hide();
                    let $html = $(buildCommentHtml(response.comment));
                    $('#comments-list').prepend($html);
                    $html.slideDown();
                }
            },
            error: function(err){
                alert('Errors occurred or text size exceeded 255 chars!');
            },
            complete: function() {
                $btn.prop('disabled', false).html('<i class="bi bi-send-fill me-2"></i>Post Review');
            }
        });
    });

    // Nested Reply form toggle
    $(document).on('click', '.reply-toggle-btn', function() {
        $('#reply-form-' + $(this).data('id')).slideToggle('fast');
    });

    // Nested Form Submit
    $(document).on('submit', '.nested-comment-form', function(e) {
        e.preventDefault();
        let $form = $(this);
        let $btn = $form.find('.submit-reply-ajax');
        $btn.prop('disabled', true).text('...');
        
        let formData = {
            content: $form.find('input[name="content"]').val(),
            parent_id: $form.find('input[name="parent_id"]').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        };
        
        $.ajax({
            url: $form.data('url'),
            method: 'POST',
            data: formData,
            success: function(response){
                if(response.success){
                    $form.find('input[name="content"]').val('');
                    if(response.comment.id > lastCommentId) lastCommentId = response.comment.id;
                    let $html = $(buildCommentHtml(response.comment));
                    $('#replies-' + formData.parent_id).append($html);
                    $html.slideDown();
                    $form.parent().slideUp('fast'); // Hide form on success
                }
            },
            error: function(){
                alert('Could not submit reply. Limit to 255 characters.');
            },
            complete: function() {
                $btn.prop('disabled', false).text('Reply');
            }
        });
    });

    // Like Dislike Interaction Submit
    $(document).on('click', '.interact-btn', function() {
        let type = $(this).data('type');
        let commentId = $(this).data('id');
        let $interactDiv = $(this).parent();

        $.ajax({
            url: `/comments/${commentId}/interaction`,
            method: 'POST',
            data: {
                type: type,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                if(response.success){
                    // Update counts purely via response
                    $interactDiv.find('.likes-count').text(response.likes);
                    $interactDiv.find('.dislikes-count').text(response.dislikes);
                    
                    // Simple Icon Toggle Visual logic (Server is source of truth, but UI gives feedback)
                    // Reset all
                    $interactDiv.find('.bi-hand-thumbs-up-fill').removeClass('bi-hand-thumbs-up-fill').addClass('bi-hand-thumbs-up');
                    $interactDiv.find('.bi-hand-thumbs-down-fill').removeClass('bi-hand-thumbs-down-fill').addClass('bi-hand-thumbs-down');
                    
                    // Apply visual active state (this isn't perfect, just a quick visual update)
                    if (type === 'like' && response.likes > 0) {
                        $interactDiv.find('button[data-type="like"] i').removeClass('bi-hand-thumbs-up').addClass('bi-hand-thumbs-up-fill');
                    } else if (type === 'dislike' && response.dislikes > 0) {
                        $interactDiv.find('button[data-type="dislike"] i').removeClass('bi-hand-thumbs-down').addClass('bi-hand-thumbs-down-fill');
                    }
                }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Lenovo\Desktop\HKU\ICOM6034\GroupProject\resources\views\travel_ideas\show.blade.php ENDPATH**/ ?>