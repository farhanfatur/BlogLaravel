@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
    	@foreach($post as $data)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ $data->title }}</h3></div>

                <div class="card-body">
                    <p>{{ $data->text }}</p>
                    <hr>
                    <span>Publish at: {{ $data->created_at }}</span><br>
                    <span>Author : {{ $data->user->name }}</span>
                </div>
                <div class="card-footer">
                    <h4>Comment :</h4>
                    @if(count($data->comments) == 0)
                    <div class="row">
                        <div class="col-md-12">
                            <p>Comment is empty</p>
                        </div>
                    </div>
                    @else
                    @foreach($data->comments as $comment)

                        <div class="row">
                            <div class="col-md-12">
                                <b>{{ $comment->user->name }}</b>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                    @endif 
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if(Auth::guard('web')->user())
    <form method="POST" action="{{ route('storeComment') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $post[0]->id }}">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Comment this post :</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="comment" cols="90" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">Comment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <p>Tidak bisa berkomentar silakan <a href="/author">login</a> dahulu</p>
            </div>
        </div>
    </div>
    @endif
@endsection
