<?php

namespace App\controllers;

use App\models\ArticleModel;
use App\models\CategoryModel;
use App\View;

class ArticleController extends Controller
{
    public function index()
    {
        $category = isset($_GET['categorie']) ? $this->sanitaze($_GET['categorie']) : null;
        $articleModel = new ArticleModel();
        $categoryModel = new CategoryModel();

        View::view('articles', [
            'articles' => $articleModel->published($category ?: null),
            'categories' => $categoryModel->all(),
            'activeCategory' => $category,
        ]);
    }

    public function show(array $params)
    {
        $slug = $params['slug'] ?? '';
        $articleModel = new ArticleModel();
        $article = $articleModel->findBySlug($slug);

        if (!$article || $article['statut'] !== 'publie') {
            http_response_code(404);
            View::view('error', ['message' => 'Article introuvable.']);
            return;
        }

        View::view('article-show', ['article' => $article]);
    }
}
