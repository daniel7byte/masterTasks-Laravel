@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('alerts.errors')
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Task</div>

                    <div class="panel-body">
                        {!! Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}

                            @include('tasks.form')

                            <div class="form-group">
                                {!! Form::label('date', 'Date: ') !!}
                                <input type="datetime-local" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::parse($task->date)->format('Y-m-d') }}T{{ \Carbon\Carbon::parse($task->date)->format('h:m') }}">
                            </div>

                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
