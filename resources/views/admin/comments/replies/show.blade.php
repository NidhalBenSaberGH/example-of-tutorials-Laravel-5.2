@extends('layouts.admin')


@section('content')

    @if(count($replies) > 0)
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
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->body}}</td>
                    <td><a href="{{route('home.post', $reply->comment->post->id)}}">View post</a></td>
                    <td>
                        @if($reply->is_active == 1)

                            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update',$reply->id]])  !!}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Unapprove', ['class'=>'btn btn-info']) !!}
                            </div>
                            {{ csrf_field() }}
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update',$reply->id]])  !!}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                            </div>
                            {{ csrf_field() }}
                            {!! Form::close() !!}

                        @endif
                    </td>
                    <td>

                        {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy',$reply->id]])  !!}
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
        <h1 class="text-center">No Replies for this comment</h1>

    @endif
@endsection

