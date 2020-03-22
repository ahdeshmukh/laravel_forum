@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2>Forum Threads</h2></div>
                    <div class="card-body">
                        <form method="POST" action="/threads">
                            {{ csrf_field() }}

                            @if(count($errors))
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="form-group">
                                <label for="channel">Choose a Channel:</label>
                                <select name="channel_id" id="channel" class="form-control">
                                    <option value="">Choose One...</option>
                                    @foreach(App\Channel::all() as $channel)
                                        <option value="{{ $channel->id }}"
                                            {{ (old('channel_id') == $channel->id) ? 'selected' : '' }}
                                            required
                                        >
                                            {{ $channel->name  }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text"
                                       class="form-control"
                                       id="title"
                                       name="title"
                                       value="{{ old('title') }}"
                                       required
                                >
                            </div>
                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea class="form-control" id="body" name="body"
                                          rows="8" required>{{ old('body') }}
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
