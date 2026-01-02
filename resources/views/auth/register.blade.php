<x-guest-layout>
    <header class="mb-12">
        <h1 class="text-5xl font-bold tracking-tighter uppercase italic mb-2">Join</h1>
        <p class="text-white/40 text-xs uppercase tracking-widest">Initialisation d'un nouveau profil</p>
    </header>

    <form method="POST" action="{{ route('register') }}" class="space-y-8">
        @csrf
        <!-- Name -->
        <div>
            <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-[0.2em]">Nom complet</label>
            <input type="text" name="name" :value="old('name')" required autofocus
                   class="w-full bg-transparent border-b border-white/10 py-3 text-xl font-light focus:border-white transition-all outline-none">
        </div>

        <!-- Email -->
        <div>
            <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-[0.2em]">Email</label>
            <input type="email" name="email" :value="old('email')" required
                   class="w-full bg-transparent border-b border-white/10 py-3 text-xl font-light focus:border-white transition-all outline-none">
        </div>

        <!-- Password -->
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-[0.2em]">Clé d'accès</label>
                <input type="password" name="password" required
                       class="w-full bg-transparent border-b border-white/10 py-3 text-xl font-light focus:border-white transition-all outline-none">
            </div>
            <div>
                <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-[0.2em]">Confirmation</label>
                <input type="password" name="password_confirmation" required
                       class="w-full bg-transparent border-b border-white/10 py-3 text-xl font-light focus:border-white transition-all outline-none">
            </div>
        </div>

        <div class="pt-10 flex flex-col gap-4">
            <button class="w-full bg-white text-black py-5 rounded-full font-bold text-xs uppercase tracking-widest hover:invert transition-all">
                Créer mon compte
            </button>
            <a href="{{ route('login') }}" class="text-center text-[10px] uppercase tracking-widest text-white/30 hover:text-white transition-colors italic">
                Déjà inscrit ? Connexion
            </a>
        </div>
    </form>
</x-guest-layout>
