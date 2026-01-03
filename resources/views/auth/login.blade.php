<x-guest-layout>
    <!-- Conteneur principal avec espacement adapté (8 sur mobile, 12 sur desktop) -->
    <div class="space-y-8 lg:space-y-12 text-center lg:text-left w-full">

        <header>
            <!-- Titre fluide : 4xl sur mobile, 5xl sur tablette, 6xl sur desktop -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tighter uppercase italic leading-[1.1] sm:leading-none mb-4">
                Content de vous revoir.
            </h1>
            <p class="text-white/40 text-sm sm:text-base italic">
                Accédez à votre gestionnaire de contacts intelligent.
            </p>
        </header>

        <!-- Formulaire avec espacement réduit sur mobile -->
        <form method="POST" action="{{ route('login') }}" class="space-y-8 lg:space-y-10">
            @csrf

            <!-- Champ Email -->
            <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Votre Email</label>
                <input type="email" name="email" :value="old('email')" required autofocus
                       class="w-full bg-transparent border-none p-0 text-xl lg:text-2xl font-light focus:ring-0 placeholder:text-white/5 uppercase tracking-tighter italic outline-none">
            </div>

            <!-- Champ Mot de passe -->
            <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                <div class="flex justify-between items-center mb-2">
                    <label class="text-[10px] uppercase text-white/30 block tracking-widest font-bold">Votre Mot de passe</label>
                    <a href="{{ route('password.request') }}" class="text-[9px] uppercase opacity-40 hover:opacity-100 italic transition-opacity">Oublié ?</a>
                </div>
                <input type="password" name="password" required
                       class="w-full bg-transparent border-none p-0 text-xl lg:text-2xl font-light focus:ring-0 uppercase tracking-tighter italic outline-none">
            </div>

            <!-- Actions -->
            <div class="pt-4 lg:pt-8">
                <button type="submit" class="w-full bg-white text-black py-5 lg:py-6 rounded-2xl font-black uppercase text-[11px] lg:text-xs tracking-[0.3em] hover:bg-indigo-600 hover:text-white transition-all duration-500 shadow-2xl active:scale-[0.98]">
                    Se Connecter à l'Espace
                </button>

                <div class="mt-8">
                    <a href="{{ route('register') }}" class="inline-block text-[10px] sm:text-[11px] uppercase tracking-widest opacity-30 hover:opacity-100 transition-all italic underline decoration-white/10 underline-offset-4 leading-relaxed">
                        Nouveau ici ? Créer un compte gratuitement
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
