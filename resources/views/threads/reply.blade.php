<div class="card">
    <div class="card-header">
        <div class="level">
            <div class="flex-fill">
                <a href="#">
                    {{ $reply->owner->first_name }} {{ $reply->owner->last_name }}
                </a> said {{ $reply->created_at->diffForHumans() }}...
            </div>
            <div>
                <form method="POST" action="/replies/{{$reply->id}}/favorites">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-secondary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites()->count() }} {{ Str::plural('Favorite', $reply->favorites()->count()) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>
