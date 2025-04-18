@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">{{ isset($article) ? 'Modifier l\'article' : 'Créer un article' }}</h1>
    <form action="{{ isset($article) ? route('articles.update', $article) : route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($article))
            @method('PUT')
        @endif

        <!-- Champ Titre -->
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title ?? '' }}" required>
        </div>

        <!-- Champ Contenu -->
        <div class="mb-3">
            <label for="content" class="form-label">Contenu</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $article->content ?? '' }}</textarea>
        </div>

        <!-- Champ Auteur -->
        <div class="mb-3">
            <label for="author" class="form-label">Auteur</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $article->author ?? '' }}" required>
        </div>

        <!-- Champ Catégorie -->
        <div class="mb-3">
            <label for="category" class="form-label">Catégorie</label>
            <select name="category" id="category" class="form-control" required>
                <option value="International" {{ isset($article) && $article->category == 'International' ? 'selected' : '' }}>International</option>
                <option value="Politique" {{ isset($article) && $article->category == 'Politique' ? 'selected' : '' }}>Politique</option>
                <option value="Économie" {{ isset($article) && $article->category == 'Économie' ? 'selected' : '' }}>Économie</option>
                <option value="Culture" {{ isset($article) && $article->category == 'Culture' ? 'selected' : '' }}>Culture</option>
                <option value="Sports" {{ isset($article) && $article->category == 'Sports' ? 'selected' : '' }}>Sports</option>
                <option value="Divers" {{ isset($article) && $article->category == 'Divers' ? 'selected' : '' }}>Divers</option>
            </select>
        </div>

        <!-- Champ Image -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">{{ isset($article) ? 'Modifier' : 'Créer' }}</button>
    </form>
</div>
@endsection
