@extends('layouts.admin')


@section('content')
    <h1>Posts</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th></th>
            <th></th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
        </thead>
        <tbody>
        @if($posts)
            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td><img  height="50" width="50" src="{{$post->photo ? asset($post->photo->file): 'http://via.placeholder.com/50x50'}}" alt="No photo"></td>
                    <td><a href="{{route('admin.posts.edit', $post->id)}}"> {{$post->user->name}}</a></td>
                    <td>{{$post->category ? $post->category->name : 'uncategorized '}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{str_limit($post->body, 30)}}</td>
                    <td><a href=" {{route('home.post', $post->slug)}}">View Post</a></td>
                    <td><a href=" {{route('admin.comments.show', $post->id)}}">View comments</a></td>
                    <td>{{$post->created_at->diffForHumans()}}</td>
                    <td>{{$post->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}
        </div>
    </div>

         @else
                <h1>No posts</h1>
         @endif
@endsection