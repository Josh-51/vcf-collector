<nav x-data="{ open: false }" class="py-8 px-6 lg:px-12 flex justify-between items-center border-b border-white/5">
    <!-- Logo Minimaliste -->
    <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-tighter hover:opacity-70 transition-opacity uppercase italic">
        VCF — <span class="font-light">System</span>
    </a>

    <div class="flex items-center gap-8">
        <!-- Bouton de contrôle (C'est ici qu'on clique) -->
        <button @click="open = !open" class="group flex items-center gap-4 focus:outline-none">
            <div class="text-right hidden sm:block">
                <p class="text-[10px] uppercase tracking-widest text-white/40 mb-1">Authentifié en tant que</p>
                <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
            </div>
            <div class="w-12 h-12 border border-white/10 rounded-full flex items-center justify-center group-hover:bg-white group-hover:text-vblack transition-all duration-500">
                <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                <svg x-show="open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
        </button>
    </div>

    <!-- Le Menu Overlay (Apparaît au clic) -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-cloak
         class="absolute top-24 right-6 lg:right-12 w-72 bg-vgrey border border-white/10 p-6 rounded-2xl z-[100] shadow-2xl shadow-black/50">

        <div class="space-y-6">
            <div class="pb-4 border-b border-white/5 uppercase text-[10px] tracking-widest text-white/30 font-bold italic">Options de compte</div>

            <a href="{{ route('profile.edit') }}" class="block text-lg font-light hover:pl-2 transition-all duration-300">
                Paramètres <span class="text-white/20">— 01</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left text-lg font-light text-red-400/80 hover:pl-2 transition-all duration-300">
                    Déconnexion <span class="text-red-400/20">— 02</span>
                </button>
            </form>
        </div>
    </div>
</nav>
