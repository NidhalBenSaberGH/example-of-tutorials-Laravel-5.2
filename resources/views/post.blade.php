@extends('layouts.blog-post')

@section('content')

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{asset($post->photo->file)}}" alt="No photo">

    <hr>

    <!-- Post Content -->
    <p>{!! $post->body !!}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    @if (Auth::check())
        {{-- true expr --}}

        @if (Session::has('comment_message'))
            <p class="bg-primary">{{session('comment_message')}}</p>
        @endif

        <div class="well">
            <h4>Leave a Comment:</h4>

            {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}

            <input type="hidden" name="post_id" value="{{$post->id}}">

            <div class='form-group'>
                {!! Form::textarea('body',null,['class'=>'form-control','rows'=>3]) !!}
            </div>

            <div class='form-group'>
                {!! Form::submit('Submit comment',['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </div>

        <hr>

        <!-- Posted Comments -->
        <!-- Comment -->

        @if (count($comments) > 0)
            {{-- expr --}}
            @foreach ($comments as $comment)
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height="64" width="64" class="media-object" src="{{$comment->photo ? asset($comment->photo): 'http://via.placeholder.com/64x64'}}">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        {{$comment->body}}
                        <div class="comment-reply-container">
                            <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                            <div class="comment-reply">

                                {!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply']) !!}

                                <input type="hidden" name="comment_id" value="{{$comment->id}}">

                                <div class='form-group col-sm-6'>
                                    {!! Form::textarea('body',null,['class'=>'form-control','rows'=>1]) !!}
                                </div>

                                <div class='form-group'>
                                    {!! Form::submit('Submit reply',['class'=>'btn btn-primary']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>

                        @foreach ($comment->replies as $reply)

                            @if ($reply->is_active == 1)

                            <!-- Nested Comment -->
                                <div id="nested-comment" class="media">
                                    <a class="pull-left" href="#">
                                        <img height="64" width="64" class="media-object" src="{{$reply->photo ? asset($reply->photo): 'http://via.placeholder.com/64x64'}}">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{$reply->author}}
                                            <small>{{$reply->created_at->diffForHumans()}}</small>
                                        </h4>
                                        {{$reply->body}}
                                    </div>

                                </div>
                                <!-- End Nested Comment -->
                            @endif

                        @endforeach

                    </div>
                </div>

            @endforeach

        @endif

        <!-- End Comment -->


    @endif



@endsection



@section('scripts')
    <script type="text/javascript">
        $(".comment-reply-container .toggle-reply").click(function(){
            $(this).next().slideToggle("slow");
        });
    </script>
@endsection
