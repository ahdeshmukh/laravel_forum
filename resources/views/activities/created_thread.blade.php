@component('activities.activity')
    @slot('heading')
        {{ $profileUser->first_name .' ' . $profileUser->last_name }} published
        <a href="{{$activity->subject->path()}}">
            "{{$activity->subject->title}}"
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
