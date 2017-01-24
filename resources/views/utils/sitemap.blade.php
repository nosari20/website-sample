<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
    <loc>{{url('/')}}</loc>
    <priority>1.0000</priority>
</url>

@foreach($urls as $url)
<url>
    <loc>{{url('/')}}/{{$url->loc}}</loc>
    @if($url->lastmod != null)
    <lastmod>{{$url->lastmod}}</lastmod>
    @endif
    @if($url->priority != null)
    <priority>{{$url->priority}}</priority>
    @else
    <priority>0.5000</priority>
    @endif
    
</url>

@endforeach
 
</urlset>