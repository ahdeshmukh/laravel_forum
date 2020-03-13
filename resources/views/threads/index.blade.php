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
                                    <h4>
                                        <a href="{{ $thread->path() }}">
                                            {{ $thread->title }}
                                        </a>
                                    </h4>
                                    <h6>Posted by {{ $thread->creator->name }}</h6>
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
