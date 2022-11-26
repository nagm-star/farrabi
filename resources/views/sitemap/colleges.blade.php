<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; 
 $lang = Config::get('app.locale'); 
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@if($lang == 'ar')
@foreach ($colleges as $college)
<url>
    <loc>http://alfarrabi.edu.sd/{{ $college->title }}</loc>
    <lastmod>{{ $college->created_at->tz('UTC')->toAtomString() }}</lastmod>
    <changefreq>daily</changefreq>            
    <priority>0.9</priority>
</url>
@endforeach
@else
@foreach ($colleges as $college)
<url>
    <loc>http://alfarrabi.edu.sd/{{ $college->title_en }}</loc>
    <lastmod>{{ $college->created_at->tz('UTC')->toAtomString() }}</lastmod>
    <changefreq>daily</changefreq>            
    <priority>0.9</priority>
</url>
@endforeach
@endif

</urlset>