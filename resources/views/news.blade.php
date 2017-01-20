@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Last News</div>
                    <div class="panel-body">
                        <div class="row">
                            @foreach($tasks as $task)
                                <div class="col-sm-6 col-md-6">
                                    <div class="thumbnail">
                                        @if ($task->image == null)
                                            <span class="label label-warning">NULL</span>
                                        @else
                                            <a href="imagesTasks/{{ $task->image }}" target="_blank" title="{{ $task->title }}">
                                                <img class="img img-responsive img-thumbnail" src="imagesTasks/{{ $task->image }}"alt="{{ $task->title }}">
                                            </a>
                                        @endif
                                        <div class="caption">
                                            <h3>{{ $task->title }}</h3>
                                            <p><strong>Description: </strong>{{ $task->description }}</p>
                                            <p><strong>Date: </strong>{{ \Carbon\Carbon::parse($task->date)->toDayDateTimeString() }}</p>
                                            <p><strong>User: </strong><span class="label label-default">{{ $task->user->first_name }}</span></p>
                                            <p><strong>Created ago: </strong>{{ \Carbon\Carbon::parse($task->created_at)->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
