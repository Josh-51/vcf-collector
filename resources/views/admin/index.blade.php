<x-app-layout>
    <div class="px-6 lg:px-12 py-12 lg:py-20">

        <!-- HEADER ADMIN -->
        <header class="mb-20 flex flex-col md:flex-row justify-between items-end gap-8">
            <div>
                <span class="text-[10px] uppercase tracking-[0.5em] text-white/30 italic block mb-4">Master Console — Root Access</span>
                <h1 class="text-7xl font-bold tracking-tighter uppercase italic leading-none">Global<br>Overview</h1>
            </div>

            <!-- GLOBAL STATS -->
            <div class="grid grid-cols-3 gap-12 border-l border-white/10 pl-12">
                <div>
                    <p class="text-[9px] uppercase tracking-widest text-white/30 mb-2 font-bold">Agents</p>
                    <p class="text-3xl font-bold italic">{{ $stats['total_users'] }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-widest text-white/30 mb-2 font-bold">Protocoles</p>
                    <p class="text-3xl font-bold italic">{{ $stats['total_links'] }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-widest text-white/30 mb-2 font-bold">Data Ingested</p>
                    <p class="text-3xl font-bold italic">{{ $stats['total_contacts'] }}</p>
                </div>
            </div>
        </header>

        <!-- DATA TABLE -->
        <div class="w-full overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                <tr class="border-b border-white/10 uppercase text-[10px] tracking-[0.3em] text-white/30 font-bold">
                    <th class="py-6 pr-6 italic font-light"># ID</th>
                    <th class="py-6 px-6">Propriétaire</th>
                    <th class="py-6 px-6">Identité du groupe</th>
                    <th class="py-6 px-6">Status de collecte</th>
                    <th class="py-6 px-6 text-right">Date d'init.</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                @foreach($links as $link)
                    <tr class="group hover:bg-white/[0.02] transition-colors">
                        <td class="py-8 pr-6 text-white/20 font-mono text-xs">{{ $link->id }}</td>
                        <td class="py-8 px-6">
                            <span class="block text-sm font-bold tracking-tight">{{ $link->user->name }}</span>
                            <span class="text-[10px] text-white/30">{{ $link->user->email }}</span>
                        </td>
                        <td class="py-8 px-6">
                            <span class="text-lg font-bold tracking-tighter uppercase group-hover:text-white transition-colors">{{ $link->title }}</span>
                        </td>
                        <td class="py-8 px-6">
                            <div class="flex items-center gap-4">
                                <span class="text-2xl font-bold italic tracking-tighter">
                                    {{ $link->contacts_count }} <span class="text-xs text-white/20">/ {{ $link->target_count }}</span>
                                </span>
                                <div class="w-20 h-[1px] bg-white/5 relative">
                                    @php $percent = $link->target_count > 0 ? ($link->contacts_count / $link->target_count) * 100 : 0; @endphp
                                    <div class="absolute inset-y-0 left-0 bg-white" style="width: {{ min($percent, 100) }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-8 px-6 text-right text-sm text-white/40 font-light">
                            {{ $link->created_at->format('d.m.Y — H:i') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @if($links->isEmpty())
            <div class="py-40 text-center border border-dashed border-white/5 rounded-[3rem] mt-10">
                <p class="text-[10px] uppercase tracking-[0.5em] text-white/10">Aucune donnée système disponible.</p>
            </div>
        @endif

    </div>
</x-app-layout>
