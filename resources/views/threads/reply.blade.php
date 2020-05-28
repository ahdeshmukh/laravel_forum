<div id="reply-{{ $reply->id }}" class="card">
    <div class="card-header">
        <div class="level">
            <div class="flex-fill">
                <a href="{{ route('profile', $reply->owner->id) }}">
                    {{ $reply->owner->first_name }} {{ $reply->owner->last_name }}
                </a> said {{ $reply->created_at->diffForHumans() }}...
            </div>
            <div>
                <form method="POST" action="/replies/{{$reply->id}}/favorites">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-secondary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>

    @can('update', $reply)
        <div class="card-footer">
            <form method="POST" action="/replies/{{ $reply->id }}" >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        </div>
    @endcan
</div>
