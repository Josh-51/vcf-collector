<nav x-data="{ mobileMenu: false, userMenu: false }"
     class="fixed top-0 w-full z-[100] px-4 sm:px-6 lg:px-12 py-4 lg:py-6 flex justify-between items-center bg-black/60 backdrop-blur-xl border-b border-white/5 transition-all duration-500">

    <!-- GAUCHE : LOGO & MOBILE TOGGLE -->
    <div class="flex items-center gap-3 lg:gap-4">
        <!-- Bouton Hamburger (Visible uniquement sur mobile) -->
        <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-white/60 hover:text-white transition-colors focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!mobileMenu" d="M4 6h16M4 12h16M4 18h7" stroke-width="2" stroke-linecap="round"/>
                <path x-show="mobileMenu" x-cloak d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>

        <a href="/" class="group flex items-center gap-2 sm:gap-3">
            <div class="w-8 h-8 sm:w-10 sm:h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black italic shadow-[0_0_20px_rgba(99,102,241,0.3)] transition-transform group-hover:rotate-12">V</div>
            <span class="text-lg sm:text-xl font-bold tracking-tighter uppercase italic whitespace-nowrap">VCF — <span class="text-white/40">BOOST</span></span>
        </a>
    </div>

    <!-- CENTRE : LIENS DESKTOP (Masqués sur mobile) -->
    <div class="hidden lg:flex items-center gap-10">
        <div class="flex gap-8 text-[10px] uppercase tracking-[0.3em] font-bold italic opacity-40">
            <a href="/#logic" class="hover:opacity-100 hover:text-indigo-400 transition-all underline-offset-8 hover:underline">Comment ça marche</a>
            <a href="/#cases" class="hover:opacity-100 hover:text-indigo-400 transition-all underline-offset-8 hover:underline">Pour qui ?</a>
            <a href="/#faq" class="hover:opacity-100 hover:text-indigo-400 transition-all underline-offset-8 hover:underline">Aide</a>
        </div>
    </div>

    <!-- DROITE : AUTH & ACTIONS -->
    <div class="flex items-center gap-3 sm:gap-6">
        @auth
            <div class="relative">
                <button @click="userMenu = !userMenu" class="flex items-center gap-2 sm:gap-4 group focus:outline-none">
                    <!-- Nom masqué sur mobile (< 640px) -->
                    <span class="hidden sm:block text-[10px] uppercase tracking-widest font-bold opacity-40">{{ Auth::user()->name }}</span>
                    <div class="w-9 h-9 sm:w-10 sm:h-10 border border-white/10 rounded-full flex items-center justify-center bg-white/5 group-hover:bg-white group-hover:text-black transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2"/></svg>
                    </div>
                </button>

                <!-- Dropdown Utilisateur -->
                <div x-show="userMenu"
                     @click.away="userMenu = false"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     class="absolute top-14 right-0 w-56 sm:w-64 bg-[#0a0a0a] border border-white/10 p-2 rounded-2xl shadow-2xl z-[110]">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 p-3 text-xs uppercase font-bold italic hover:bg-white/5 rounded-xl transition-all">
                        <svg class="w-4 h-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" stroke-width="2"/></svg>
                        Mon Espace Pro
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 text-xs uppercase font-bold italic hover:bg-white/5 rounded-xl transition-all opacity-60">
                        <svg class="w-4 h-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" stroke-width="2"/><circle cx="12" cy="12" r="3" stroke-width="2"/></svg>
                        Paramètres
                    </a>
                    <div class="h-[1px] bg-white/5 my-2 mx-3"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full flex items-center gap-3 text-left p-3 text-xs uppercase font-bold text-red-500 italic hover:bg-red-500/5 rounded-xl transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2"/></svg>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('register') }}" class="text-[9px] sm:text-[10px] bg-white text-black px-4 sm:px-8 py-2.5 sm:py-3 rounded-full font-black uppercase tracking-widest hover:scale-105 active:scale-95 transition-all shadow-lg shadow-white/5">
                Essayer <span class="hidden xs:inline">Gratuitement</span>
            </a>
        @endauth
    </div>

    <!-- OVERLAY MENU MOBILE (Cliqué via Hamburger) -->
    <div x-show="mobileMenu"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-x-full"
         x-transition:enter-end="opacity-100 translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-x-0"
         x-transition:leave-end="opacity-0 -translate-x-full"
         class="fixed inset-0 top-[73px] lg:hidden bg-black/95 backdrop-blur-2xl z-[90] p-8">

        <div class="flex flex-col gap-8">
            <span class="text-[10px] uppercase tracking-[0.5em] text-white/20 font-bold italic border-b border-white/5 pb-4">Menu Navigation</span>
            <a @click="mobileMenu = false" href="/#logic" class="text-3xl font-black tracking-tighter uppercase italic hover:text-indigo-500 transition-colors">01. Logique</a>
            <a @click="mobileMenu = false" href="/#cases" class="text-3xl font-black tracking-tighter uppercase italic hover:text-indigo-500 transition-colors">02. Usages</a>
            <a @click="mobileMenu = false" href="/#faq" class="text-3xl font-black tracking-tighter uppercase italic hover:text-indigo-500 transition-colors">03. Aide</a>

            <div class="mt-12 flex flex-col gap-4">
                <p class="text-[10px] uppercase tracking-widest text-white/20 italic italic leading-loose">
                    VCF BOOST — Transformez votre audience en carnet d'adresses exploitable.
                </p>
            </div>
        </div>
    </div>
</nav>
