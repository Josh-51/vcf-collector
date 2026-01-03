<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VCF SYSTEM — L'Annuaire Collectif Intelligent</title>
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
        .grain::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .05; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }
        body { background-color: #000; color: #fff; }
        .text-outline { -webkit-text-stroke: 1px rgba(255,255,255,0.3); color: transparent; }
        .text-glow:hover { text-shadow: 0 0 15px rgba(255,255,255,0.5); }
        .bg-blur { backdrop-filter: blur(12px); background: rgba(0,0,0,0.7); }
    </style>
</head>

<body class="antialiased grain overflow-x-hidden">

<!-- NAVIGATION -->
<nav class="fixed top-0 w-full z-50 px-6 lg:px-12 py-8 flex justify-between items-center bg-blur border-b border-white/5">
    <a href="/" class="text-xl font-bold tracking-tighter italic uppercase">VCF — SYSTEM</a>
    <div class="flex items-center gap-8">
        <a href="#logic" class="hidden md:block text-[10px] uppercase tracking-widest opacity-40 hover:opacity-100 italic transition-all">Fonctionnement</a>
        <a href="#cases" class="hidden md:block text-[10px] uppercase tracking-widest opacity-40 hover:opacity-100 italic transition-all">Cas d'usage</a>
        @auth
            <a href="{{ route('dashboard') }}" class="text-[10px] uppercase tracking-[0.3em] font-bold border border-white/20 px-8 py-3 rounded-full hover:bg-white hover:text-black transition-all">Console</a>
        @else
            <a href="{{ route('login') }}" class="text-[10px] uppercase tracking-[0.3em] font-bold italic opacity-60 hover:opacity-100">Login</a>
            <a href="{{ route('register') }}" class="text-[10px] uppercase tracking-[0.3em] font-bold bg-white text-black px-8 py-3 rounded-full hover:invert transition-all">Start Now</a>
        @endauth
    </div>
</nav>

<!-- 1. HERO SECTION : L'IMPACT -->
<section class="min-h-screen flex flex-col items-center justify-center pt-32 px-6">
    <div class="max-w-7xl w-full text-center">
        <span class="text-[10px] uppercase tracking-[0.6em] text-white/40 block mb-12 italic animate-pulse">Unlock the power of your group</span>

        <h1 class="text-[13vw] lg:text-[11vw] font-bold tracking-tighter uppercase leading-[0.8] italic mb-16">
            Build. <span class="text-outline">Unlock.</span><br>
            Connect.
        </h1>

        <div class="flex flex-col lg:flex-row items-center justify-center gap-12 mt-12">
            <p class="max-w-lg text-lg lg:text-xl font-light leading-snug tracking-tight text-white/50 text-center lg:text-left border-l border-white/10 pl-8">
                Créez un annuaire collaboratif. Une fois l'objectif de membres atteint, le répertoire devient téléchargeable pour **tous les participants**.
            </p>
            <div class="flex flex-col items-center gap-6">
                <a href="{{ route('register') }}" class="px-16 py-8 bg-white text-black rounded-full font-black uppercase text-sm tracking-[0.4em] hover:scale-105 transition-transform shadow-[0_0_50px_rgba(255,255,255,0.2)]">
                    Lancer une collecte
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 2. LA LOGIQUE : UNLOCK FOR ALL -->
<section id="logic" class="py-40 bg-white text-black rounded-[4rem] lg:rounded-[8rem] mx-2 lg:mx-6 px-6 lg:px-20">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-20 items-center">
        <div>
            <span class="text-[10px] uppercase tracking-widest text-black/40 font-bold mb-8 block italic">Le Concept — Collaborative Growth</span>
            <h2 class="text-6xl lg:text-8xl font-bold tracking-tighter uppercase leading-[0.9] italic mb-10">
                Un effort<br>collectif.
            </h2>
            <p class="text-xl font-light leading-relaxed opacity-70">
                Pourquoi enregistrer 100 numéros manuellement quand vous pouvez laisser la technologie le faire pour vous ? Chaque membre s'inscrit, la barre progresse. Quand elle est pleine, **le bouton de téléchargement apparaît pour tout le monde.**
            </p>
        </div>
        <div class="grid grid-cols-1 gap-4">
            <div class="p-10 border border-black/10 rounded-[3rem] bg-black/5 hover:bg-black hover:text-white transition-all duration-700">
                <h3 class="text-3xl font-bold italic mb-4 uppercase tracking-tighter">0% Effort Admin</h3>
                <p class="font-light opacity-60">L'administrateur n'a qu'à partager le lien. Les membres font le reste.</p>
            </div>
            <div class="p-10 border border-black/10 rounded-[3rem] bg-black/5 hover:bg-black hover:text-white transition-all duration-700">
                <h3 class="text-3xl font-bold italic mb-4 uppercase tracking-tighter">100% Pour tous</h3>
                <p class="font-light opacity-60">Le fichier VCF est accessible par chaque participant. Un clic, et tout le groupe est dans les contacts.</p>
            </div>
        </div>
    </div>
</section>

<!-- 3. CAS D'USAGE (THE CARDS) -->
<section id="cases" class="py-60 px-6 lg:px-12">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-center text-4xl lg:text-6xl font-bold tracking-tighter uppercase mb-32 italic underline decoration-white/10 underline-offset-[20px]">
            Où utiliser VCF System ?
        </h2>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Case 1 -->
            <div class="group relative aspect-[4/5] border border-white/5 rounded-[3rem] overflow-hidden p-10 flex flex-col justify-end transition-all hover:border-white/20">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80 z-10"></div>
                <div class="relative z-20">
                    <span class="text-[10px] uppercase tracking-widest text-white/40 mb-4 block">Événements</span>
                    <h4 class="text-3xl font-bold uppercase italic tracking-tighter mb-4">Mariages & Fêtes</h4>
                    <p class="text-sm font-light opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                        Permettez à tous les invités de se connecter entre eux instantanément sans chercher les numéros.
                    </p>
                </div>
            </div>
            <!-- Case 2 -->
            <div class="group relative aspect-[4/5] border border-white/5 rounded-[3rem] overflow-hidden p-10 flex flex-col justify-end transition-all hover:border-white/20">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80 z-10"></div>
                <div class="relative z-20">
                    <span class="text-[10px] uppercase tracking-widest text-white/40 mb-4 block">Business</span>
                    <h4 class="text-3xl font-bold uppercase italic tracking-tighter mb-4">Webinaires</h4>
                    <p class="text-sm font-light opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                        Idéal pour les groupes de formation. Débloquez le réseau dès que la masterclass commence.
                    </p>
                </div>
            </div>
            <!-- Case 3 -->
            <div class="group relative aspect-[4/5] border border-white/5 rounded-[3rem] overflow-hidden p-10 flex flex-col justify-end transition-all hover:border-white/20">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80 z-10"></div>
                <div class="relative z-20">
                    <span class="text-[10px] uppercase tracking-widest text-white/40 mb-4 block">Communauté</span>
                    <h4 class="text-3xl font-bold uppercase italic tracking-tighter mb-4">Associations</h4>
                    <p class="text-sm font-light opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                        Gérez les membres d'une église ou d'une ONG. Un répertoire centralisé et partagé.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. EXPERIENCE UTILISATEUR (VERTICAL TIMELINE) -->
<section class="py-40 bg-zinc-900 mx-2 lg:mx-6 rounded-[4rem] lg:rounded-[8rem] px-6">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-5xl lg:text-7xl font-bold tracking-tighter uppercase mb-24 italic text-center leading-none">
            Le parcours<br>utilisateur.
        </h2>

        <div class="space-y-32">
            <div class="flex flex-col md:flex-row gap-12 items-start">
                <span class="text-8xl font-black text-white/5 leading-none">01</span>
                <div class="flex-1 pt-4">
                    <h3 class="text-2xl font-bold uppercase tracking-widest mb-6">Partage du lien</h3>
                    <p class="font-light text-white/40 leading-relaxed italic text-xl">L'administrateur envoie l'URL unique dans le groupe WhatsApp ou par QR Code lors de l'événement.</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-12 items-start">
                <span class="text-8xl font-black text-white/5 leading-none">02</span>
                <div class="flex-1 pt-4">
                    <h3 class="text-2xl font-bold uppercase tracking-widest mb-6">Contribution Sociale</h3>
                    <p class="font-light text-white/40 leading-relaxed italic text-xl">Chaque participant saisit son nom et son numéro. Ils voient la barre de progression se remplir en temps réel.</p>
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-12 items-start">
                <span class="text-8xl font-black text-white/5 leading-none">03</span>
                <div class="flex-1 pt-4">
                    <h3 class="text-2xl font-bold uppercase tracking-widest mb-6">Explosion de contacts</h3>
                    <p class="font-light text-white/40 leading-relaxed italic text-xl">Dès que l'objectif est atteint, un gros bouton blanc apparaît. Chaque personne télécharge le VCF et enregistre **tout le monde** d'un coup.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. FAQ (MINIMALIST) -->
<section class="py-60 px-6">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-4xl font-bold uppercase tracking-tighter mb-20 italic">F.A.Q System</h2>
        <div class="divide-y divide-white/10">
            <div class="py-8 group cursor-pointer">
                <h3 class="text-xl font-bold group-hover:pl-4 transition-all">Est-ce que c'est sécurisé ?</h3>
                <p class="mt-4 text-white/40 font-light italic">Oui. Nous utilisons un protocole de cryptage pour les données et un numéro ne peut être saisi qu'une seule fois par lien.</p>
            </div>
            <div class="py-8 group cursor-pointer">
                <h3 class="text-xl font-bold group-hover:pl-4 transition-all">Format des fichiers exportés ?</h3>
                <p class="mt-4 text-white/40 font-light italic">Le système génère des fichiers .VCF (vCard), compatibles avec 100% des smartphones (iPhone, Android, Windows).</p>
            </div>
            <div class="py-8 group cursor-pointer">
                <h3 class="text-xl font-bold group-hover:pl-4 transition-all">Combien de contacts peut-on collecter ?</h3>
                <p class="mt-4 text-white/40 font-light italic">Autant que vous voulez. De 10 à 10 000 contacts, le système reste stable et rapide.</p>
            </div>
        </div>
    </div>
</section>

<!-- 6. FINAL CTA -->
<section class="pb-60 px-6">
    <div class="max-w-7xl mx-auto text-center border-t border-white/5 pt-40">
        <h2 class="text-[12vw] font-bold tracking-tighter uppercase italic leading-[0.7] mb-20">
            Start Now.<br><span class="text-outline">Free.</span>
        </h2>
        <div class="flex flex-col items-center gap-8">
            <a href="{{ route('register') }}" class="px-20 py-10 bg-white text-black rounded-full font-black uppercase text-xs tracking-[0.5em] hover:invert transition-all">
                Ouvrir une console
            </a>
            <p class="text-[10px] uppercase tracking-[0.4em] opacity-30 italic">L'annuaire intelligent vous attend.</p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="p-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8 opacity-20 hover:opacity-100 transition-opacity">
    <div class="text-[10px] font-bold uppercase tracking-[1em]">VCF SYSTEM / PRIVATE / {{ date('Y') }}</div>
    <div class="flex gap-12 text-[10px] uppercase tracking-widest font-light italic">
        <span>Powered by Precision</span>
        <span>Mobile-First Engine</span>
    </div>
</footer>

</body>
</html>
