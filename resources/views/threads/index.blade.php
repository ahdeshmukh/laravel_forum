@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Forum Threads</h2></div>
                        @forelse($threads as $thread)
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
                                    <div class="body">{{ $thread->body }}</div>
                                </article>
                            </div>
                            <hr/>
                        @empty
                            <div>There are no threads available</div>
                        @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
