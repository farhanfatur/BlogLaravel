@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
    	@foreach($post as $data)
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/post/thumbnail/thumbnail_'.$data->image) }}" class="card-img" alt="{{ $data->title }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">{{ $data->title }}</h3>
                            <p>{{ str_limit($data->text, 140, '...') }}</p>
                            <button class="btn btn-primary" onclick="window.location.href='/post/{{ $data->title_slug }}'">Read More</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer">Publish at: {{ $data->created_at }}</div>
            </div>
        </div>

        @endforeach

    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ $post->links() }}
        </div>
    </div>
@endsection
