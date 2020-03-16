@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $thread->title }}</h3>
                        <h6>Posted by {{ $thread->creator->first_name }} {{ $thread->creator->last_name }}</h6>
                    </div>
                    <div class="card-body">
                        <h5>{{ $thread->body }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>

        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    Hello
                </div>
            </div>
        @endif

    </div>
@endsection
