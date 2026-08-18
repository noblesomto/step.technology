<!doctype html>
<html>
<head>
    <title>{{ $title }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome/css/all.min.css') }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/images/favicon.png') }}">
    <!-- Litepicker CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css">
  <!-- Litepicker JS -->
  <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="bg-body text-gray-700">