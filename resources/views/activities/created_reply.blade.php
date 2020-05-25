<div class="card mt-4">
    <div class="card-header">
        <div class="level">
            <span class="flex-grow-1">
                {{ $profileUser->first_name .' ' . $profileUser->last_name }} replied to
                <a href="{{ $activity->subject->thread->path() }}">"{{ $activity->subject->thread->title }}"</a>
            </span>
        </div>
    </div>

    <div class="card-body">
        {{ $activity->subject->body }}
    </div>
</div>
