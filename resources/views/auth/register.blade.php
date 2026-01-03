<x-guest-layout>
    <div class="space-y-12 text-center lg:text-left">
        <header>
            <h1 class="text-6xl font-black tracking-tighter uppercase italic leading-none mb-4">Rejoignez l'élite.</h1>
            <p class="text-white/40 text-sm italic">Générez vos premiers fichiers VCF en moins de 2 minutes.</p>
        </header>

        <form method="POST" action="{{ route('register') }}" class="space-y-8">
            @csrf
            <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Votre Nom complet</label>
                <input type="text" name="name" required class="w-full bg-transparent border-none p-0 text-2xl font-light focus:ring-0 uppercase tracking-tighter italic">
            </div>

            <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Adresse Email Professionnelle</label>
                <input type="email" name="email" required class="w-full bg-transparent border-none p-0 text-2xl font-light focus:ring-0 uppercase tracking-tighter italic">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                    <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Mot de passe</label>
                    <input type="password" name="password" required class="w-full bg-transparent border-none p-0 text-xl font-light focus:ring-0 tracking-tighter">
                </div>
                <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                    <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Confirmation</label>
                    <input type="password" name="password_confirmation" required class="w-full bg-transparent border-none p-0 text-xl font-light focus:ring-0 tracking-tighter">
                </div>
            </div>

            <div class="pt-10">
                <button class="w-full bg-white text-black py-6 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-indigo-600 hover:text-white transition-all duration-500 shadow-2xl">
                    Commencer l'expérience
                </button>
                <p class="text-center mt-8 italic text-[10px] uppercase tracking-widest opacity-30 hover:opacity-100 transition-all">
                    <a href="{{ route('login') }}" class="underline decoration-white/10">Déjà inscrit ? Connectez-vous</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
