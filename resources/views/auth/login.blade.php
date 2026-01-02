<x-guest-layout>
    <header class="mb-12">
        <h1 class="text-5xl font-bold tracking-tighter uppercase italic mb-2">Access</h1>
        <p class="text-white/40 text-xs uppercase tracking-widest">Entrez vos identifiants de console</p>
    </header>

    <form method="POST" action="{{ route('login') }}" class="space-y-10">
        @csrf
        <!-- Email -->
        <div class="relative group">
            <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-[0.2em]">Identification / Email</label>
            <input type="email" name="email" :value="old('email')" required autofocus
                   class="w-full bg-transparent border-b border-white/10 py-3 text-xl font-light focus:border-white transition-all outline-none">
            @error('email') <p class="text-red-500 text-[10px] uppercase mt-2 italic">{{ $message }}</p> @enderror
        </div>

        <!-- Password -->
        <div class="relative group">
            <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-[0.2em]">Clé d'accès / Password</label>
            <input type="password" name="password" required
                   class="w-full bg-transparent border-b border-white/10 py-3 text-xl font-light focus:border-white transition-all outline-none">
        </div>

        <div class="flex items-center justify-between pt-4">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="rounded-none bg-transparent border-white/20 text-white focus:ring-0">
                <span class="text-[10px] uppercase tracking-widest text-white/40 italic">Mémoriser</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-[10px] uppercase tracking-widest text-white/40 hover:text-white transition-colors underline decoration-white/20">
                    Oublié ?
                </a>
            @endif
        </div>

        <div class="pt-8 flex flex-col gap-4">
            <button class="w-full bg-white text-black py-5 rounded-full font-bold text-xs uppercase tracking-widest hover:invert transition-all">
                Se Connecter
            </button>
            <a href="{{ route('register') }}" class="text-center text-[10px] uppercase tracking-widest text-white/30 hover:text-white transition-colors italic">
                Créer un compte terminal
            </a>
        </div>
    </form>
</x-guest-layout>
