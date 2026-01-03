<x-guest-layout>
    <div class="space-y-12">
        <!-- HEADER : Protocole de Récupération -->
        <header>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-white/10 bg-white/5 mb-6">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                <span class="text-[9px] font-mono uppercase tracking-[0.2em] text-white/40 font-bold italic tracking-widest">Override Protocol active</span>
            </div>
            <h1 class="text-6xl font-black tracking-tighter uppercase italic leading-none mb-2">Recovery</h1>
            <p class="font-mono text-[10px] uppercase tracking-widest text-white/20 italic">Initialisation d'une nouvelle clé d'accès</p>
        </header>

        <!-- FORMULAIRE -->
        <form method="POST" action="{{ route('password.store') }}" class="space-y-10">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="group relative border-b border-white/5 pb-2 focus-within:border-white transition-all duration-500">
                <label class="font-mono text-[9px] uppercase text-white/20 block mb-2 tracking-[0.3em] font-bold">Point d'accès / Email</label>
                <input type="email" id="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"
                       class="w-full bg-transparent border-none p-0 text-2xl font-light focus:ring-0 placeholder:text-white/5 uppercase tracking-tighter italic">
                @error('email')
                <p class="font-mono text-red-500 text-[9px] uppercase mt-4 italic tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="group relative border-b border-white/5 pb-2 focus-within:border-white transition-all duration-500">
                <label class="font-mono text-[9px] uppercase text-white/20 block mb-2 tracking-[0.3em] font-bold">Nouvelle clé d'accès</label>
                <input type="password" id="password" name="password" required autocomplete="new-password"
                       class="w-full bg-transparent border-none p-0 text-2xl font-light focus:ring-0 placeholder:text-white/5 uppercase tracking-tighter italic text-indigo-400">
                @error('password')
                <p class="font-mono text-red-500 text-[9px] uppercase mt-4 italic tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="group relative border-b border-white/5 pb-2 focus-within:border-white transition-all duration-500">
                <label class="font-mono text-[9px] uppercase text-white/20 block mb-2 tracking-[0.3em] font-bold">Confirmation de clé</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                       class="w-full bg-transparent border-none p-0 text-2xl font-light focus:ring-0 placeholder:text-white/5 uppercase tracking-tighter italic text-indigo-400">
                @error('password_confirmation')
                <p class="font-mono text-red-500 text-[9px] uppercase mt-4 italic tracking-widest">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Button -->
            <div class="pt-8 flex flex-col gap-6">
                <button type="submit" class="w-full bg-white text-black py-6 rounded-2xl font-black text-xs uppercase tracking-[0.5em] hover:bg-indigo-600 hover:text-white transition-all duration-700 shadow-2xl active:scale-[0.98]">
                    Mettre à jour le protocole
                </button>

                <div class="flex justify-center items-center gap-4 opacity-20 italic">
                    <span class="w-8 h-[1px] bg-white"></span>
                    <span class="font-mono text-[8px] uppercase tracking-widest">End of transmission</span>
                    <span class="w-8 h-[1px] bg-white"></span>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
