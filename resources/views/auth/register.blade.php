<x-guest-layout>
    <!-- Conteneur principal avec marges fluides -->
    <div class="space-y-8 lg:space-y-12 text-center lg:text-left w-full">

        <header>
            <!-- Taille de texte adaptative : 4xl -> 5xl -> 6xl -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tighter uppercase italic leading-[1.1] sm:leading-none mb-4 transition-all">
                Rejoignez l'élite.
            </h1>
            <p class="text-white/40 text-sm sm:text-base italic leading-relaxed">
                Générez vos premiers fichiers VCF en moins de 2 minutes.
            </p>
        </header>

        <!-- Formulaire avec espacement optimisé -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6 lg:space-y-8">
            @csrf

            <!-- Nom complet -->
            <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Votre Nom complet</label>
                <input type="text" name="name" :value="old('name')" required autofocus
                       class="w-full bg-transparent border-none p-0 text-xl lg:text-2xl font-light focus:ring-0 uppercase tracking-tighter italic outline-none">
            </div>

            <!-- Email -->
            <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Adresse Email Professionnelle</label>
                <input type="email" name="email" :value="old('email')" required
                       class="w-full bg-transparent border-none p-0 text-xl lg:text-2xl font-light focus:ring-0 uppercase tracking-tighter italic outline-none">
            </div>

            <!-- Grille de Mots de passe : 1 col sur mobile, 2 cols sur tablette/desktop -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                    <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full bg-transparent border-none p-0 text-xl font-light focus:ring-0 tracking-tighter outline-none">
                </div>
                <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                    <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Confirmation</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full bg-transparent border-none p-0 text-xl font-light focus:ring-0 tracking-tighter outline-none">
                </div>
            </div>

            <!-- Actions Finales -->
            <div class="pt-6 lg:pt-10">
                <button type="submit" class="w-full bg-white text-black py-5 lg:py-6 rounded-2xl font-black uppercase text-[11px] lg:text-xs tracking-[0.3em] hover:bg-indigo-600 hover:text-white transition-all duration-500 shadow-2xl active:scale-[0.98]">
                    Commencer l'expérience
                </button>

                <div class="mt-8">
                    <a href="{{ route('login') }}" class="inline-block text-[10px] sm:text-[11px] uppercase tracking-widest opacity-30 hover:opacity-100 transition-all italic underline decoration-white/10 underline-offset-4 leading-relaxed">
                        Déjà inscrit ? Connectez-vous
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
