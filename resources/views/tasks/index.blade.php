@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('alerts.success')
                @include('alerts.warning')
                <div class="panel panel-default">
                    <div class="panel-heading">Tasks</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                        @if (Auth::user()->role === "ADMIN")
                                        <th>User</th>
                                        @endif
                                        <th>Created ago</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                    @can('owner', $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($task->date)->toDayDateTimeString() }}</td>
                                        <td>
                                            @if ($task->image == null)
                                            <span class="label label-warning">NULL</span>
                                            @else
                                            <img style="max-height: 100px" class="img img-responsive img-thumbnail" src="imagesTasks/{{ $task->image }}">
                                            @endif
                                        </td>
                                        @if (Auth::user()->role === "ADMIN")
                                        <td><span class="label label-default">{{ $task->user->first_name }}</span></td>
                                        @endif
                                        <td>{{ \Carbon\Carbon::parse($task->created_at)->diffForHumans() }}</td>
                                        <td>
                                            {{ link_to_route('tasks.edit', $title = 'Edit', $parameter = $task, $attributes = ['class' => 'btn btn-xs btn-primary']) }}
                                            @include('tasks.delete')
                                        </td>
                                    </tr>
                                    @endcan
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".img").elevateZoom();
        });
    </script>

@endsection
