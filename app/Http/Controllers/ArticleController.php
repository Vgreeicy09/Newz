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

        $newsApiArticlesByCategory = [];
        // Récupère la clé API NewsAPI
        $apiKey = env('NEWS_API_KEY');

          // Vérifie si la clé API est présente
            if (!$apiKey) {
            return response()->json(['error' => 'Clé API NewsAPI manquante'], 500);
        }

        $response = Http::get("https://newsapi.org/v2/everything", [
            'q' => 'togo',
            'language' => 'fr',  // Langue: Français
            'sortBy' => 'publishedAt',  // Trié par date de publication
            'apiKey' => $apiKey  // Clé API
        ]);


        $newsApiArticles = $response->json()['articles'];

        // Vérifie si la requête a réussi
        if ($response->successful()) {
            // Récupérer les articles de NewsAPI
            $newsApiArticles = $response->json()['articles'];
        } else {
            // Si la requête échoue, on peut afficher un message d'erreur
            $newsApiArticles = [];
        }


       // Passer les articles de NewsAPI et les articles locaux à la vue
        return view('index', compact('articles', 'newsApiArticles'));
    }

    /**
     * Afficher le formulaire pour créer un nouvel article.
     */
    public function create()
    {
        return view('admin.index'); // Formulaire d'ajout
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
            'category' => 'required|string|max:255', // Ajout de la validation pour la catégorie
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image_path'] = $path;
        }

        // Créer l'article
        Article::create($validated);

        // Rediriger avec un message de succès
        return redirect()->route('articles.create')->with('success', 'Article ajouté avec succès!');
    }

    /**
     * Afficher un article spécifique.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article')); // Détails d'un article
    }

    /**
     * Afficher le formulaire d'édition d'un article.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article')); // Formulaire d'édition
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

        // Mise à jour de l'article
        $article->update($validated);

        // Redirection
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

    public function international()
{
    $articles = Article::where('category', 'International')->get();
    return view('international', compact('articles'));
}

public function politique()
{
    $articles = Article::where('category', 'Politique')->get();
    return view('politique', compact('articles'));
}

public function economie()
{
    $articles = Article::where('category', 'Économie')->get();
    return view('economie', compact('articles'));
}

public function culture()
{
    $articles = Article::where('category', 'Culture')->get();
    return view('culture', compact('articles'));
}

public function sports()
{
    $articles = Article::where('category', 'Sports')->get();
    return view('sports', compact('articles'));
}

public function divers()
{
    $articles = Article::where('category', 'Divers')->get();
    return view('divers', compact('articles'));
}

// Répétez pour les autres catégories

}

$apiKey = env('NEWS_API_KEY');

if (!$apiKey) {
    // Afficher une erreur si la clé API est manquante
    abort(500, 'Clé API NewsAPI manquante dans le fichier .env');
}
