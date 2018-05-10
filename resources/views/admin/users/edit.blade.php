@extends('layouts.admin')



@section('content')
    <h1>Edit Users</h1>
    <div class="row">
        <div class="col-sm-3">
            <img src="{{asset($user->photo->file)}}" alt="" class="img-responsive img-rounded" height="100" width="100">
        </div>
        <div class="col-sm-9">
            {{-- Form::open(['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) --}}
            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true])  !!}
            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, [ 'class'=>'form-control' ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', null, [ 'class'=>'form-control' ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('role_id', 'Role:') !!}
                {!! Form::select('role_id', [''=>'Choose options'] + $roles,null, [ 'class'=>'form-control' ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active', 'Status:') !!}
                {!! Form::select('is_active', array(1=>'Active', 0=>'Not Active'), null, [ 'class'=>'form-control' ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photo_id', 'File:') !!}
                {!! Form::file('photo_id', null, [ 'class'=>'form-control' ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Password:') !!}
                {!! Form::password('password', [ 'class'=>'form-control' ]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Edit User', ['class'=>'btn btn-primary']) !!}
            </div>
            {{ csrf_field() }}
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
    @include('includes.form-error')
    </div>
@endsection