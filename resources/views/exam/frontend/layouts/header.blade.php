<!doctype html>
<html>
<head>
    <title>{{ $title }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css','resources/js/app.js'])

 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/images/favicon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Litepicker CSS (For the Datepicker) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css">

     <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
     <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body class="bg-body text-gray-700 font-quicksand">