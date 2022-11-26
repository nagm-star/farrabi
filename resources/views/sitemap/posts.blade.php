<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; 
 $lang = Config::get('app.locale'); 
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@if($lang == 'ar')
    @foreach ($posts as $post)
        <url>
            <loc>http://alfarrabi.edu.sd/{{ $post->slug }}</loc>
            <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>            
            <priority>0.9</priority>
        </url>
    @endforeach
    @else
    @foreach ($posts as $post)
        <url>
            <loc>http://alfarrabi.edu.sd/{{ $post->slug_en }}</loc>
            <lastmod>{{ $post->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>            
            <priority>0.9</priority>
        </url>
    @endforeach
    @endif
</urlset>