@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row" >

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <h4 class="flex-grow-1">
                                {{ $thread->title }}
                            </h4>
                            @can('update', $thread)
                                <form action="{{ $thread->path() }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-link">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                @foreach($replies as $reply)
                    <div class="mt-3">
                        @include('threads.reply')
                    </div>
                @endforeach

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
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="{{route('profile', $thread->creator)}}">
                                {{ $thread->creator->first_name.' '.$thread->creator->last_name }}
                            </a>
                            and currently has {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}.
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
