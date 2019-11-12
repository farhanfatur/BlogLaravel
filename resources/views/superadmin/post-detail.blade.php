@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Post</div>

                <div class="card-body">
                    <a href="#" onclick="window.history.back()"> << Back</a>
                    <br>
                    <div class="jumbotron">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{ $post->title }}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span style="color: grey;">{{ $post->created_at == null ? 'Unknown Date' : $post->created_at }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>{{ $post->text }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p>Author By: {{ $post->user->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
