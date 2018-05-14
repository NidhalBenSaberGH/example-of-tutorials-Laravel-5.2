@extends('layouts.admin')


@section('content')

    @if(count($comments) > 0)
        <h1>Comments</h1>
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
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->body}}</td>
                    <td><a href="{{route('home.post', $comment->post->id)}}">View post</a></td>
                    <td>
                        @if($comment->is_active == 1)

                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update',$comment->id]])  !!}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Unapprove', ['class'=>'btn btn-info']) !!}
                            </div>
                            {{ csrf_field() }}
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update',$comment->id]])  !!}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                            </div>
                            {{ csrf_field() }}
                            {!! Form::close() !!}

                        @endif
                    </td>
                    <td>

                        {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy',$comment->id]])  !!}
                        <div class="form-group">
                            {!! Form::submit('DELETE', ['class'=>'btn btn-danger']) !!}
                        </div>
                        {{ csrf_field() }}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <h1 class="text-center">No comments</h1>

    @endif
@endsection

