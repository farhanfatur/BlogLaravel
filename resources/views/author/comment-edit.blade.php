@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Comment</div>

                <div class="card-body">
                        <form method="POST" action="/author/comment/update">
                            @csrf
                            <input type="hidden" name="id" value="{{ $comments->id }}">
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Post Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $comments->post->title }}" required autocomplete="name" readonly>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-form-label text-md-right">Comment</label>

                                <div class="col-md-6">
                                    <textarea name="comment" cols="60" rows="30" required> {{ $comments->comment }} </textarea>

                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                      Update
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
