<x-guest-layout>
    <div class="space-y-12">
        <!-- HEADER : Zone de haute sécurité -->
        <header>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-white/10 bg-white/5 mb-6">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                <span class="text-[9px] font-mono uppercase tracking-[0.2em] text-white/40 font-bold italic tracking-widest">Restricted Area // Level 01</span>
            </div>
            <h1 class="text-6xl font-black tracking-tighter uppercase italic leading-none mb-2">Confirm</h1>
            <p class="font-mono text-[10px] uppercase tracking-widest text-white/20 italic max-w-sm leading-relaxed">
                Cette zone du système est restreinte. Veuillez valider votre identité avant de continuer.
            </p>
        </header>

        <!-- FORMULAIRE -->
        <form method="POST" action="{{ route('confirm-password') }}" class="space-y-12">
            @csrf

            <!-- Password -->
            <div class="group relative border-b border-white/5 pb-2 focus-within:border-white transition-all duration-500">
                <div class="flex justify-between items-center mb-2">
                    <label class="font-mono text-[9px] uppercase text-white/20 block tracking-[0.3em] font-bold">Clé d'accès / Password</label>
                    <svg class="w-4 h-4 text-white/10 group-focus-within:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>

                <input type="password"
                       name="password"
                       required
                       autocomplete="current-password"
                       class="w-full bg-transparent border-none p-0 text-2xl font-light focus:ring-0 placeholder:text-white/5 uppercase tracking-tighter italic">

                @error('password')
                <p class="font-mono text-red-500 text-[9px] uppercase mt-4 italic tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex flex-col gap-6">
                <button type="submit" class="w-full bg-white text-black py-6 rounded-2xl font-black text-xs uppercase tracking-[0.5em] hover:bg-indigo-600 hover:text-white transition-all duration-700 shadow-2xl active:scale-[0.98]">
                    Vérifier Identité
                </button>

                <div class="flex justify-center items-center gap-4 opacity-10 italic">
                    <span class="w-12 h-[1px] bg-white"></span>
                    <span class="font-mono text-[8px] uppercase tracking-[0.5em]">Auth_Gate_v1.0</span>
                    <span class="w-12 h-[1px] bg-white"></span>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
