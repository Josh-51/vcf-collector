<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VCF COLLECTOR — AUTH</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background: #0f0f0f; color: #fff; }
        .grain::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .04; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }
        input:focus { outline: none; border-bottom: 2px solid #fff !important; }
    </style>
</head>
<body class="antialiased grain">
<div class="min-h-screen flex flex-col lg:flex-row">
    <!-- Côté Gauche : Identité Visuelle -->
    <div class="lg:w-1/2 p-12 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-white/5">
        <a href="/" class="text-xl font-bold tracking-tighter italic uppercase">
            VCF — <span class="font-light">System</span>
        </a>

        <div class="hidden lg:block">
            <h2 class="text-8xl font-bold tracking-tighter leading-none uppercase italic opacity-20">
                Data<br>Collector<br>v.01
            </h2>
        </div>

        <div class="text-[10px] uppercase tracking-[0.4em] text-white/30 italic">
            &copy; {{ date('Y') }} High-End Private Terminal
        </div>
    </div>

    <!-- Côté Droit : Le Formulaire -->
    <div class="lg:w-1/2 flex items-center justify-center p-12 bg-white/[0.01]">
        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</div>
</body>
</html>
