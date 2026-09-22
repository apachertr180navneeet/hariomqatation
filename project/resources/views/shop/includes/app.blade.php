<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? 'Hari Om Computer | Your Trusted Computer & Technology Partner (Jodhpur)' }}</title>
    <meta name="description" content="Hari Om Computer is Western Rajasthan's premier computer showroom in Jodhpur offering custom PC builds, laptops, genuine hardware components, and instant GST quotations.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Storefront CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/store.css') }}">

    @stack('styles')
</head>

<body>

    @include('shop.includes.header')

    @include('shop.includes.menu')

    <!-- Main Page Content -->
    @yield('content')

    @include('shop.includes.footer')

</body>
</html>
