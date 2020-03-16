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
            <div class="row justify-content-center" style="margin-top:20px">
                <div class="col-md-8">
                    <form method="POST" action="{{ $thread->path().'/replies' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="body" id="reply-body" class="form-control" placeholder="Have something to say..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        @else
            <div class="text-center" style="margin-top:20px">Please <a href="{{ route('login') }}">sign in</a> to participate in the discussion</div>
        @endif

    </div>
@endsection
