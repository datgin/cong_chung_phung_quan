<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $catalogueIds = [3, 4];

        for ($i = 1; $i <= 20; $i++) {
            $title = "Bài viết thử nghiệm số $i";
            $slug = Str::slug($title);

            DB::table('posts')->insert([
                'catalogue_id'       => $catalogueIds[array_rand($catalogueIds)],
                'title'              => $title,
                'slug'               => $slug,
                'excerpt'            => 'Đây là đoạn mô tả ngắn cho ' . $title,
                'content'            => '<p>Nội dung chi tiết của ' . $title . '</p>',
                'thumbnail'          => '/images/posts/sample-thumbnail.jpg',
                'meta_title'         => $title . ' - Website Demo',
                'meta_description'   => 'Mô tả SEO cho ' . $title,
                'published'          => rand(0, 1),
                'published_at'       => Carbon::now()->subDays(rand(0, 30)),
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ]);
        }
    }
}
