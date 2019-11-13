@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Post</div>

                <div class="card-body">
                    <button class="btn btn-success" onclick="window.location.href='post/add'">+ Post</button>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th><th>Title</th><th>Content</th><th>Author</th><th>View</th><th>Comment</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @if(count($post->posts) == 0)
                            <tr>
                                <th colspan="5"><center>Nothing post</center></th>
                            </tr>
                            @else

                            @foreach($post->posts as $index => $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ str_limit($data->text, 30, '...') }}</td>
                                <td>{{ $post->name }}</td>
                                <td>{{ $data->viewer }}</td>
                                @if($sumComment[$index] == 0)
                                <td>0</td>
                                @else
                                <td><a href='post/comment/{{ $data->id }}'>{{ $sumComment[$index] }}</a></td>
                                @endif
                                <td><a href="post/edit/{{ $data->id }}">Edit</a> | <a href="post/delete/{{ $data->id }}">Delete</a></td>
                            </tr>
                            @endforeach
                            @endif   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
