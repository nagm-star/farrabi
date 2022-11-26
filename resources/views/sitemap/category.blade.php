<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach ($categories as $category)
        <url>
            <loc>http://alfarrabi.edu.sd/{{ $category->name }}</loc>
            <lastmod>{{ $category->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>            
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>