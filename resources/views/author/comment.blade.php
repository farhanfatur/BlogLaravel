@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List Comment</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th><th>Comment</th><th>Post Title</th><th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @if(count($datas->comments) == 0)
                            <tr>
                                <th colspan="4"><center>Nothing comment</center></th>
                            </tr>
                            @else
                            @foreach($datas->comments as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ str_limit($data->comment, 30, '...') }}</td>
                                <td>
                                    @if(count($datas->posts) == 0)
                                        {{ $datas->posts->title }}
                                    @else
                                        @foreach($datas->posts as $post)
                                            {{ $post->title }}
                                        @endforeach
                                    @endif
                                </td>
                                <td><a href="comment/edit/{{ $data->id }}">Edit</a> | <a href="comment/delete/{{ $data->id }}">Delete</a></td>
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
