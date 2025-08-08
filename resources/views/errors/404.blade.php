<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Page Not Found - 404</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="m-0 bg-gradient-to-br from-blue-50 to-white font-['Inter',_sans-serif] text-gray-800 flex items-center justify-center min-h-screen p-4">
  <div class="max-w-6xl w-full flex flex-wrap items-center justify-between gap-8 md:gap-16">
    <div class="flex-1 min-w-[280px] space-y-6">
      <div class="space-y-2">
        <p class="text-lg font-semibold text-blue-600">404 error</p>
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900">Page not found</h1>
      </div>
      
      <p class="text-lg text-gray-600 max-w-md">
        Sorry, we couldn't find the page you're looking for.
      </p>
      
      <div class="flex flex-wrap gap-4 pt-2">
        <a href="{{ url('/home') }}"
           class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold transition-all hover:bg-blue-700 no-underline shadow-sm hover:shadow-md">
          Go back home
        </a>
      </div>
    </div>

    <div class="flex-1 min-w-[280px] flex justify-center">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img" aria-label="Error Icon"
           class="w-full max-w-[420px] h-auto">
        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="1.5" d="M12 7v6m0 4.01l.01-.011M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2S2 6.477 2 12s4.477 10 10 10z" stroke-linejoin="round"/>
      </svg>
    </div>
  </div>
</body>
</html>