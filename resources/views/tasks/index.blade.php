@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('alerts.success')
                <div class="panel panel-default">
                    <div class="panel-heading">Tasks</div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    @if (Auth::user()->role === "ADMIN")
                                        <th>User</th>
                                    @endif
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    @can('owner', $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->description }}</td>
                                            @if (Auth::user()->role === "ADMIN")
                                                <td>{{ $task->user->first_name }}</td>
                                            @endif
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
@endsection
