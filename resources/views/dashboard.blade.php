<x-app-layout>
    <div class="px-6 lg:px-12 py-12 lg:py-24">

        <div class="grid lg:grid-cols-12 gap-16">

            <!-- Section Titre (Fixe sur le côté) -->
            <div class="lg:col-span-4">
                <h1 class="text-6xl font-bold tracking-tighter leading-none mb-8 italic uppercase">
                    Index<br>Collecte
                </h1>

                <div class="mt-20 p-8 border border-white/10 rounded-3xl bg-white/[0.02]">
                    <h2 class="text-xs uppercase tracking-[0.3em] text-white/40 mb-8">Nouveau Groupe</h2>
                    <form action="{{ route('links.store') }}" method="POST" class="space-y-8 font-light">
                        @csrf
                        <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-colors">
                            <label class="text-[10px] uppercase text-white/30 block mb-2">Identification</label>
                            <input type="text" name="title" required placeholder="TITRE DU PROJET"
                                   class="bg-transparent border-none w-full p-0 text-2xl focus:ring-0 placeholder:text-white/10 uppercase tracking-tighter">
                        </div>
                        <div class="group border-b border-white/10 pb-2 focus-within:border-white transition-colors">
                            <label class="text-[10px] uppercase text-white/30 block mb-2">Seuil de données</label>
                            <input type="number" name="target_count" required placeholder="NOMBRE"
                                   class="bg-transparent border-none w-full p-0 text-2xl focus:ring-0 placeholder:text-white/10 uppercase tracking-tighter">
                        </div>
                        <button type="submit" class="w-full bg-white text-vblack py-5 rounded-full font-bold text-sm uppercase tracking-widest hover:invert transition-all">
                            Initialiser
                        </button>
                    </form>
                </div>
            </div>

            <!-- Liste des liens (Style Brutaliste Minimal) -->
            <div class="lg:col-span-8">
                <div class="grid gap-4">
                    @forelse($links as $link)
                        <div class="group relative bg-vgrey hover:bg-white transition-all duration-700 p-10 rounded-[2.5rem] flex flex-col md:flex-row justify-between items-start md:items-center gap-8 overflow-hidden">

                            <!-- Contenu -->
                            <div class="relative z-10 flex-1">
                                <p class="text-xs font-bold text-white/30 group-hover:text-vblack/40 mb-2 italic">LNR — {{ $link->created_at->format('Y') }}</p>
                                <h3 class="text-4xl font-bold tracking-tighter uppercase group-hover:text-vblack transition-colors">{{ $link->title }}</h3>

                                <div class="mt-6 flex items-center gap-4">
                                    <button onclick="navigator.clipboard.writeText('{{ route('public.show', $link->slug) }}')"
                                            class="text-[10px] uppercase tracking-widest px-4 py-2 border border-white/10 group-hover:border-vblack/10 group-hover:text-vblack transition-all rounded-full hover:bg-vblack hover:text-white">
                                        Copier URL
                                    </button>
                                    <a href="{{ route('public.show', $link->slug) }}" target="_blank" class="text-[10px] uppercase tracking-widest group-hover:text-vblack/60 font-bold underline">Aperçu</a>
                                </div>
                            </div>

                            <!-- Progress Circle (Custom Design) -->
                            <div class="relative z-10 flex flex-col items-end">
                                <div class="text-6xl font-black group-hover:text-vblack transition-colors">
                                    {{ $link->contacts_count }}<span class="text-lg opacity-30">/{{ $link->target_count }}</span>
                                </div>
                                <div class="w-32 h-[2px] bg-white/10 group-hover:bg-vblack/10 mt-2 relative">
                                    @php $percent = ($link->contacts_count / $link->target_count) * 100; @endphp
                                    <div class="absolute inset-y-0 left-0 bg-white group-hover:bg-vblack transition-all duration-1000" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="h-64 border border-dashed border-white/10 rounded-[2.5rem] flex items-center justify-center text-white/20 italic font-light uppercase tracking-widest">
                            Aucun enregistrement trouvé.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
