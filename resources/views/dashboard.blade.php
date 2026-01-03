<x-app-layout>
    <div class="pt-40 pb-20 px-6 lg:px-12">
        <div class="max-w-[1500px] mx-auto grid lg:grid-cols-12 gap-20">

            <!-- FORMULAIRE (À GAUCHE) -->
            <div class="lg:col-span-4 lg:sticky lg:top-40 h-fit space-y-12">
                <div>
                    <h1 class="text-6xl font-black tracking-tighter uppercase italic leading-none mb-4">Mon Studio.</h1>
                    <p class="text-white/30 text-xs italic tracking-widest uppercase">Lancez une nouvelle collecte de contacts</p>
                </div>

                <div class="p-8 border border-white/10 rounded-[2.5rem] bg-white/[0.02] backdrop-blur-xl relative overflow-hidden group">
                    <div class="absolute -top-24 -left-24 w-48 h-48 bg-indigo-600/10 rounded-full blur-[80px] group-hover:bg-indigo-600/20 transition-all duration-700"></div>

                    <form action="{{ route('links.store') }}" method="POST" class="space-y-10 relative z-10">
                        @csrf
                        <div class="group border-b border-white/10 pb-4 focus-within:border-white transition-all">
                            <label class="text-[9px] uppercase tracking-widest text-white/20 block mb-2 font-bold">Nom de votre groupe (Public)</label>
                            <input type="text" name="title" required placeholder="EX: FORMATION TRADING" class="w-full bg-transparent border-none text-2xl font-bold uppercase tracking-tighter placeholder:text-white/5 italic">
                        </div>
                        <div class="group border-b border-white/10 pb-4 focus-within:border-white transition-all">
                            <label class="text-[9px] uppercase tracking-widest text-white/20 block mb-2 font-bold">Objectif de participants</label>
                            <input type="number" name="target_count" required placeholder="EX: 100" class="w-full bg-transparent border-none text-2xl font-bold uppercase tracking-tighter italic">
                        </div>
                        <button type="submit" class="w-full py-6 bg-white text-black font-black uppercase text-xs tracking-widest rounded-full hover:bg-indigo-600 hover:text-white transition-all duration-500 shadow-2xl">
                            Lancer la Collecte
                        </button>
                    </form>
                </div>
            </div>

            <!-- LISTE (À DROITE) -->
            <div class="lg:col-span-8 space-y-10">
                <div class="flex justify-between items-end border-b border-white/5 pb-6">
                    <h2 class="text-[10px] uppercase tracking-[0.5em] text-white/20 font-bold italic">Suivi de vos groupes actifs</h2>
                    <span class="text-[10px] font-bold opacity-40 uppercase italic tracking-widest">{{ $links->count() }} Groupes</span>
                </div>

                <div class="grid gap-6">
                    @forelse($links as $link)
                        <div class="group bg-white/[0.02] border border-white/10 hover:border-indigo-600/30 p-10 rounded-[3rem] transition-all duration-700 flex flex-col md:flex-row justify-between items-start md:items-center gap-10">
                            <div class="flex-1">
                                <h3 class="text-4xl font-black tracking-tighter uppercase italic group-hover:text-white transition-all duration-500">{{ $link->title }}</h3>
                                <div class="mt-8 flex flex-wrap gap-8 items-center text-[10px] uppercase font-bold tracking-widest opacity-40">
                                    <button onclick="navigator.clipboard.writeText('{{ route('public.show', $link->slug) }}'); alert('Lien copié !')" class="hover:text-white transition-colors underline decoration-white/10">Copier le Lien Public</button>
                                    <a href="{{ route('public.show', $link->slug) }}" target="_blank" class="hover:text-white transition-colors underline decoration-white/10 italic">Voir la page live</a>
                                </div>
                            </div>

                            <div class="flex flex-col items-start md:items-end gap-6 w-full md:w-auto border-t md:border-t-0 pt-6 md:pt-0 border-white/5">
                                <div class="text-right">
                                    <span class="text-7xl font-black italic leading-none">{{ $link->contacts_count }}</span>
                                    <span class="text-xl opacity-20 italic">/{{ $link->target_count }}</span>
                                    <div class="w-48 h-[2px] bg-white/5 mt-2 relative overflow-hidden rounded-full">
                                        @php $percent = $link->target_count > 0 ? ($link->contacts_count / $link->target_count) * 100 : 0; @endphp
                                        <div class="absolute inset-y-0 right-0 bg-indigo-500 transition-all duration-1000" style="width: {{ min($percent, 100) }}%"></div>
                                    </div>
                                </div>
                                <!-- LE BOUTON DOWNLOAD POUR TOI -->
                                <a href="{{ route('public.download', $link->slug) }}" class="flex items-center gap-3 px-10 py-4 bg-white text-black font-black uppercase text-[10px] tracking-widest rounded-2xl hover:bg-indigo-600 hover:text-white transition-all duration-500 shadow-xl">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5"/></svg>
                                    Exporter VCF
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-40 text-center border border-dashed border-white/10 rounded-[3rem] opacity-20 italic uppercase tracking-widest text-xs">
                            Aucun groupe créé pour le moment.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
