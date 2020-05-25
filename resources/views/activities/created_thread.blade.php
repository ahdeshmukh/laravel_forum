<div class="card mt-4">
    <div class="card-header">
        <div class="level">
            <span class="flex-grow-1">
                {{ $profileUser->first_name .' ' . $profileUser->last_name }} published
                <a href="{{$activity->subject->path()}}">"{{$activity->subject->title}}"</a>
            </span>
        </div>
    </div>

    <div class="card-body">
        {{ $activity->subject->body }}
    </div>
</div>
