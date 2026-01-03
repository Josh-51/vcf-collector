<x-guest-layout>
    <div class="space-y-12">
        <!-- HEADER : Protocole de récupération -->
        <header>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-white/10 bg-white/5 mb-6">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                <span class="text-[9px] font-mono uppercase tracking-[0.2em] text-white/40 font-bold italic tracking-widest">Recovery Protocol Initiated</span>
            </div>
            <h1 class="text-6xl font-black tracking-tighter uppercase italic leading-none mb-2 text-glow">Forgot Access</h1>
            <p class="font-mono text-[10px] uppercase tracking-widest text-white/20 italic max-w-sm leading-relaxed">
                Entrez votre identifiant pour recevoir un lien de restauration de clé d'accès.
            </p>
        </header>

        <!-- SESSION STATUS : Message de succès -->
        @if (session('status'))
            <div class="p-6 border border-emerald-500/20 bg-emerald-500/5 rounded-2xl flex items-center gap-4 animate-pulse">
                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                <p class="font-mono text-[10px] uppercase tracking-widest text-emerald-500 font-bold">
                    {{ session('status') }}
                </p>
            </div>
        @endif

        <!-- FORMULAIRE -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-12">
            @csrf

            <!-- Email Address -->
            <div class="group relative border-b border-white/5 pb-2 focus-within:border-white transition-all duration-500">
                <label class="font-mono text-[9px] uppercase text-white/20 block mb-2 tracking-[0.3em] font-bold">Identification / Point d'accès</label>
                <input type="email" id="email" name="email" :value="old('email')" required autofocus
                       class="w-full bg-transparent border-none p-0 text-2xl font-light focus:ring-0 placeholder:text-white/5 uppercase tracking-tighter italic">

                @error('email')
                <p class="font-mono text-red-500 text-[9px] uppercase mt-4 italic tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex flex-col gap-6">
                <button type="submit" class="w-full bg-white text-black py-6 rounded-2xl font-black text-xs uppercase tracking-[0.5em] hover:bg-indigo-600 hover:text-white transition-all duration-700 shadow-2xl active:scale-[0.98]">
                    Envoyer clé de restauration
                </button>

                <a href="{{ route('login') }}" class="text-center group">
                    <span class="font-mono text-[9px] uppercase tracking-widest text-white/20 group-hover:text-white transition-all italic underline decoration-white/10 underline-offset-8">
                        Retour au terminal de connexion
                    </span>
                </a>
            </div>
        </form>

        <!-- FOOTER TECHNIQUE -->
        <div class="pt-10 flex justify-center items-center gap-4 opacity-10 italic">
            <span class="w-12 h-[1px] bg-white"></span>
            <span class="font-mono text-[8px] uppercase tracking-[0.5em]">Auth_Sys_v1.0</span>
            <span class="w-12 h-[1px] bg-white"></span>
        </div>
    </div>
</x-guest-layout>
