@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-end my-3">
                <a href="{{ route('articles.create') }}" class="btn btn-success">Post new article</a>
            </div>

            @foreach ($articles as $article)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
                        @can('update', $article)
                            <a class="btn btn-info btn-sm" href="{{ route('articles.show', $article->id) }}">Edit</a>
                        @endcan
                        <span>{{ $article->author->name }}</span>
                    </div>

                    <div class="card-body">
                        {{ $article->content }}
                    </div>

                    

                    <div class="card-footer d-flex flex-column">
                        <span class="mb-3">{{ $article->tag }}</span>
                        @foreach ($article->comments as $comment)

                            <div class="d-flex">
                                @can('update', $comment)
                                    <form method="POST" action="{{ route('articles.comment.update', $comment->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div>
                                            <label for="message" id="{{ $comment->id }}">{{ $comment->user->name }}: </label>
                                            <input name="message" type="text" value="{{ $comment->message }}">
                                            <button type="submit" class="btn btn-info btn-sm">Update</button>
                                        </div>
                                    </form>
                                @endcan
    
                                @can('delete', $comment)
                                    <form method="POST" action="{{ route('articles.comment.delete', $comment->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-1 btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endcan
    
                                @cannot('update', $comment)
                                    <div>
                                        <label for="comment" id="{{ $comment->id }}">{{ $comment->user->name }}: </label>
                                        <span>{{ $comment->message }}</span>
                                    </div>
                                @endcannot
                            </div>


                        @endforeach
                        <form method="POST" action="{{ route('articles.comment', ['user_id' => Auth::user()->id, 'article_id' => $article->id]) }}">
                            @csrf
                            <div class="mt-3 d-flex">
                                <div>
                                    <label for="message">Comment: </label>
                                    <input name="message" type="text" placeholder="Input comment here..">
                                </div>
                                <button type="submit" class="ml-3 btn btn-warning btn-sm">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
