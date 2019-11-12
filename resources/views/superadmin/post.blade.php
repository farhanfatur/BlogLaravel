@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Post</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th><th>Title</th><th>Content</th><th>Author</th><th>View</th><th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($post as $data)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ str_limit($data->text, 50, '...') }}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td>{{ $data->viewer }}</td>
                                            <td><a href="post/detail/{{ $data->id }}">Detail</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>  
                            {{ $post->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
