{{ Form::open(['route' => ['tasks.destroy', $task], 'method' => 'DELETE']) }}
    {{ Form::submit('Delete', ['class' => 'btn btn-xs btn-danger']) }}
{{ Form::close() }}