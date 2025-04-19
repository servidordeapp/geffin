<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    <title>@yield('title')</title>
</head>

<body class="bg-gradient-to-b from-base-200 to-base-100 min-h-screen flex items-center justify-center p-6">
    <section class="w-full max-w-xl">
        <div class="card bg-white shadow-lg border border-base-300">
            <div class="card-body">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <!-- Lado esquerdo - Ícone/Ilustração -->
                    <div class="flex-shrink-0 w-24 h-24 md:w-32 md:h-32 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Lado direito - Conteúdo -->
                    <div class="flex-grow text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl font-bold text-primary mb-2">
                            @yield('code')
                        </h1>

                        <h2 class="text-xl md:text-2xl font-semibold text-base-content mb-2">
                            @yield('message')
                        </h2>

                        <div class="text-sm text-base-content/80 mb-6">
                            @yield('description')
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-md w-full sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Página Inicial
                    </a>

                    <button class="btn btn-outline btn-md w-full sm:w-auto" onclick="window.history.back()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Voltar
                    </button>
                </div>
            </div>
        </div>

        <!-- Dica adicional com link de suporte -->
        <div class="mt-6 text-center">
            <span class="badge badge-ghost gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Precisa de ajuda?
            </span>
            <a href="#" class="link link-primary text-sm ml-2">Contatar suporte</a>
        </div>
    </section>
</body>
    </html>
