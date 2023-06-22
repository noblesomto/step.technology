<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{!! Str::words($post->blog_body, 20) !!}">
    <meta name="author" content="Noble Contracts">
    <meta name="keyword" content="">
     

    <meta property="og:url" content="{{ url()->current(); }}">
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{ $title }}" />
    <meta property="og:description" content="{!! Str::words($post->blog_body, 20) !!}">
    <meta property="og:image" content="{{ asset('uploads/blog/'.$post->blog_picture) }}">
    <title>{{ $title }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,700&display=swap" rel="stylesheet">

    <!--  CSS Style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/webfonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/category/personal-blog.css') }}">
</head>