@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>{{ $article->title }}</span>
                    <span>{{ $article->author->name }}</span>
                </div>

                <div class="card-body">
                    {{ $article->content }}
                </div>

                <div class="card-footer">
                    {{ $article->tag }}
                </div>
            </div>

            @can('update', $article)
                <div class="mt-5">
                    <span>Edit Article</span>   
                </div>
                <div class="mt-1 card">
                    <form method="POST" action="{{ route('articles.update', $article->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <label for="title">Title: </label>
                                <input name="title" type="text" value="{{ $article->title }}">
                            </div>
                            <span>{{ $article->author->name }}</span>
                        </div>

                        <div class="card-body">
                            <label for="content">Content: </label>
                            <input name="content" type="text" value="{{ $article->content }}">
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            
                            <select name="tag" id="tag">
                                <option value="" disabled selected>Select a tag</option>
                                <option value="Food">Food</option>
                                <option value="Travel">Travel</option>
                                <option value="Technology">Technology</option>
                            </select>

                            @error('tag')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <button type="submit" class="btn btn-info btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            @endcan
        </div>
    </div>
</div>
@endsection
