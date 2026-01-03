<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VCF SYSTEM — Intelligence Collective</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Space Grotesk', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace']
                    },
                    animation: {
                        'pulse-slow': 'pulse 8s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'marquee': 'marquee 25s linear infinite',
                    },
                    keyframes: {
                        marquee: {
                            '0%': { transform: 'translateX(0%)' },
                            '100%': { transform: 'translateX(-100%)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { background-color: #050505; color: #fafafa; }
        .grain::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .03; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }
        .hero-glow { background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%); }
        .text-outline { -webkit-text-stroke: 1px rgba(255,255,255,0.2); color: transparent; }
        .bento-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .nav-blur { backdrop-filter: blur(20px); background: rgba(5, 5, 5, 0.8); }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: #222; border-radius: 10px; }
    </style>
</head>

<body class="antialiased grain overflow-x-hidden font-sans selection:bg-indigo-500/30">

<!-- NAVIGATION (PAS DE BURGER - BOUTONS TOUJOURS VISIBLES) -->
<nav class="fixed top-0 w-full z-[100] px-4 lg:px-12 py-4 lg:py-6 nav-blur border-b border-white/5">
    <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-2 group shrink-0">
            <div class="w-8 h-8 bg-indigo-600 rounded flex items-center justify-center font-bold text-white transition-transform group-hover:rotate-12">V</div>
            <span class="text-lg lg:text-xl font-bold tracking-tighter uppercase italic">VCF <span class="text-indigo-500">SYS</span></span>
        </a>

        <!-- Actions (Toujours visibles sur Mobile et Desktop) -->
        <div class="flex items-center gap-2 sm:gap-6">
            @auth
                <a href="{{ route('dashboard') }}" class="text-[10px] sm:text-xs font-mono uppercase tracking-widest bg-white text-black px-4 py-2 lg:px-6 lg:py-2.5 rounded font-bold hover:bg-indigo-500 hover:text-white transition-all whitespace-nowrap">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-[10px] sm:text-xs font-mono uppercase tracking-widest opacity-60 hover:opacity-100 transition-all font-bold px-2">Se connecter</a>
                <a href="{{ route('register') }}" class="text-[10px] sm:text-xs font-mono uppercase tracking-widest bg-white text-black px-3 py-2 sm:px-6 sm:py-2.5 rounded font-black hover:bg-indigo-600 hover:text-white transition-all whitespace-nowrap shadow-xl shadow-white/5">S'inscrire</a>
            @endauth
        </div>
    </div>
</nav>

<!-- 1. HERO SECTION -->
<section class="relative min-h-[90vh] lg:min-h-screen flex flex-col items-center justify-center pt-24 pb-12 px-6 hero-glow">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-[600px] aspect-square bg-indigo-500/10 blur-[80px] lg:blur-[120px] rounded-full animate-pulse-slow"></div>

    <div class="max-w-7xl w-full text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-500/30 bg-indigo-500/5 mb-8">
            <span class="text-[9px] lg:text-[10px] font-mono uppercase tracking-[0.2em] text-indigo-400 italic font-bold">v2.0 Private Terminal Active</span>
        </div>

        <h1 class="text-4xl md:text-7xl lg:text-[11vw] font-bold tracking-tighter uppercase leading-[1] lg:leading-[0.85] italic mb-8 lg:mb-12">
            Collect. <span class="text-outline italic">Unlock.</span><br>
            Collaborate.
        </h1>

        <div class="flex flex-col items-center max-w-2xl mx-auto">
            <p class="text-base lg:text-xl font-light text-white/50 mb-10 lg:mb-12 leading-relaxed px-4">
                Le premier protocole de croissance virale pour WhatsApp. <br class="hidden lg:block">
                Centralisez vos contacts, automatisez le déblocage, libérez l'accès.
            </p>
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-white text-black rounded font-black uppercase text-[11px] tracking-[0.3em] hover:bg-indigo-600 hover:text-white transition-all duration-500 flex items-center justify-center gap-3 shadow-2xl shadow-indigo-500/20">
                Lancer un lien public
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- 2. MARQUEE (CONTENU SUPPRIMÉ RÉTABLI) -->
<div class="py-12 lg:py-20 border-y border-white/5 overflow-hidden bg-white/[0.01]">
    <div class="flex animate-marquee whitespace-nowrap gap-12 lg:gap-20">
        <span class="text-4xl lg:text-7xl font-black uppercase italic text-outline">WHATSAPP DATABASE</span>
        <span class="text-4xl lg:text-7xl font-black uppercase italic opacity-10">VCF EXPORT</span>
        <span class="text-4xl lg:text-7xl font-black uppercase italic text-outline">COLLABORATIVE UNLOCK</span>
        <span class="text-4xl lg:text-7xl font-black uppercase italic opacity-10">ELITE TERMINAL</span>
    </div>
</div>

<!-- 3. LA LOGIQUE -->
<section id="logic" class="py-16 lg:py-32 px-6">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 lg:gap-24 items-center">
        <div class="relative order-2 lg:order-1 text-center lg:text-left">
            <span class="font-mono text-[10px] uppercase tracking-[0.4em] text-indigo-500 mb-6 block font-bold italic tracking-widest text-center lg:text-left">The Collaborative Logic</span>
            <h2 class="text-4xl lg:text-7xl font-bold tracking-tighter uppercase leading-[0.95] mb-8 italic">
                Pourquoi travailler seul ?
            </h2>
            <p class="text-lg lg:text-xl text-white/50 font-light leading-relaxed mb-10 italic">
                L'enregistrement manuel est une relique du passé. Notre système repose sur l'engagement mutuel : chaque membre qui s'enregistre rapproche le groupe entier de son objectif.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 border-t border-white/10 pt-10 text-left">
                <div>
                    <h4 class="text-2xl font-bold italic mb-2 tracking-tight">Zero Admin</h4>
                    <p class="text-sm text-white/40 italic">L'automatisation totale du processus de collecte.</p>
                </div>
                <div>
                    <h4 class="text-2xl font-bold italic mb-2 tracking-tight">Massive Scale</h4>
                    <p class="text-sm text-white/40 italic">Gérez 500+ numéros sans une seule erreur de saisie.</p>
                </div>
            </div>
        </div>

        <!-- Simulation visuelle -->
        <div class="relative p-6 lg:p-8 rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl order-1 lg:order-2">
            <div class="flex justify-between items-end mb-6">
                <div class="max-w-[150px] lg:max-w-none">
                    <p class="text-[9px] font-mono text-white/40 uppercase mb-1">Status du groupe</p>
                    <p class="text-lg lg:text-2xl font-bold tracking-tight italic truncate">Webinar Masterclass</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-indigo-500 italic">48 / 50</p>
                </div>
            </div>
            <div class="h-2 w-full bg-white/10 rounded-full overflow-hidden mb-10">
                <div class="h-full bg-indigo-500 w-[96%] animate-pulse"></div>
            </div>
            <div class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/5 opacity-50 italic text-[11px] lg:text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="2"/></svg>
                VCF Verrouillé — Manque 2 participants
            </div>
        </div>
    </div>
</section>

<!-- 4. BENTO GRID -->
<section id="cases" class="py-16 lg:py-32 px-4 lg:px-12 bg-[#080808]">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-center text-3xl lg:text-6xl font-bold tracking-tighter uppercase italic mb-16 lg:mb-24">Cas d'usage Pro</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-4 auto-rows-min lg:h-[700px]">
            <div class="bento-card p-8 lg:p-10 flex flex-col justify-end md:row-span-2 min-h-[300px]">
                <div class="mb-auto font-mono font-bold text-indigo-400 text-xl">01</div>
                <h4 class="text-2xl lg:text-3xl font-bold uppercase italic mb-4 tracking-tighter">Événements</h4>
                <p class="text-white/50 font-light italic leading-relaxed text-sm lg:text-base">Mariages, Galas. Donnez à vos invités le pouvoir de rester en contact dès le début.</p>
            </div>
            <div class="bento-card p-8 lg:p-10 flex flex-col justify-end md:col-span-2 min-h-[300px]">
                <div class="mb-auto flex justify-between items-center">
                    <div class="font-mono font-bold text-purple-400 text-xl">02</div>
                    <span class="font-mono text-[9px] text-white/20 uppercase tracking-widest border border-white/10 px-2 py-1 rounded">Populaire</span>
                </div>
                <h4 class="text-2xl lg:text-3xl font-bold uppercase italic mb-4 tracking-tighter">Webinaires & Formations</h4>
                <p class="text-white/50 font-light italic leading-relaxed text-sm lg:text-base">Créez une base qualifiée instantanément. Débloquez les ressources contre engagement.</p>
            </div>
            <div class="bento-card p-8 lg:p-10 flex flex-col justify-end min-h-[200px]">
                <div class="mb-auto font-mono font-bold text-emerald-400 text-xl">03</div>
                <h4 class="text-xl lg:text-2xl font-bold uppercase italic mb-4">ONG & Églises</h4>
                <p class="text-white/50 font-light italic text-xs lg:text-sm">Centralisez l'annuaire des membres de manière transparente et sécurisée.</p>
            </div>
            <div class="bento-card p-8 lg:p-10 flex flex-col justify-end min-h-[200px]">
                <div class="mb-auto font-mono font-bold text-amber-400 text-xl">04</div>
                <h4 class="text-xl lg:text-2xl font-bold uppercase italic mb-4">Associations</h4>
                <p class="text-white/50 font-light italic text-xs lg:text-sm">Le réseautage facilité au sein de vos communautés locales.</p>
            </div>
        </div>
    </div>
</section>

<!-- 5. TIMELINE -->
<section class="py-16 lg:py-40 px-6">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-center text-3xl lg:text-7xl font-bold tracking-tighter uppercase mb-20 lg:mb-32 italic">
            Processus en <span class="text-indigo-500 italic font-black">3 phases</span>
        </h2>

        <div class="space-y-20 lg:space-y-40 relative">
            <div class="absolute left-0 lg:left-1/2 top-0 bottom-0 w-[1px] bg-white/10 -translate-x-1/2 hidden lg:block"></div>

            <div class="flex flex-col lg:flex-row items-start lg:items-center gap-8 lg:gap-20 relative text-left lg:text-right">
                <div class="lg:w-1/2">
                    <span class="font-mono text-indigo-500 text-xs font-bold uppercase mb-4 block italic tracking-widest">Phase Alpha</span>
                    <h3 class="text-2xl lg:text-4xl font-bold uppercase italic mb-4 tracking-tighter">Initialisation</h3>
                    <p class="text-white/40 font-light italic text-sm lg:text-lg leading-relaxed lg:pl-20">Créez votre espace en 10 secondes. Définissez votre titre et votre quota. Générez votre lien de déploiement unique.</p>
                </div>
                <div class="absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-white hidden lg:flex items-center justify-center rounded-full text-black font-black italic z-10">1</div>
                <div class="lg:w-1/2"></div>
            </div>

            <div class="flex flex-col lg:flex-row items-start lg:items-center gap-8 lg:gap-20 relative text-left lg:text-left">
                <div class="lg:w-1/2"></div>
                <div class="absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-indigo-600 hidden lg:flex items-center justify-center rounded-full text-white font-black italic z-10">2</div>
                <div class="lg:w-1/2">
                    <span class="font-mono text-indigo-500 text-xs font-bold uppercase mb-4 block italic tracking-widest">Phase Beta</span>
                    <h3 class="text-2xl lg:text-4xl font-bold uppercase italic mb-4 tracking-tighter">Collecte Sociale</h3>
                    <p class="text-white/40 font-light italic text-sm lg:text-lg leading-relaxed lg:pr-20">Diffusez le lien. Vos participants injectent leurs données. Le système valide l'unicité de chaque numéro.</p>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row items-start lg:items-center gap-8 lg:gap-20 relative text-left lg:text-right">
                <div class="lg:w-1/2">
                    <span class="font-mono text-indigo-500 text-xs font-bold uppercase mb-4 block italic tracking-widest">Phase Finale</span>
                    <h3 class="text-2xl lg:text-4xl font-bold uppercase italic mb-4 tracking-tighter">Distribution</h3>
                    <p class="text-white/40 font-light italic text-sm lg:text-lg leading-relaxed lg:pl-20">L'objectif est atteint. Le bouton de téléchargement s'active pour tous. Exportation massive au format VCF.</p>
                </div>
                <div class="absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-emerald-500 hidden lg:flex items-center justify-center rounded-full text-black font-black italic z-10">3</div>
                <div class="lg:w-1/2"></div>
            </div>
        </div>
    </div>
</section>

<!-- 6. FAQ -->
<section id="faq" class="py-20 lg:py-40 px-6 bg-[#030303]">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-3xl lg:text-4xl font-bold uppercase tracking-tighter mb-12 lg:mb-16 italic text-center">Protocol FAQ</h2>
        <div class="space-y-4">
            <details class="group bento-card p-5 lg:p-6 rounded-2xl cursor-pointer">
                <summary class="list-none flex justify-between items-center font-bold uppercase tracking-tight italic text-sm lg:text-base">
                    Les données sont-elles protégées ?
                    <span class="text-indigo-500 transition-transform group-open:rotate-180">+</span>
                </summary>
                <p class="mt-4 text-white/40 font-light italic text-xs lg:text-sm leading-relaxed">Oui. Nous ne revendons aucune donnée. Les contacts sont stockés uniquement pour générer votre fichier final et sont chiffrés sur nos serveurs.</p>
            </details>
            <details class="group bento-card p-5 lg:p-6 rounded-2xl cursor-pointer">
                <summary class="list-none flex justify-between items-center font-bold uppercase tracking-tight italic text-sm lg:text-base">
                    Quel est le format d'export ?
                    <span class="text-indigo-500 transition-transform group-open:rotate-180">+</span>
                </summary>
                <p class="mt-4 text-white/40 font-light italic text-xs lg:text-sm">Nous utilisons le format standard .VCF (vCard), reconnu nativement par 100% des smartphones sans aucune application tierce.</p>
            </details>
        </div>
    </div>
</section>

<!-- 7. FINAL CTA -->
<section class="py-32 lg:py-60 px-6 text-center relative overflow-hidden">
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[150vw] h-[50vh] bg-indigo-600/10 blur-[100px] lg:blur-[150px] rounded-full"></div>
    <div class="relative z-10">
        <h2 class="text-6xl lg:text-[10vw] font-bold tracking-tighter uppercase italic leading-[0.8] mb-16 transition-all">Scale your<br><span class="text-outline italic">Community.</span></h2>
        <a href="{{ route('register') }}" class="inline-block px-10 py-5 lg:px-16 lg:py-8 bg-indigo-600 text-white rounded font-black uppercase text-[10px] lg:text-[12px] tracking-[0.4em] hover:bg-white hover:text-black transition-all shadow-2xl shadow-indigo-500/40">
            Lancer un Lien Public
        </a>
    </div>
</section>

<!-- FOOTER -->
<footer class="p-8 lg:p-12 border-t border-white/5 bg-[#030303]">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-left opacity-40">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-bold tracking-tighter uppercase italic">VCF SYSTEM — Private Data Engine</p>
            <p class="text-[9px] font-mono text-white/20 uppercase tracking-widest italic">© {{ date('Y') }} Engineered for precision</p>
        </div>
        <div class="flex gap-6 lg:gap-10 text-[9px] font-mono uppercase tracking-[0.2em] text-white/40">
            <a href="#" class="hover:text-indigo-500 transition-colors">Privacy</a>
            <a href="#" class="hover:text-indigo-500 transition-colors">Terms</a>
            <a href="mailto:hello@vcfsys.pro" class="hover:text-indigo-500 transition-colors">Contact</a>
        </div>
    </div>
</footer>

</body>
</html>
