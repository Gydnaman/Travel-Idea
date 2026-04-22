@if($travelIdeas instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <h5 class="mb-3 text-secondary">Total Match: {{ $travelIdeas->total() }} records</h5>
@endif

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
            @forelse($travelIdeas as $idea)
            <tr>
                <td>{{ $idea->title }}</td>
                <td>{{ $idea->destination }}</td>
                <td>{{ \Carbon\Carbon::parse($idea->start_date)->format('m/Y') }}</td>
                <td><span class="badge bg-secondary">{{ $idea->comments_count }}</span></td>
                <td><span class="badge bg-info text-dark">{{ $idea->tags }}</span></td>
                <td class="d-flex gap-2">
                    <a href="{{ route('travel-ideas.show', $idea->id) }}" class="btn action-btn btn-primary">View</a>
                    @if(Auth::id() == $idea->user_id)
                        <a href="{{ route('travel-ideas.edit', $idea->id) }}" class="btn action-btn btn-warning">Edit</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No travel ideas found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $travelIdeas->links() }}
</div>
