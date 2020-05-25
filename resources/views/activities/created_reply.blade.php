@component('activities.activity')
    @slot('heading')
        {{ $profileUser->first_name .' ' . $profileUser->last_name }} replied to
        <a href="{{ $activity->subject->thread->path() }}">
            "{{ $activity->subject->thread->title }}"
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
