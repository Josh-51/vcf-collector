<x-app-layout>
    <div class="pt-24 lg:pt-40 pb-20 px-4 sm:px-6 lg:px-12">
        <div class="max-w-[1500px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">

            <!-- FORMULAIRE (À GAUCHE) -->
            <div class="lg:col-span-4 lg:sticky lg:top-40 h-fit space-y-8 lg:space-y-12">
                <div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tighter uppercase italic leading-none mb-4">Mon Studio.</h1>
                    <p class="text-white/30 text-[10px] sm:text-xs italic tracking-widest uppercase font-mono">Initialiser une nouvelle unité</p>
                </div>

                <div class="p-6 sm:p-8 border border-white/10 rounded-[2rem] bg-white/[0.02] backdrop-blur-xl relative overflow-hidden group">
                    <form action="{{ route('links.store') }}" method="POST" class="space-y-8 relative z-10 font-mono">
                        @csrf
                        <div class="group border-b border-white/10 pb-3 focus-within:border-white transition-all">
                            <label class="text-[9px] uppercase tracking-widest text-white/20 block mb-2 font-bold">Titre du Groupe</label>
                            <input type="text" name="title" required placeholder="EX: FORMATION TRADING" class="w-full bg-transparent border-none p-0 text-xl font-bold uppercase tracking-tighter placeholder:text-white/5 italic focus:ring-0">
                        </div>

                        <!-- NOUVEAU CHAMP SUFFIXE -->
                        <div class="group border-b border-white/10 pb-3 focus-within:border-white transition-all">
                            <label class="text-[9px] uppercase tracking-widest text-white/20 block mb-2 font-bold italic">Suffixe des noms (Optionnel)</label>
                            <input type="text" name="suffix" placeholder="EX: MASTERCLASS 2" class="w-full bg-transparent border-none p-0 text-xl font-bold uppercase tracking-tighter placeholder:text-white/5 italic focus:ring-0">
                        </div>

                        <div class="group border-b border-white/10 pb-3 focus-within:border-white transition-all">
                            <label class="text-[9px] uppercase tracking-widest text-white/20 block mb-2 font-bold">Objectif</label>
                            <input type="number" name="target_count" required placeholder="EX: 100" class="w-full bg-transparent border-none p-0 text-xl font-bold uppercase tracking-tighter italic focus:ring-0">
                        </div>

                        <div class="group border-b border-white/10 pb-3 focus-within:border-white transition-all">
                            <label class="text-[9px] uppercase tracking-widest text-white/20 block mb-2 font-bold italic">Accès au VCF</label>
                            <select name="is_download_public" class="w-full bg-transparent border-none p-0 text-lg font-bold uppercase tracking-tighter italic text-white outline-none focus:ring-0">
                                <option value="1" class="bg-[#0f0f0f]">Tout le monde (Public)</option>
                                <option value="0" class="bg-[#0f0f0f]">Moi uniquement (Privé)</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full py-5 bg-white text-black font-black uppercase text-[10px] tracking-widest rounded-full hover:bg-indigo-600 hover:text-white transition-all duration-500 shadow-2xl active:scale-95">
                            Déployer le lien
                        </button>
                    </form>
                </div>
            </div>

            <!-- LISTE (À DROITE) -->
            <div class="lg:col-span-8 space-y-8">
                <div class="flex justify-between items-end border-b border-white/5 pb-4 sm:pb-6">
                    <h2 class="text-[9px] sm:text-[10px] uppercase tracking-[0.5em] text-white/20 font-bold italic">Unités en cours</h2>
                    <span class="text-[9px] sm:text-[10px] font-bold opacity-40 font-mono tracking-widest">{{ $links->count() }} ACTIVES</span>
                </div>

                <div class="grid gap-6">
                    @forelse($links as $link)
                        <div class="group bg-white/[0.02] border border-white/10 hover:border-indigo-600/30 p-6 sm:p-10 rounded-[2.5rem] transition-all duration-700 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
                            <div class="flex-1 w-full">
                                <div class="flex items-center gap-4 mb-2">
                                    <span class="text-[8px] font-mono uppercase px-2 py-1 border border-white/10 rounded-full text-white/40 italic">ID: {{ $link->id }}</span>
                                    @if($link->suffix)
                                        <span class="text-[8px] font-mono uppercase px-2 py-1 bg-white/5 text-white/60 rounded-full font-bold italic">Suffixe: {{ $link->suffix }}</span>
                                    @endif
                                </div>
                                <h3 class="text-3xl lg:text-4xl font-black tracking-tighter uppercase italic group-hover:text-white transition-all duration-500 break-words">{{ $link->title }}</h3>
                                <div class="mt-6 flex flex-wrap gap-4 sm:gap-8 items-center text-[9px] uppercase font-bold tracking-widest opacity-40">
                                    <button onclick="navigator.clipboard.writeText('{{ route('public.show', $link->slug) }}'); alert('Lien copié !')" class="hover:text-white transition-colors underline decoration-white/10 underline-offset-4">Copier URL</button>
                                    <a href="{{ route('public.show', $link->slug) }}" target="_blank" class="hover:text-white transition-colors underline decoration-white/10 italic">Aperçu Live</a>
                                </div>
                            </div>

                            <div class="flex flex-col items-start lg:items-end gap-6 w-full lg:w-auto border-t lg:border-t-0 pt-6 lg:pt-0 border-white/5">
                                <div class="text-left lg:text-right w-full">
                                    <div class="flex items-baseline lg:justify-end gap-1">
                                        <span class="text-6xl font-black italic leading-none">{{ $link->contacts_count }}</span>
                                        <span class="text-lg opacity-20 italic">/{{ $link->target_count }}</span>
                                    </div>
                                    <div class="w-full lg:w-48 h-[1px] bg-white/5 mt-3 relative overflow-hidden">
                                        @php $percent = $link->target_count > 0 ? ($link->contacts_count / $link->target_count) * 100 : 0; @endphp
                                        <div class="absolute inset-y-0 right-0 bg-white transition-all duration-1000" style="width: {{ min($percent, 100) }}%"></div>
                                    </div>
                                </div>
                                <a href="{{ route('public.download', $link->slug) }}" class="flex items-center justify-center gap-3 w-full lg:w-auto px-8 py-4 bg-white text-black font-black uppercase text-[9px] tracking-widest rounded-2xl hover:bg-indigo-600 hover:text-white transition-all duration-500 shadow-xl active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" stroke-width="2.5" stroke-linecap="round"/></svg>
                                    Exporter VCF
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-24 text-center border border-dashed border-white/10 rounded-[3rem] opacity-20 italic uppercase tracking-widest text-[10px]">
                            Aucun groupe initialisé.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
