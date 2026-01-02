<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VCF COLLECTOR — PRIVATE CONSOLE</title>

    <!-- Font: Un style "Grotesk" très haut de gamme -->
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Space Grotesk', 'sans-serif'] },
                    colors: {
                        'vblack': '#0f0f0f',
                        'vgrey': '#1a1a1a',
                        'vaccent': '#f4f4f4'
                    }
                }
            }
        }
    </script>
    <style>
        /* Texture de grain subtile pour le côté Premium */
        .grain::before {
            content: "";
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .04; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-vblack text-white antialiased grain">
<div class="min-h-screen flex flex-col">
    @include('layouts.navigation')
    <main class="flex-grow">
        {{ $slot }}
    </main>
</div>
</body>
</html>
