<div class="form-group">
    {!! Form::label('title', 'Title: ') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description: ') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3']) !!}
</div>

<div class="form-group">
    {!! Form::label('image', 'Image: ') !!}
    {!! Form::file('image', null, ['class' => 'form-control', 'accept' => 'image/*']) !!}
</div>