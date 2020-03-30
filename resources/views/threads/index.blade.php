@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Forum Threads</h2></div>
                        @foreach($threads as $thread)
                            <div class="card-body">
                                <article>
                                    <div class="level">
                                        <h4 class="flex-grow-1">
                                            <a href="{{ $thread->path() }}">
                                                {{ $thread->title }}
                                            </a>
                                        </h4>
                                        <strong>{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</strong>
                                    </div>
                                    <h6>Posted by {{ $thread->creator->first_name }} {{ $thread->creator->last_name }}</h6>
                                    <div class="body">{{ $thread->body }}</div>
                                </article>
                            </div>
                            <hr/>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
