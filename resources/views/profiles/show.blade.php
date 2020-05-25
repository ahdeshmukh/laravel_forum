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

        @foreach($activities as $date => $activity)
            <h3 class="page-header">{{ $date }}</h3>
            @foreach($activity as $record)
                @include("activities.{$record->type}", ['activity' => $record])
            @endforeach
        @endforeach
    </div>
@endsection
