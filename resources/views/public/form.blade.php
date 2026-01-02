<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $link->title }} — COLLECTE PRIVÉE</title>

    <!-- Design System : Tailwind & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Space Grotesk', 'sans-serif'] },
                }
            }
        }
    </script>

    <style>
        /* Texture de grain premium */
        .grain::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .05; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }
        body { background-color: #000; color: #fff; }
        input:focus { outline: none; border-bottom: 2px solid #fff !important; }

        /* État verrouillé du bouton */
        .locked-state { filter: grayscale(1); opacity: 0.15; cursor: not-allowed; pointer-events: none; }

        /* Animation de la barre de progression */
        .progress-bar { transition: width 1.5s cubic-bezier(0.65, 0, 0.35, 1); }
    </style>
</head>

<body class="antialiased grain overflow-x-hidden">
<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12 lg:py-24">

    <!-- EN-TÊTE : Titre Massif -->
    <header class="max-w-4xl w-full mb-16 lg:mb-32 text-center lg:text-left">
        <div class="inline-block px-3 py-1 border border-white/10 rounded-full mb-6">
            <span class="text-[10px] uppercase tracking-[0.5em] text-white/40 italic">Terminal de collecte v.01</span>
        </div>
        <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold tracking-tighter uppercase leading-[0.85] italic">
            {{ $link->title }}
        </h1>
    </header>

    <!-- GRILLE PRINCIPALE -->
    <div class="max-w-5xl w-full grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start">

        <!-- COLONNE 1 : FORMULAIRE (Ordre 1 sur Mobile) -->
        <div class="lg:col-span-7 order-1 flex flex-col gap-12">

            @if(session('success'))
                <div class="p-8 border border-white/10 rounded-[2rem] bg-white/[0.02] animate-pulse">
                    <p class="text-2xl italic font-light tracking-tight">"{{ session('success') }}"</p>
                    <p class="text-[10px] uppercase tracking-[0.3em] text-white/30 mt-4 font-bold">Système mis à jour avec succès</p>
                </div>
            @endif

            <form action="{{ route('public.submit', $link->slug) }}" method="POST" class="space-y-16">
                @csrf
                <div class="group relative">
                    <label class="text-[10px] uppercase text-white/30 block mb-4 tracking-[0.4em] font-bold">Identité de l'inscrit</label>
                    <input type="text" name="name" required placeholder="NOM COMPLET"
                           class="w-full bg-transparent border-b border-white/10 py-6 text-3xl lg:text-4xl font-light focus:border-white transition-all outline-none uppercase tracking-tighter placeholder:text-white/5">
                </div>

                <div class="group relative">
                    <label class="text-[10px] uppercase text-white/30 block mb-4 tracking-[0.4em] font-bold">Ligne WhatsApp (International)</label>
                    <input type="text" name="phone" required placeholder="+229 00 00 00 00"
                           class="w-full bg-transparent border-b border-white/10 py-6 text-3xl lg:text-4xl font-light focus:border-white transition-all outline-none uppercase tracking-tighter placeholder:text-white/5">
                </div>

                <button type="submit" class="group flex items-center gap-8 text-[11px] uppercase tracking-[0.5em] font-black hover:gap-12 transition-all">
                    <span class="border-b border-white/20 pb-1">Soumettre les données</span>
                    <div class="w-16 h-16 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all duration-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </div>
                </button>
            </form>
        </div>

        <!-- COLONNE 2 : PROGRESSION & VCF (Ordre 2 sur Mobile) -->
        <div class="lg:col-span-5 order-2 w-full flex flex-col gap-10">
            <div class="p-10 lg:p-12 border border-white/10 rounded-[3rem] bg-white/[0.02] backdrop-blur-sm relative overflow-hidden">

                <!-- Statistiques de données -->
                <div class="mb-16 text-right">
                    <p class="text-[10px] uppercase tracking-[0.4em] text-white/20 mb-6 font-bold italic border-b border-white/5 pb-4">
                        Status du protocole d'export
                    </p>
                    <div class="flex items-baseline justify-end gap-3">
                        <span class="text-8xl lg:text-9xl font-bold tracking-tighter italic leading-none">{{ $link->contacts_count }}</span>
                        <span class="text-3xl text-white/10 font-light">/{{ $link->target_count }}</span>
                    </div>
                </div>

                <!-- Barre de progression cinématique -->
                <div class="h-[1px] w-full bg-white/5 mb-16 relative">
                    @php $percent = ($link->contacts_count / $link->target_count) * 100; @endphp
                    <div class="absolute inset-y-0 right-0 bg-white shadow-[0_0_15px_rgba(255,255,255,0.5)] progress-bar"
                         style="width: {{ min($percent, 100) }}%"></div>
                </div>

                <!-- BLOC TÉLÉCHARGEMENT -->
                <div class="relative">
                    @if($link->contacts_count >= $link->target_count)
                        <!-- État ACTIF -->
                        <a href="{{ route('public.download', $link->slug) }}"
                           class="flex flex-col items-center justify-center gap-8 p-12 bg-white text-black rounded-[2.5rem] hover:scale-[1.03] transition-all duration-700 group shadow-[0_30px_60px_rgba(255,255,255,0.1)]">
                            <div class="w-14 h-14 border border-black/10 rounded-full flex items-center justify-center animate-bounce">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </div>
                            <span class="text-[11px] font-black uppercase tracking-[0.6em]">Télécharger .VCF</span>
                        </a>
                    @else
                        <!-- État VERROUILLÉ (Mais visible) -->
                        <div class="locked-state flex flex-col items-center justify-center gap-8 p-12 border border-white/20 bg-transparent rounded-[2.5rem]">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span class="text-[11px] font-black uppercase tracking-[0.6em]">Export Verrouillé</span>
                        </div>

                        <div class="mt-8 text-center">
                            <p class="text-[10px] text-white/40 uppercase tracking-[0.3em] font-medium">
                                En attente de {{ $link->target_count - $link->contacts_count }} nouvelles entrées
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Footer de colonne -->
            <div class="px-6 text-right opacity-30">
                <p class="text-[9px] leading-relaxed uppercase tracking-[0.4em] italic">
                    Le fichier VCF généré permet l'importation massive des contacts dans votre répertoire mobile. Protocole sécurisé.
                </p>
            </div>
        </div>
    </div>

    <!-- FOOTER GLOBAL -->
    <footer class="mt-40 border-t border-white/5 pt-12 w-full max-w-5xl flex flex-col md:flex-row justify-between items-center gap-8 opacity-20 hover:opacity-100 transition-opacity duration-1000">
        <p class="text-[10px] font-bold uppercase tracking-[1em]">VCF COLLECTOR / TERMINAL 0.1</p>
        <div class="flex gap-8 text-[10px] uppercase tracking-widest font-light italic">
            <span>Privacy First</span>
            <span>Automated System</span>
        </div>
    </footer>

</div>
</body>
</html>
