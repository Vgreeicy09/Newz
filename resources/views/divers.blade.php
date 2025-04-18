@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Articles - Divers</h1>
    <div class="row">
        @forelse ($articles as $article)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if($article->image_path)
                        <img src="{{ asset('storage/' . $article->image_path) }}" class="card-img-top" alt="{{ $article->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        <a href="{{ route('articles.show', $article) }}" class="btn btn-primary">Lire plus</a>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucun article disponible dans cette catégorie.</p>
        @endforelse
    </div>
</div>
@endsection
