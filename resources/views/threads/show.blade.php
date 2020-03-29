@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row" style="margin-bottom:20px;">

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h3>{{ $thread->title }}</h3>
                    </div>
                    <div class="card-body">
                        <h5>{{ $thread->body }}</h5>
                    </div>
                </div>

                @foreach($replies as $reply)
                    <div style="margin-top:10px;">
                        @include('threads.reply')
                    </div>
                @endforeach

                <div style="margin-top:20px;">
                    {{ $replies->links() }}
                </div>

                @if(auth()->check())
                    <div style="margin-top:20px;">
                        <form method="POST" action="{{ $thread->path().'/replies' }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <textarea name="body" id="reply-body" class="form-control" placeholder="Have something to say..." rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    </div>
                @else
                    <div class="text-center" style="margin-top:20px">
                        Please <a href="{{ route('login') }}">sign in</a> to participate in the discussion
                    </div>
                @endif

            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by <a href="#">{{ $thread->creator->first_name.' '.$thread->creator->last_name }}</a>
                            and currently has {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
