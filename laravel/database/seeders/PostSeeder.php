<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Post;

class PostSeeder extends Seeder
{
    public function run()
    {
        $response = Http::get('https://api.rss2json.com/v1/api.json?rss_url=https://vnexpress.net/rss/tin-moi-nhat.rss');

        if (!$response->ok()) {
            $this->command->error('Không lấy được dữ liệu từ RSS.');
            return;
        }

        $items = $response->json('items');

        foreach ($items as $item) {
            Post::create([
                'catalogue_id' => rand(3, 4),
                'title'             => $item['title'],
                'slug'              => Str::slug($item['title']),
                'excerpt'           => Str::limit(strip_tags($item['description']), 150),
                'content'           => strip_tags($item['content'], '<p><br><b><strong><img><a>'), // giữ lại 1 số thẻ HTML cơ bản
                'thumbnail'         => $item['enclosure']['link'] ?? null,
                'meta_title'        => $item['title'],
                'meta_description'  => Str::limit(strip_tags($item['description']), 160),
                'published'         => true,
                'published_at'      => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }

        $this->command->info('✅ Đã thêm ' . count($items) . ' bài viết thật từ VNExpress.');
    }
}
