<!doctype html>
<html>
<head>
    <title>{{ $title }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-body text-gray-700">
