<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{
    /**
     * Afficher la page d'accueil avec les derniers articles.
     */
    public function index()
    {
        $categories = ['politique', 'économie', 'culture', 'sports', 'international'];
        
        // Récupère les 6 derniers articles
        $articles = Article::latest()->take(6)->get();

        // Récupère la clé API NewsAPI
        $apiKey = env('NEWS_API_KEY');

        // Vérifie si la clé API est présente
        if (!$apiKey) {
            return response()->json(['error' => 'Clé API NewsAPI manquante'], 500);
        }

        // Appel à NewsAPI
        $response = Http::get("https://newsapi.org/v2/everything", [
            'q' => 'togo',
            'language' => 'fr',
            'sortBy' => 'publishedAt',
            'apiKey' => $apiKey
        ]);

        // Vérifie si la requête a réussi
        if ($response->successful()) {
            $newsApiArticles = $response->json()['articles'];
        } else {
            $newsApiArticles = [];
        }

        // Passer les articles à la vue
        return view('index', compact('articles', 'newsApiArticles'));
    }

    /**
     * Afficher le formulaire pour créer un nouvel article.
     */
    public function create()
    {
        return view('admin.index');
    }

    /**
     * Enregistrer un nouvel article.
     */
    public function store(Request $request)
    {
        // Valider les données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image_path'] = $path;
        }

        // Créer l'article
        Article::create($validated);

        return redirect()->route('articles.create')->with('success', 'Article ajouté avec succès!');
    }

    /**
     * Afficher un article spécifique.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Afficher le formulaire d'édition d'un article.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Mettre à jour un article.
     */
    public function update(Request $request, Article $article)
    {
        // Valider les données
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image_path'] = $path;
        }

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès!');
    }

    /**
     * Supprimer un article.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Article supprimé avec succès!');
    }

    // Méthodes par catégorie (avec gestion de la casse)
    public function international()
    {
        $articles = Article::whereRaw('LOWER(category) = ?', ['international'])->get();
        return view('international', compact('articles'));
    }

    public function politique()
    {
        $articles = Article::whereRaw('LOWER(category) = ?', ['politique'])->get();
        return view('politique', compact('articles'));
    }

    public function economie()
    {
        $articles = Article::whereRaw('LOWER(category) = ?', ['économie'])->get();
        return view('economie', compact('articles'));
    }

    public function culture()
    {
        $articles = Article::whereRaw('LOWER(category) = ?', ['culture'])->get();
        return view('culture', compact('articles'));
    }

    public function sports()
    {
        $articles = Article::whereRaw('LOWER(category) = ?', ['sports'])->get();
        return view('sports', compact('articles'));
    }

    public function divers()
    {
        $articles = Article::whereRaw('LOWER(category) = ?', ['divers'])->get();
        return view('divers', compact('articles'));
    }

    // (Optionnel) Méthode dynamique pour simplifier toutes les catégories
    // public function categorie($categorie)
    // {
    //     $articles = Article::whereRaw('LOWER(category) = ?', [strtolower($categorie)])->get();
    //     return view($categorie, compact('articles'));
    // }
}
