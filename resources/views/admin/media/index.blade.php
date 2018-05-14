@extends('layouts.admin')

@section('content')
    @if(Session::has('media_deleted'))
        <p class="alert-danger">{{session('media_deleted')}}</p>
    @endif
    <h1>Media</h1>

    @if($photos)

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th></th>
            </tr>
            </thead>
            @foreach($photos as $photo)
                <tr>
                    <td>{{$photo->id}}</td>
                    <td><img  height="50" width="50" src="{{$photo ? asset($photo->file): 'http://via.placeholder.com/50x50'}}" alt="No photo" height="50" width="50"></td>
                    <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'No date'}}</td>
                    <td>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]])  !!}
                    <div class="form-group">
                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                    </div>
                    {{ csrf_field() }}
                    {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </table>

    @endif

@endsection