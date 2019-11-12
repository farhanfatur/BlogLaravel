@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
    	@foreach($post as $data)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>{{ $data->title }}</h3></div>

                <div class="card-body">
                    <p>{{ str_limit($data->text, 140, '...') }}</p>
                    <button class="btn btn-primary" onclick="window.location.href='/post/{{ $data->id }}/detail'">Read More</button>
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
