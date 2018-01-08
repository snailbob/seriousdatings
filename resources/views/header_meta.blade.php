<?php
    //all pages, header meta
    $titletag = App\SeoContent::where('type', 'titletag')->first();
    $description = App\SeoContent::where('type', 'description')->first();
    $keyword = App\SeoContent::where('type', 'keyword')->first();
    $copyright = App\SeoContent::where('type', 'copyright')->first();
?>

    <title>SeriousDatings | {{$titletag->content}}</title>
    <meta name="description" content="{{$description->content}}" />
    <meta name="copyright" content="{{$copyright->content}}" />
    <meta name="keywords" content="{{$keyword->content}}" />
