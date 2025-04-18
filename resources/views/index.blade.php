@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Bienvenue sur notre site d'actualités</h1>

        <h2 class="mt-5">📰 Articles locaux</h2>
        @if($articles->isEmpty())
            <p>Aucun article local trouvé.</p>
        @else
            <div class="row">
                @foreach($articles as $article)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($article->image_path)
                                <img src="{{ asset('storage/' . $article->image_path) }}" class="card-img-top" alt="Image article">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $article->title }}</h5>
                                <p class="card-text">{{ $article->excerpt }}</p>
                                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Lire plus</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <h2 class="mt-5">🌍 Articles via NewsAPI</h2>
        @if(empty($newsApiArticles))
            <p>Aucune actualité trouvée via NewsAPI.</p>
        @else
            <div class="row">
                @foreach($newsApiArticles as $news)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if(!empty($news['urlToImage']))
                                <img src="{{ $news['urlToImage'] }}" class="card-img-top" alt="Image NewsAPI">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $news['title'] }}</h5>
                                <p class="card-text">{{ $news['description'] }}</p>
                                <a href="{{ $news['url'] }}" target="_blank" class="btn btn-secondary">Lire l'article</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
