<?php
$domain = Request::getSchemeAndHttpHost();
$host = parse_url($domain)['host'];
if (str_contains($image, $host, ) != 1)
    $image = $domain . $image;

if(strlen($searchTitle) < 5)
    $searchTitle = $title;

if(strlen($description) < 5)
    $description = $title;
?>

<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<meta name="robots" content="index, follow"/>
<title>{{ __('meta.name__1') }}</title>
<link rel="canonical" href="{{url()->current()}}">
<meta name="title" content="{{$title}} - Vinh Long University of Technology Education">
<meta name="description" content="{{$description}}">

<meta property="article:published_time"
      content="{{isset($published_time) == true ? date('c', strtotime($published_time)) : ''}}"/>
<meta property="article:tag" content="{{isset($tag) == true ? $tag : ''}}"/>

<meta property="og:type" content="{{$type}}">
<meta property="og:url" content="{{url()->current()}}">
<meta property="og:title" content="{{$title}}  - Vinh Long University of Technology Education">
<meta property="og:description" content="{{$description}}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:alt" content="{{$searchTitle}}">
<meta property="og:updated_time" content="{{isset($updated_time) == true ? date('c', strtotime($updated_tim)) : ''}}"/>

<meta property="twitter:url" content="{{url()->current()}}">
<meta property="twitter:title" content="{{$title}}  - Vinh Long University of Technology Education">
<meta property="twitter:description" content="{{$description}}">
<meta property="twitter:image" content="{{$image}}">

<link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="16x16" type="image/png">
<link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="32x32" type="image/png">
<link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="48x48" type="image/png">
<link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="62x62" type="image/png">
<link rel="icon" href="{{asset('dist/images/logo.png')}}" sizes="192x192" type="image/png">
