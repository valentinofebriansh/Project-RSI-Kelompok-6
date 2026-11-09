<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Reservasi Game Corner FILKOM UB')</title>

  <!-- Font Google: Namdhinggo, Inter, & DM Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@400;500;600;700&family=Namdhinggo:wght@600;700;800&display=swap" rel="stylesheet">

  <!-- Memanggil CSS & JS melalui Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <main class="mobile-screen-container">
    @yield('content')
  </main>

  @stack('scripts')
</body>
</html>