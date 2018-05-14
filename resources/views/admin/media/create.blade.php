@extends('layouts.admin')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

@section('content')
<h1>Upload Media</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'AdminMediasController@store', 'class'=>'dropzone'])  !!}

    {{ csrf_field() }}
    {!! Form::close() !!}

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>