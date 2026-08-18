<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Event;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $xml = Cache::remember('sitemap.xml', now()->addHours(6), function () {
            $staticPages = [
                ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly'],
                ['url' => url('/about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
                ['url' => url('/about-coretep'), 'priority' => '0.8', 'changefreq' => 'monthly'],
                ['url' => url('/step-support'), 'priority' => '0.6', 'changefreq' => 'monthly'],
                ['url' => url('/memberships'), 'priority' => '0.9', 'changefreq' => 'monthly'],
                ['url' => url('/trainings'), 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['url' => url('/certifications'), 'priority' => '0.7', 'changefreq' => 'monthly'],
                ['url' => url('/journal-publication'), 'priority' => '0.6', 'changefreq' => 'monthly'],
                ['url' => url('/blog'), 'priority' => '0.8', 'changefreq' => 'daily'],
                ['url' => url('/events'), 'priority' => '0.8', 'changefreq' => 'daily'],
                ['url' => url('/contact'), 'priority' => '0.5', 'changefreq' => 'yearly'],
                ['url' => url('/ICTES2025'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ];

            $blogUrls = Blog::where('blog_status', 1)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(fn ($post) => [
                    'url' => url('/blog/' . $post->blog_id . '/' . $post->blog_slug),
                    'priority' => '0.6',
                    'changefreq' => 'monthly',
                    'lastmod' => $post->updated_at->toAtomString(),
                ]);

            $eventUrls = Event::orderBy('created_at', 'desc')
                ->get()
                ->map(fn ($event) => [
                    'url' => url('/events/' . $event->event_id . '/' . $event->event_slug),
                    'priority' => '0.6',
                    'changefreq' => 'monthly',
                    'lastmod' => $event->updated_at->toAtomString(),
                ]);

            $urls = collect($staticPages)->merge($blogUrls)->merge($eventUrls);

            return view('sitemap', compact('urls'))->render();
        });

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
