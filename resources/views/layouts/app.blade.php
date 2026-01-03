<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VCF SYSTEM — PRIVATE TERMINAL</title>

    <!-- Fonts : Hybride Haute Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,300;0,700;1,400&family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts & Frameworks -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Space Grotesk', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace']
                    },
                    animation: {
                        'marquee': 'marquee 40s linear infinite',
                        'blob': 'blob 12s infinite',
                        'scanline': 'scanline 8s linear infinite'
                    },
                    keyframes: {
                        marquee: { '0%': { transform: 'translateX(0%)' }, '100%': { transform: 'translateX(-100%)' } },
                        blob: {
                            '0%, 100%': { transform: 'translate(0, 0) scale(1)', opacity: 0.3 },
                            '33%': { transform: 'translate(20px, -30px) scale(1.1)', opacity: 0.5 },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)', opacity: 0.3 }
                        },
                        scanline: { '0%': { top: '-100%' }, '100%': { top: '100%' } }
                    }
                }
            }
        }
    </script>

    <style>
        /* Grain Cinématographique */
        .grain::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .04; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }

        /* Scanline : Ligne de balayage technique ultra-fine */
        .scanline::after {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 2px;
            background: linear-gradient(to right, transparent, rgba(99, 102, 241, 0.1), transparent);
            z-index: 9998; pointer-events: none; animation: scanline 8s linear infinite;
        }

        body {
            background: #050505;
            color: #fafafa;
            cursor: crosshair;
            overflow-x: hidden;
        }

        /* Scrollbar "Elite" personnalisée */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #050505; }
        ::-webkit-scrollbar-thumb { background: #1a1a1a; border-radius: 10px; transition: all 0.3s; }
        ::-webkit-scrollbar-thumb:hover { background: #6366f1; }

        .text-outline { -webkit-text-stroke: 1px rgba(255,255,255,0.15); color: transparent; }

        /* Focus Style Premium */
        input:focus { outline: none !important; box-shadow: none !important; border-bottom: 2px solid #fff !important; }
        select { appearance: none; background-image: none !important; }

        /* Utilitaires de texte verticaux pour les designs sophistiqués */
        .vertical-text { writing-mode: vertical-rl; transform: rotate(180deg); }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased grain scanline font-sans selection:bg-indigo-500 selection:text-white">

<!-- Éléments de fond Immersifs -->
<div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
    <div class="absolute top-[-10%] left-[-10%] w-[40vw] h-[40vw] bg-indigo-600/10 rounded-full blur-[120px] animate-blob"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40vw] h-[40vw] bg-purple-600/10 rounded-full blur-[120px] animate-blob" style="animation-delay: 4s;"></div>
</div>

<div class="relative z-10 min-h-screen flex flex-col">
    <!-- Navigation System -->
    @include('layouts.navigation')

    <!-- Main Terminal -->
    <main class="flex-grow flex flex-col">
        {{ $slot }}
    </main>

    <!-- Global Status Bar (Petit rappel de sécurité en bas de page) -->
    <footer class="px-6 lg:px-12 py-8 border-t border-white/5 opacity-20 hover:opacity-100 transition-opacity duration-1000">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="font-mono text-[9px] uppercase tracking-[0.4em] italic font-bold">Protocol Status: Encrypted / Active</p>
            <div class="flex gap-8 font-mono text-[9px] uppercase tracking-widest italic font-bold">
                <span>© {{ date('Y') }} VCF SYS</span>
                <span class="text-indigo-500 underline decoration-indigo-500/20">Access Restricted</span>
            </div>
        </div>
    </footer>
</div>

<!-- Script pour les notifications Premium (Toast) -->
@if (session('success') || session('error'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 5000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="translate-y-12 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         x-transition:leave="transition ease-in duration-300"
         class="fixed bottom-12 left-1/2 -translate-x-1/2 z-[9999]">
        <div class="px-8 py-4 {{ session('success') ? 'bg-white text-black' : 'bg-red-600 text-white' }} rounded-full font-black text-[10px] uppercase tracking-[0.3em] shadow-2xl flex items-center gap-4">
            <span>{{ session('success') ?? session('error') }}</span>
            <button @click="show = false" class="opacity-50 hover:opacity-100">✕</button>
        </div>
    </div>
@endif

</body>
</html>
