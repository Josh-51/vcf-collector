<nav x-data="{ open: false }" class="fixed top-0 w-full z-[100] px-6 lg:px-12 py-6 flex justify-between items-center bg-black/40 backdrop-blur-xl border-b border-white/5 transition-all duration-500">
    <div class="flex items-center gap-4">
        <a href="/" class="group flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black italic shadow-[0_0_20px_rgba(99,102,241,0.3)]">V</div>
            <span class="text-xl font-bold tracking-tighter uppercase italic">VCF — <span class="text-white/40">BOOST</span></span>
        </a>
    </div>

    <div class="hidden lg:flex items-center gap-12">
        <div class="flex gap-10 text-[10px] uppercase tracking-[0.3em] font-bold italic opacity-40">
            <a href="/#logic" class="hover:opacity-100 hover:text-indigo-400 transition-all">Comment ça marche</a>
            <a href="/#cases" class="hover:opacity-100 hover:text-indigo-400 transition-all">Pour qui ?</a>
            <a href="/#faq" class="hover:opacity-100 hover:text-indigo-400 transition-all">Aide</a>
        </div>
    </div>

    <div class="flex items-center gap-6">
        @auth
            <button @click="open = !open" class="flex items-center gap-4 group focus:outline-none">
                <span class="text-[10px] uppercase tracking-widest font-bold opacity-40">{{ Auth::user()->name }}</span>
                <div class="w-10 h-10 border border-white/10 rounded-full flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16" stroke-width="2"/></svg>
                </div>
            </button>
            <!-- Dropdown simple -->
            <div x-show="open" @click.away="open = false" x-cloak class="absolute top-24 right-6 lg:right-12 w-64 bg-[#0a0a0a] border border-white/10 p-4 rounded-2xl shadow-2xl">
                <a href="{{ route('dashboard') }}" class="block p-3 text-sm uppercase font-bold italic hover:bg-white/5 rounded-xl transition-all">Mon Espace</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left p-3 text-xs uppercase font-bold text-red-500 italic">Se déconnecter</button>
                </form>
            </div>
        @else
            <a href="{{ route('register') }}" class="text-[10px] bg-white text-black px-8 py-3 rounded-full font-black uppercase tracking-widest hover:scale-105 transition-all">Essayer Gratuitement</a>
        @endauth
    </div>
</nav>
