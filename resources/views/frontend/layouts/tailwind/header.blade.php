<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Society of Technology and Energy Professionals (STEP) is the fastest growing Professional body in Nigeria.">
    <meta name="author" content="Noble Contracts">

    <meta property="og:url" content="{{ url()->current(); }}">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:description" content="Society of Technology and Energy Professionals (STEP) is the fastest growing Professional body in Nigeria.">
    <meta property="og:image" content="{{ asset('frontend/img/about-step.png') }}">

    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body class="font-step-sans text-gray-700 bg-white">
