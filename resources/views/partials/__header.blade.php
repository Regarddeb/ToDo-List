<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{$title}}</title>
  @vite('resources/css/app.css')
  @vite('node_modules/boxicons/css/boxicons.min.css')
  @vite('node_modules/sweetalert2/dist/sweetalert2.js')
  @vite('resources/js/app.js')
</head>
<body class="text-gray-200 bg-gray-950 font-poppins_reg min-h-screen max-h-screen flex flex-col">
  @include('components.__nav')

  <div class="container mx-auto"><hr class="opacity-10"></div>

  <div class="container px-2 md:px-8 mx-auto flex overflow-hidden justify-around">

    