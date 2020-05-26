@component('activities.activity')
    @slot('heading')
        <a href="{{ $activity->subject->favorited->path() }}">
            {{ $profileUser->first_name .' ' . $profileUser->last_name }} favorited a reply.
        </a>

        {{--<a href="{{ $activity->subject->thread->path() }}">
            "{{ $activity->subject->thread->title }}"
        </a>--}}
    @endslot

    @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot
@endcomponent
