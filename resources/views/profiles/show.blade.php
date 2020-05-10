@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pb-2 mt-4 mb-2 border-bottom">
            <!-- https://stackoverflow.com/questions/49707845/how-to-create-a-page-header-in-bootstrap-4 -->
            <h1>
                {{ $profileUser->first_name . ' ' . $profileUser->last_name }}
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </h1>
        </div>

        @foreach($threads as $thread)
            <div class="card mt-4">
                <div class="card-header">
                    <div class="level">
                       <span class="flex-grow-1">
                           <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->first_name . ' ' . $thread->creator->last_name }}</a> posted:
                           <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                       </span>

                        <span>{{ $thread->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>
        @endforeach
        <div class="mt-4">
            {{ $threads->links() }}
        </div>
    </div>
@endsection
