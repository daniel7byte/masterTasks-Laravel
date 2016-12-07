@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('alerts.errors')
                <div class="panel panel-default">
                    <div class="panel-heading">Create Task</div>

                    <div class="panel-body">
                        {!! Form::open(['route' => 'tasks.store', 'method' => 'POST']) !!}

                            @include('tasks.form')

                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
