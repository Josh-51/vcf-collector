<x-guest-layout>
    <div class="space-y-12 text-center lg:text-left">
        <header>
            <h1 class="text-6xl font-black tracking-tighter uppercase italic leading-none mb-4">Content de vous revoir.</h1>
            <p class="text-white/40 text-sm italic">Accédez à votre gestionnaire de contacts intelligent.</p>
        </header>

        <form method="POST" action="{{ route('login') }}" class="space-y-10">
            @csrf
            <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                <label class="text-[10px] uppercase text-white/30 block mb-2 tracking-widest font-bold">Votre Email</label>
                <input type="email" name="email" required autofocus class="w-full bg-transparent border-none p-0 text-2xl font-light focus:ring-0 placeholder:text-white/5 uppercase tracking-tighter italic">
            </div>

            <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-all">
                <div class="flex justify-between items-center mb-2">
                    <label class="text-[10px] uppercase text-white/30 block tracking-widest font-bold">Votre Mot de passe</label>
                    <a href="{{ route('password.request') }}" class="text-[9px] uppercase opacity-40 hover:opacity-100 italic">Oublié ?</a>
                </div>
                <input type="password" name="password" required class="w-full bg-transparent border-none p-0 text-2xl font-light focus:ring-0 uppercase tracking-tighter italic">
            </div>

            <div class="pt-8">
                <button class="w-full bg-white text-black py-6 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-indigo-600 hover:text-white transition-all duration-500 shadow-2xl">
                    Se Connecter à l'Espace
                </button>
                <p class="text-center mt-8">
                    <a href="{{ route('register') }}" class="text-[10px] uppercase tracking-widest opacity-30 hover:opacity-100 transition-all italic underline decoration-white/10">Nouveau ici ? Créer un compte gratuitement</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
