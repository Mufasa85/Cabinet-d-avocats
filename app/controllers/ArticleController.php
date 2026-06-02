<?php

namespace App\controllers;

use App\models\ArticleModel;
use App\models\CategoryModel;
use App\models\PublicationModel;
use App\View;
use Helper\Log\Logger;

class ArticleController extends Controller
{
    public function index()
    {
        $category = isset($_GET['categorie']) ? $this->sanitaze($_GET['categorie']) : null;
        $articleModel = new ArticleModel();
        $categoryModel = new CategoryModel();

        Logger::info('ArticleController:index', [
            'category' => $category,
            'categories_count' => count($categoryModel->all()),
        ]);

        View::view('articles', [
            'articles' => $articleModel->published($category ?: null),
            'categories' => $categoryModel->all(),
            'activeCategory' => $category,
        ]);
    }

    public function show(array $params)
    {
        $slug = $params['slug'] ?? '';

        Logger::info('ArticleController:show - Debut', [
            'slug' => $slug,
            'params' => $params,
        ]);

        try {
            $articleModel = new ArticleModel();
            $article = $articleModel->findBySlug($slug);

            Logger::info('ArticleController:show - Apres findBySlug', [
                'slug' => $slug,
                'article_found' => !empty($article),
                'article_keys' => $article ? array_keys($article) : [],
            ]);

            if (!$article) {
                Logger::warning('ArticleController:show - Article non trouve', ['slug' => $slug]);
                http_response_code(404);
                View::view('error', ['message' => 'Article introuvable.']);
                return;
            }

            if ($article['statut'] !== 'publie') {
                Logger::warning('ArticleController:show - Article non publie', [
                    'slug' => $slug,
                    'statut' => $article['statut'],
                ]);
                http_response_code(404);
                View::view('error', ['message' => 'Article introuvable.']);
                return;
            }

            Logger::info('ArticleController:show - Succes', [
                'slug' => $slug,
                'article_id' => $article['id'] ?? null,
                'article_titre' => $article['titre'] ?? null,
            ]);

            View::view('article-show', ['article' => $article]);
        } catch (\Throwable $e) {
            Logger::error('ArticleController:show - Exception', [
                'slug' => $slug,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            http_response_code(500);
            View::view('error', ['message' => 'Erreur lors du chargement de l\'article.']);
        }
    }

    public function publications()
    {
        Logger::info('ArticleController:publications - Debut');

        try {
            $publicationModel = new PublicationModel();
            $publications = $publicationModel->published();

            Logger::info('ArticleController:publications - Succes', [
                'count' => count($publications),
            ]);

            View::view('publications', [
                'publications' => $publications,
            ]);
        } catch (\Throwable $e) {
            Logger::error('ArticleController:publications - Exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            http_response_code(500);
            View::view('error', ['message' => 'Erreur lors du chargement des publications.']);
        }
    }

    public function showPublication(array $params)
    {
        $slug = $params['slug'] ?? '';

        Logger::info('ArticleController:showPublication - Debut', [
            'slug' => $slug,
            'params' => $params,
        ]);

        try {
            $publicationModel = new PublicationModel();
            $publication = $publicationModel->findBySlug($slug);

            Logger::info('ArticleController:showPublication - Apres findBySlug', [
                'slug' => $slug,
                'publication_found' => !empty($publication),
                'publication_keys' => $publication ? array_keys($publication) : [],
            ]);

            if (!$publication) {
                Logger::warning('ArticleController:showPublication - Publication non trouvee', ['slug' => $slug]);
                http_response_code(404);
                View::view('error', ['message' => 'Publication introuvable.']);
                return;
            }

            if ($publication['statut'] !== 'publie') {
                Logger::warning('ArticleController:showPublication - Publication non publiee', [
                    'slug' => $slug,
                    'statut' => $publication['statut'],
                ]);
                http_response_code(404);
                View::view('error', ['message' => 'Publication introuvable.']);
                return;
            }

            Logger::info('ArticleController:showPublication - Succes', [
                'slug' => $slug,
                'publication_id' => $publication['id'] ?? null,
                'publication_titre' => $publication['titre'] ?? null,
            ]);

            View::view('publication-show', ['publication' => $publication]);
        } catch (\Throwable $e) {
            Logger::error('ArticleController:showPublication - Exception', [
                'slug' => $slug,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            http_response_code(500);
            View::view('error', ['message' => 'Erreur lors du chargement de la publication.']);
        }
    }
}
