<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VCF BOOST — Accès Membre Privé</title>

    <!-- Fonts : High-Level Hybrid (SaaS International) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,300;0,700;1,400&family=Space+Grotesk:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Space Grotesk', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace']
                    },
                    animation: {
                        'blob': 'blob 10s infinite',
                        'scanline': 'scanline 6s linear infinite'
                    },
                    keyframes: {
                        blob: {
                            '0%, 100%': { transform: 'translate(0, 0) scale(1)', opacity: 0.2 },
                            '50%': { transform: 'translate(20px, -20px) scale(1.1)', opacity: 0.4 }
                        },
                        scanline: { '0%': { top: '-100%' }, '100%': { top: '100%' } }
                    }
                }
            }
        }
    </script>

    <style>
        /* Grain & Scanline Premium (Look Cinématique) */
        .grain::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .05; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }
        .scanline::after {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 1px;
            background: linear-gradient(to right, transparent, rgba(99, 102, 241, 0.1), transparent);
            z-index: 9998; pointer-events: none; animation: scanline 6s linear infinite;
        }

        body { background: #050505; color: #fff; cursor: crosshair; }

        /* Custom Input Styling */
        input:focus { outline: none !important; box-shadow: none !important; border-bottom: 2px solid #fff !important; }
        .vertical-text { writing-mode: vertical-rl; transform: rotate(180deg); }
    </style>
</head>
<body class="antialiased grain scanline selection:bg-indigo-500 selection:text-white overflow-hidden font-sans">

<div class="min-h-screen flex flex-col lg:flex-row relative">

    <!-- DÉCORATION : Lueur de fond (Immersion) -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[50vw] h-[50vw] bg-indigo-600/10 rounded-full blur-[120px] animate-blob"></div>
    </div>

    <!-- CÔTÉ GAUCHE : IDENTITÉ & PROMESSE (Marketing Ready) -->
    <div class="lg:w-1/2 p-12 lg:p-20 flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-white/5 relative z-10">

        <!-- Logo & Status -->
        <div class="flex items-center justify-between">
            <a href="/" class="group flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-black italic transition-all group-hover:rotate-12 group-hover:shadow-[0_0_30px_rgba(79,70,229,0.5)]">
                    V
                </div>
                <div class="flex flex-col leading-tight">
                    <span class="text-2xl font-black tracking-tighter uppercase italic">VCF — BOOST</span>
                    <span class="font-mono text-[8px] uppercase tracking-[0.4em] text-white/20 font-bold italic tracking-widest">Espace Membre Élite</span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                <span class="font-mono text-[9px] uppercase tracking-widest text-white/30 font-bold italic">Système Sécurisé</span>
            </div>
        </div>

        <!-- Typographie Monumentale (Bénéfices) -->
        <div class="hidden lg:block relative">
            <div class="absolute -left-16 top-0 text-[10px] font-mono text-white/5 uppercase vertical-text tracking-[1em] font-bold">Expansion // Réseau</div>
            <h2 class="text-[9vw] font-black tracking-tighter leading-[0.85] uppercase italic">
                GROW.<br>
                <span class="text-transparent" style="-webkit-text-stroke: 1px rgba(255,255,255,0.1);">FASTER.</span><br>
                TOGETHER.
            </h2>
        </div>

        <!-- Meta Info (Copywriting humain) -->
        <div class="flex justify-between items-end">
            <div class="space-y-4">
                <p class="font-mono text-[10px] uppercase tracking-widest text-white/20 leading-relaxed italic max-w-sm">
                    Rejoignez la solution n°1 pour transformer vos groupes WhatsApp en véritables leviers de croissance.
                </p>
                <div class="text-[10px] font-mono uppercase tracking-[0.4em] text-white/40 italic font-bold">
                    &copy; {{ date('Y') }} // LA SOLUTION DES LEADERS
                </div>
            </div>
        </div>
    </div>

    <!-- CÔTÉ DROIT : LE FORMULAIRE (Expérience Utilisateur) -->
    <div class="lg:w-1/2 flex items-center justify-center p-8 lg:p-24 bg-white/[0.01] backdrop-blur-sm relative z-10">
        <div class="w-full max-w-md relative">
            <!-- Décorations techniques discrètes -->
            <div class="absolute -top-12 -right-12 w-24 h-24 border-t border-r border-white/5 rounded-tr-[3rem] hidden lg:block"></div>
            <div class="absolute -bottom-12 -left-12 w-24 h-24 border-b border-l border-white/5 rounded-bl-[3rem] hidden lg:block"></div>

            <!-- Injection du contenu (Login/Register/Forgot) -->
            <div class="relative z-10">
                {{ $slot }}
            </div>
        </div>
    </div>

</div>

</body>
</html>
