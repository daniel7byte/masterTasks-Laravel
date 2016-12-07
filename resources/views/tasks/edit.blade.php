@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('alerts.errors')
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Task</div>

                    <div class="panel-body">
                        {!! Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PUT']) !!}

                            @include('tasks.form')

                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
