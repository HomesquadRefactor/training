@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-end my-3">
                <a href="{{ route('articles.create') }}" class="btn btn-success">Post new article</a>
            </div>

            @foreach ($articles as $article)
                <form method="post" action="{{ action('ArticleController@update', $article->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                            <span>{{ $article->author->name }}</span>
                        </div>

                        <div class="card-body">
                            {{ $article->content }}
                        </div>

                        
                        <div class="card-footer d-flex flex-column ">
                            <div>
                                <label for="comment">Comment:</label>
                                <input type="text" placeholder="Add comment here...">
                            </div>
                            <div class="d-flex justify-content-between">
                                @can('update', $article)
                                    <select name="tag" id="">
                                            <option value="Food">Food</option>
                                            <option value="Travel">Travel</option>
                                            <option value="Technology">Technology</option>
                                    </select>
                                @endcan
    
                                @cannot('update', $article)
                                    {{ $article->tag }}
                                @endcannot
                                @can('update', $article)
                                    <div>
                                        <button type="submit" class="btn btn-info">Update</button>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</div>
@endsection
