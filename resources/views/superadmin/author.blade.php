@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Author</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success" onclick="window.location.href='author/add'">+ Author</button>    
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th><th>Name</th><th>E-mail</th><th>Post</th><th>Position</th><th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($user as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ count($data->posts) }}</td>
                                        <td>{{ $data->position }}</td>
                                        <td>
                                            @if($data->is_active == 1)
                                                <b>Active</b>&nbsp;|&nbsp;<a href="author/{{ $data->id }}/active/{{ $data->is_active }}">Deactive</a>
                                            @else
                                                <a href="author/{{ $data->id }}/active/{{ $data->is_active }}">Active</a>&nbsp;|&nbsp;<b>Deactive</b>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $user->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
