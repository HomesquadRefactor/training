@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form method="PATCH" action="{{ route('articles.update', $article->id) }}">
                    @csrf
                    <div class="card-header d-flex justify-content-between">
                        <label for="title">Title:</label>
                        <input name="title" type="text">
                        <span>{{ $article->author->name }}</span>
                    </div>

                    <div class="card-body">
                        <label for="content">Content:</label>
                        {{ $article->content }}
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <select name="tag" id="tag" class="form-control">
                                <option value="" disabled selected>Select a tag</option>
                                <option value="Food">Food</option>
                                <option value="Travel">Travel</option>
                                <option value="Technology">Technology</option>
                            </select>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
