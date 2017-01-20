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
                                            <img style="" class="img img-responsive img-thumbnail" src="imagesTasks/{{ $task->image }}">
                                        @endif
                                        <div class="caption">
                                            <h3>{{ $task->title }}</h3>
                                            <p>Description: {{ $task->description }}</p>
                                            <p>Date: {{ \Carbon\Carbon::parse($task->date)->toDayDateTimeString() }}</p>
                                            <p>User: <span class="label label-default">{{ $task->user->first_name }}</span></p>
                                            <p>Created ago: {{ \Carbon\Carbon::parse($task->created_at)->diffForHumans() }}</p>
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

    <script>
        $(document).ready(function () {
            $(".img").elevateZoom({
                zoomType: "inner",
                cursor: "crosshair"
            });
        });
    </script>

@endsection
