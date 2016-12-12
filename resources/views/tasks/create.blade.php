@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('alerts.errors')
                <div class="panel panel-default">
                    <div class="panel-heading">Create Task</div>

                    <div class="panel-body">
                        {!! Form::open(['route' => 'tasks.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                            @include('tasks.form')

                            <div class="form-group">
                                {!! Form::label('date', 'Date: ') !!}
                                <input type="datetime-local" class="form-control" id="date" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}T{{ \Carbon\Carbon::now()->format('h:i') }}">
                            </div>

                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
