@extends('layouts.admin')


@section('content')
    <h1>Create Posts</h1>
    <div class="col-sm-9">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminPostsController@store', 'files'=>true])  !!}
        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, [ 'class'=>'form-control' ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category:') !!}
            {!! Form::select('category_id', [''=>'Choose category']+$categories,null, [ 'class'=>'form-control' ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'File:') !!}
            {!! Form::file('photo_id', null, [ 'class'=>'form-control' ]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Description:') !!}
            {!! Form::textarea('body', null, [ 'class'=>'form-control', 'rows'=>3]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
        </div>
        {{ csrf_field() }}
    {!! Form::close() !!}
    @include('includes.form-error')

@endsection