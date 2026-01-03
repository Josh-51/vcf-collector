<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VCF SYSTEM — Intelligence Collective & Networking</title>

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
                    }
                }
            }
        }
    </script>

    <style>
        :root { --accent: #6366f1; }
        body { background-color: #050505; color: #fafafa; }

        .grain::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .03; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }

        .hero-glow {
            background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.15) 0%, transparent 50%);
        }

        .text-outline { -webkit-text-stroke: 1px rgba(255,255,255,0.2); color: transparent; }

        .bento-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .bento-card:hover {
            border-color: rgba(99, 102, 241, 0.5);
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-5px);
        }

        .nav-blur {
            backdrop-filter: blur(20px);
            background: rgba(5, 5, 5, 0.8);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #050505; }
        ::-webkit-scrollbar-thumb { background: #222; border-radius: 10px; }
    </style>
</head>

<body class="antialiased grain overflow-x-hidden font-sans">

<!-- NAVIGATION -->
<nav class="fixed top-0 w-full z-[100] px-6 lg:px-12 py-6 flex justify-between items-center nav-blur border-b border-white/5">
    <a href="/" class="flex items-center gap-2 group">
        <div class="w-8 h-8 bg-indigo-600 rounded flex items-center justify-center font-bold text-white transition-transform group-hover:rotate-12">V</div>
        <span class="text-xl font-bold tracking-tighter uppercase italic">VCF <span class="text-indigo-500">SYS</span></span>
    </a>
    <div class="hidden md:flex items-center gap-10">
        <a href="#logic" class="text-xs font-mono uppercase tracking-widest opacity-40 hover:opacity-100 transition-all">01. Logique</a>
        <a href="#cases" class="text-xs font-mono uppercase tracking-widest opacity-40 hover:opacity-100 transition-all">02. Usages</a>
        <a href="#faq" class="text-xs font-mono uppercase tracking-widest opacity-40 hover:opacity-100 transition-all">03. Support</a>
    </div>
    <div class="flex items-center gap-6">
        @auth
            <a href="{{ route('dashboard') }}" class="text-[10px] font-mono uppercase tracking-widest bg-white text-black px-6 py-2.5 rounded hover:bg-indigo-500 hover:text-white transition-all">Tableau de bord</a>
        @else
            <a href="{{ route('login') }}" class="hidden sm:block text-[10px] font-mono uppercase tracking-widest opacity-60 hover:opacity-100 italic transition-all">Se connecter</a>
            <a href="{{ route('register') }}" class="text-[10px] font-mono uppercase tracking-widest bg-white text-black px-6 py-2.5 rounded font-bold hover:bg-indigo-600 hover:text-white transition-all">S'inscrire</a>
        @endauth
    </div>
</nav>

<!-- 1. HERO SECTION -->
<section class="relative min-h-screen flex flex-col items-center justify-center pt-20 px-6 hero-glow">
    <!-- Glow décoratif -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-500/10 blur-[120px] rounded-full animate-pulse-slow"></div>

    <div class="max-w-7xl w-full text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-indigo-500/30 bg-indigo-500/5 mb-8">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
            </span>
            <span class="text-[10px] font-mono uppercase tracking-[0.2em] text-indigo-400">v2.0 Private Terminal Active</span>
        </div>

        <h1 class="text-[12vw] lg:text-[9vw] font-bold tracking-tighter uppercase leading-[0.85] italic mb-12">
            Collect. <span class="text-outline italic">Unlock.</span><br>
            Collaborate.
        </h1>

        <div class="flex flex-col items-center max-w-2xl mx-auto">
            <p class="text-lg lg:text-xl font-light text-white/50 mb-12 leading-relaxed">
                Le premier protocole de croissance virale pour WhatsApp. <br class="hidden lg:block">
                Centralisez vos contacts, automatisez le déblocage, libérez l'accès.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 w-full justify-center">
                <a href="{{ route('register') }}" class="px-10 py-5 bg-white text-black rounded font-black uppercase text-[11px] tracking-[0.3em] hover:bg-indigo-600 hover:text-white transition-all duration-500 flex items-center justify-center gap-3 shadow-2xl shadow-indigo-500/20">
                    Lancer un lien public
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 2. LA LOGIQUE (Split & Visual) -->
<section id="logic" class="py-32 px-6">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-24 items-center">
        <div class="relative">
            <div class="absolute -top-20 -left-20 w-64 h-64 bg-indigo-500/10 blur-3xl rounded-full"></div>
            <span class="font-mono text-[10px] uppercase tracking-[0.4em] text-indigo-500 mb-6 block font-bold italic">The Collaborative Logic</span>
            <h2 class="text-5xl lg:text-7xl font-bold tracking-tighter uppercase leading-[0.95] mb-8 italic">
                Pourquoi travailler seul ?
            </h2>
            <p class="text-xl text-white/50 font-light leading-relaxed mb-10">
                L'enregistrement manuel est une relique du passé. Notre système repose sur l'engagement mutuel : chaque membre qui s'enregistre rapproche le groupe entier de son objectif.
            </p>
            <div class="grid grid-cols-2 gap-8 border-t border-white/10 pt-10">
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

        <!-- Simulation visuelle du déblocage -->
        <div class="relative p-8 rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl">
            <div class="flex justify-between items-end mb-6">
                <div>
                    <p class="text-[10px] font-mono text-white/40 uppercase mb-1">Status du groupe</p>
                    <p class="text-2xl font-bold tracking-tight italic">Webinar Masterclass</p>
                </div>
                <div class="text-right">
                    <p class="text-xs font-bold text-indigo-500 italic">48 / 50 contacts</p>
                </div>
            </div>
            <div class="h-2 w-full bg-white/10 rounded-full overflow-hidden mb-10">
                <div class="h-full bg-indigo-500 w-[96%] animate-pulse"></div>
            </div>
            <div class="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/5 opacity-50 italic text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                VCF Verrouillé — Manque 2 participants
            </div>
        </div>
    </div>
</section>

<!-- 3. BENTO GRID USAGES -->
<section id="cases" class="py-32 px-6 lg:px-12 bg-[#080808]">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-24">
            <h2 class="text-4xl lg:text-6xl font-bold tracking-tighter uppercase italic">Cas d'usage Pro</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-4 h-full lg:h-[700px]">
            <!-- Card 1 -->
            <div class="bento-card p-10 flex flex-col justify-end md:row-span-2">
                <div class="mb-auto">
                    <div class="w-12 h-12 rounded bg-indigo-500/20 flex items-center justify-center text-indigo-400 mb-6 font-mono font-bold">01</div>
                </div>
                <h4 class="text-3xl font-bold uppercase italic mb-4">Événements</h4>
                <p class="text-white/50 font-light italic leading-relaxed">Mariages, Anniversaires, Galas. Donnez à vos invités le pouvoir de rester en contact dès que la fête commence.</p>
            </div>
            <!-- Card 2 -->
            <div class="bento-card p-10 flex flex-col justify-end md:col-span-2">
                <div class="mb-auto flex justify-between">
                    <div class="w-12 h-12 rounded bg-purple-500/20 flex items-center justify-center text-purple-400 font-mono font-bold">02</div>
                    <span class="font-mono text-[10px] text-white/20 uppercase">Most Popular</span>
                </div>
                <h4 class="text-3xl font-bold uppercase italic mb-4">Webinaires & Formations</h4>
                <p class="text-white/50 font-light italic leading-relaxed">Créez une base de données qualifiée instantanément. Débloquez les ressources contre engagement.</p>
            </div>
            <!-- Card 3 -->
            <div class="bento-card p-10 flex flex-col justify-end">
                <div class="mb-auto">
                    <div class="w-12 h-12 rounded bg-emerald-500/20 flex items-center justify-center text-emerald-400 font-mono font-bold">03</div>
                </div>
                <h4 class="text-2xl font-bold uppercase italic mb-4">ONG & Églises</h4>
                <p class="text-white/50 font-light italic text-sm">Centralisez l'annuaire des membres de manière transparente et sécurisée.</p>
            </div>
            <!-- Card 4 -->
            <div class="bento-card p-10 flex flex-col justify-end">
                <div class="mb-auto">
                    <div class="w-12 h-12 rounded bg-amber-500/20 flex items-center justify-center text-amber-400 font-mono font-bold">04</div>
                </div>
                <h4 class="text-2xl font-bold uppercase italic mb-4">Associations</h4>
                <p class="text-white/50 font-light italic text-sm">Le réseautage facilité au sein de vos communautés locales.</p>
            </div>
        </div>
    </div>
</section>

<!-- 4. TIMELINE PARCOURS -->
<section class="py-40 px-6">
    <div class="max-w-5xl mx-auto">
        <h2 class="text-center text-4xl lg:text-7xl font-bold tracking-tighter uppercase mb-32 italic">
            Processus en <span class="text-indigo-500 italic font-black">3 étapes</span>
        </h2>

        <div class="space-y-40 relative">
            <!-- Ligne centrale -->
            <div class="absolute left-0 lg:left-1/2 top-0 bottom-0 w-[1px] bg-white/10 -translate-x-1/2 hidden lg:block"></div>

            <!-- Step 1 -->
            <div class="flex flex-col lg:flex-row items-center gap-20 relative">
                <div class="lg:w-1/2 lg:text-right">
                    <span class="font-mono text-indigo-500 text-sm font-bold uppercase mb-4 block italic tracking-widest">Phase Alpha</span>
                    <h3 class="text-4xl font-bold uppercase italic mb-6">Initialisation</h3>
                    <p class="text-white/40 font-light italic text-lg leading-relaxed lg:pl-20">Créez votre espace en 10 secondes. Définissez votre titre et votre quota. Générez votre lien de déploiement unique.</p>
                </div>
                <div class="absolute left-0 lg:left-1/2 -translate-x-1/2 w-12 h-12 bg-white flex items-center justify-center rounded-full text-black font-black italic z-10 shadow-[0_0_30px_rgba(255,255,255,0.4)]">1</div>
                <div class="lg:w-1/2 hidden lg:block"></div>
            </div>

            <!-- Step 2 -->
            <div class="flex flex-col lg:flex-row items-center gap-20 relative">
                <div class="lg:w-1/2 hidden lg:block"></div>
                <div class="absolute left-0 lg:left-1/2 -translate-x-1/2 w-12 h-12 bg-indigo-600 flex items-center justify-center rounded-full text-white font-black italic z-10">2</div>
                <div class="lg:w-1/2">
                    <span class="font-mono text-indigo-500 text-sm font-bold uppercase mb-4 block italic tracking-widest">Phase Beta</span>
                    <h3 class="text-4xl font-bold uppercase italic mb-6">Collecte Sociale</h3>
                    <p class="text-white/40 font-light italic text-lg leading-relaxed lg:pr-20">Diffusez le lien. Vos participants injectent leurs données. Notre système valide l'unicité et la structure de chaque numéro.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="flex flex-col lg:flex-row items-center gap-20 relative">
                <div class="lg:w-1/2 lg:text-right">
                    <span class="font-mono text-indigo-500 text-sm font-bold uppercase mb-4 block italic tracking-widest">Phase Finale</span>
                    <h3 class="text-4xl font-bold uppercase italic mb-6">Distribution</h3>
                    <p class="text-white/40 font-light italic text-lg leading-relaxed lg:pl-20">L'objectif est atteint. Le bouton de téléchargement s'active pour tous. Exportation massive au format VCF compatible iOS/Android.</p>
                </div>
                <div class="absolute left-0 lg:left-1/2 -translate-x-1/2 w-12 h-12 bg-emerald-500 flex items-center justify-center rounded-full text-black font-black italic z-10">3</div>
                <div class="lg:w-1/2 hidden lg:block"></div>
            </div>
        </div>
    </div>
</section>

<!-- 5. FAQ -->
<section id="faq" class="py-40 px-6 bg-[#030303]">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-4xl font-bold uppercase tracking-tighter mb-16 italic text-center">Protocol FAQ</h2>
        <div class="space-y-4">
            <details class="group bento-card p-6 rounded-2xl cursor-pointer">
                <summary class="list-none flex justify-between items-center font-bold uppercase tracking-tight italic">
                    Les données sont-elles protégées ?
                    <span class="text-indigo-500 transition-transform group-open:rotate-180">+</span>
                </summary>
                <p class="mt-4 text-white/40 font-light italic text-sm">Oui. Nous ne revendons aucune donnée. Les contacts sont stockés uniquement pour générer votre fichier final et sont chiffrés sur nos serveurs.</p>
            </details>
            <details class="group bento-card p-6 rounded-2xl cursor-pointer">
                <summary class="list-none flex justify-between items-center font-bold uppercase tracking-tight italic">
                    Quel est le format d'export ?
                    <span class="text-indigo-500 transition-transform group-open:rotate-180">+</span>
                </summary>
                <p class="mt-4 text-white/40 font-light italic text-sm">Nous utilisons le format standard .VCF (vCard), reconnu nativement par tous les téléphones sans aucune application tierce.</p>
            </details>
        </div>
    </div>
</section>

<!-- 6. FINAL CTA -->
<section class="py-60 px-6 text-center relative overflow-hidden">
    <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[100vw] h-[50vh] bg-indigo-600/10 blur-[150px] rounded-full"></div>

    <div class="relative z-10">
        <h2 class="text-[10vw] font-bold tracking-tighter uppercase italic leading-[0.8] mb-16">
            Scale your<br><span class="text-outline">Community.</span>
        </h2>
        <div class="flex flex-col items-center">
            <a href="{{ route('register') }}" class="px-16 py-8 bg-indigo-600 text-white rounded font-black uppercase text-[12px] tracking-[0.5em] hover:bg-white hover:text-black transition-all duration-700 shadow-2xl shadow-indigo-500/40">
                Ouvrir un terminal gratuit
            </a>
            <p class="mt-10 font-mono text-[9px] uppercase tracking-widest text-white/20">No credit card required • Instant initialization</p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="p-12 border-t border-white/5 bg-[#030303]">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-10">
        <div class="flex flex-col gap-2">
            <p class="text-sm font-bold tracking-tighter uppercase italic">VCF SYSTEM — Private Data Engine</p>
            <p class="text-[10px] font-mono text-white/20 uppercase tracking-widest italic">© {{ date('Y') }} Engineered for precision</p>
        </div>
        <div class="flex gap-10 text-[10px] font-mono uppercase tracking-[0.3em] text-white/40">
            <a href="#" class="hover:text-indigo-500 transition-colors">Privacy</a>
            <a href="#" class="hover:text-indigo-500 transition-colors">Terms</a>
            <a href="mailto:hello@vcfsys.pro" class="hover:text-indigo-500 transition-colors">Contact</a>
        </div>
    </div>
</footer>

</body>
</html>
