<?php

declare(strict_types=1);

namespace Modules\Blog\Actions;

use Illuminate\Support\Str;
use Webmozart\Assert\Assert;
use Modules\Blog\Models\Post;
use Illuminate\Support\Facades\Http;
use Spatie\QueueableAction\QueueableAction;

class ImportFromNewsApi
{
    use QueueableAction;

    /**
     * Undocumented function.
     */
    public function execute(): void
    {
        // $url = 'https://newsapi.org/v2/top-headlines?country=it&apiKey='.config('services.newsapi.app_key');
        $url = 'https://newsapi.org/v2/everything?q=cripto&sortBy=popularity&apiKey='.config('services.newsapi.app_key');
        $response = Http::get($url);
        Assert::isArray($res = $response->json());
        $posts = $res['articles'];

        foreach ($posts as $post) {
            $res = Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title'], '-'),
                'body' => $post['content'],
                'active' => true,
                'published_at' => $post['publishedAt'],
            ]);
            $res->addMediaFromUrl($post['urlToImage'])
                ->toMediaCollection();
        }
    }
}

// ricordarsi di eseguire php artisan storage:link per memorizzare le immagini

/*
 "source" => array:2 [▼
          "id" => null
          "name" => "Hipertextual"
        ]
        "author" => "Hipertextual (Redacción)"
        "title" => "Bit2Me es nombrada como una de las plataformas cripto más confiables, por delante de sus principales competidores"
        "description" => "2022 fue un año muy complicado para las criptomonedas. La caída de grandes plataformas como FTX o Celsius, debido a falta de transparencia financiera y a no cumplir con una regulación clara, provocó una pérdida de confianza entre los usuarios hacia el sector … ◀"
        "url" => "http://hipertextual.com/2023/11/bit2me-segura"
        "urlToImage" => "https://imgs.hipertextual.com/wp-content/uploads/2023/11/LeifFerreira-AndreiManuel-PabloCasadio-KohOnozawa-bolsa-madrid-01-scaled.jpg"
        "publishedAt" => "2023-11-24T11:20:29Z"
        "content" => "2022 fue un año muy complicado para las criptomonedas. La caída de grandes plataformas como FTX o Celsius, debido a falta de transparencia financiera y a no cumplir con una regulación clara, provocó … [+8265 chars]
*/