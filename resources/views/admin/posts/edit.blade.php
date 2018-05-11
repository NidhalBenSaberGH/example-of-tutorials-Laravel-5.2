@extends('layouts.admin')


@section('content')
    <h1>Edit Posts</h1>
    <div class="row">
            <div class="col-sm-3">
                <img src="{{asset($post->photo->file)}}" alt="" class="img-responsive img-rounded" height="100" width="100">
            </div>
        <div class="col-sm-9">
            {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPostsController@update', $post->id], 'files'=>true])  !!}
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, [ 'class'=>'form-control' ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id', [''=>'Choose category'] + $categories,null, [ 'class'=>'form-control' ]) !!}
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
                {!! Form::submit('Update Post', ['class'=>'btn btn-primary col-md-2 col-md-offset-2 ']) !!}
            </div>
            {{ csrf_field() }}
            {!! Form::close() !!}

            {{Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]])}}
            <div class="form-group">
                {!! Form::submit('Delete Post', ['class'=>'btn btn-danger col-md-2 col-md-offset-2']) !!}
            </div>
            {{ csrf_field() }}
            {!! Form::close() !!}

        </div>
    </div>
     <div class="row">
    @include('includes.form-error')
     </div>
@endsection