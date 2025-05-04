<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForumCategory;
use App\Models\ForumTag;
use Illuminate\Support\Str;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create forum categories
        $categories = [
            [
                'name' => 'Jobseeker Discussion',
                'slug' => 'jobseeker-discussion',
                'description' => 'A place for job seekers to discuss job hunting strategies, resume tips, interview experiences, and more.',
                'order' => 1,
            ],
            [
                'name' => 'Employer/Company Discussion',
                'slug' => 'employer-company-discussion',
                'description' => 'A forum for employers and companies to discuss hiring practices, talent acquisition, and workplace culture.',
                'order' => 2,
            ],
            [
                'name' => 'Mixed Discussion',
                'slug' => 'mixed-discussion',
                'description' => 'Open conversations between job seekers and employers on various topics related to employment and careers.',
                'order' => 3,
            ],
        ];

        foreach ($categories as $category) {
            ForumCategory::create($category);
        }

        // Create forum tags
        $tags = [
            ['name' => 'Question', 'slug' => 'question', 'color' => '#3B82F6'], // Blue
            ['name' => 'Discussion', 'slug' => 'discussion', 'color' => '#10B981'], // Green
            ['name' => 'Advice', 'slug' => 'advice', 'color' => '#8B5CF6'], // Purple
            ['name' => 'Experience', 'slug' => 'experience', 'color' => '#F59E0B'], // Amber
            ['name' => 'Tips', 'slug' => 'tips', 'color' => '#EC4899'], // Pink
            ['name' => 'Resources', 'slug' => 'resources', 'color' => '#6366F1'], // Indigo
            ['name' => 'News', 'slug' => 'news', 'color' => '#EF4444'], // Red
        ];

        foreach ($tags as $tag) {
            ForumTag::create($tag);
        }
    }
}
