@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List Comment</div>

                <div class="card-body">
                    <button class="btn btn-default" onclick="window.history.back()"><< Back</button>
                    <br>
                    <br>
                  
                        @foreach($posts->comments as $post)

                        <div class="alert alert-primary" role="alert">
                             <div class="row">
                                <div class="col-md-12">
                                    <b>{{ $post->user->name }}</b>
                                    <p>{{ $post->comment }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    
                </div>
            </div>
        </div>
    </div>

@endsection
