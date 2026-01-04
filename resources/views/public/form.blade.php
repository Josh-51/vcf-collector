<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $link->title }} — COLLECTE PRIVÉE</title>

    <!-- Design System : Tailwind & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        sans: ['Space Grotesk', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace']
                    },
                }
            }
        }
    </script>

    <style>
        .grain::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .05; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }
        body { background-color: #000; color: #fff; }
        input:focus { outline: none; border-bottom: 2px solid #fff !important; }
        .locked-state { filter: grayscale(1); opacity: 0.15; cursor: not-allowed; pointer-events: none; }
        .progress-bar { transition: width 1.5s cubic-bezier(0.65, 0, 0.35, 1); }
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="antialiased grain overflow-x-hidden">
<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12 lg:py-24">

    <!-- EN-TÊTE : Titre Massif -->
    <header class="max-w-4xl w-full mb-16 lg:mb-32 text-center lg:text-left">
        <div class="inline-block px-3 py-1 border border-white/10 rounded-full mb-6">
            <span class="text-[10px] uppercase tracking-[0.5em] text-white/40 italic">Terminal de collecte v.01</span>
        </div>
        <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold tracking-tighter uppercase leading-[0.85] italic">
            {{ $link->title }}
        </h1>
    </header>

    <!-- GRILLE PRINCIPALE -->
    <div class="max-w-5xl w-full grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start">

        <!-- COLONNE 1 : FORMULAIRE -->
        <div class="lg:col-span-7 order-1 flex flex-col gap-12">

            @if(session('success'))
                <div class="p-8 border border-white/10 rounded-[2rem] bg-white/[0.02] animate-pulse">
                    <p class="text-2xl italic font-light tracking-tight">"{{ session('success') }}"</p>
                    <p class="text-[10px] uppercase tracking-[0.3em] text-white/30 mt-4 font-bold">Système mis à jour</p>
                </div>
            @endif

            <!-- BOUTON INJECTION MASSIVE (Caché par défaut, activé par JS) -->
            <div id="bulk-container" class="hidden">
                <button id="bulk-import-btn" class="w-full p-8 lg:p-10 border-2 border-dashed border-indigo-500/20 rounded-[2.5rem] bg-indigo-500/[0.02] hover:bg-indigo-500/[0.05] transition-all group text-left">
                    <div class="flex items-center gap-6">
                        <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-[0_0_30px_rgba(99,102,241,0.3)] group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round"/></svg>
                        </div>
                        <div>
                            <span class="block text-xs font-black uppercase tracking-[0.3em] text-indigo-400 mb-1">Injection Massive</span>
                            <span class="block font-mono text-[9px] text-white/20 uppercase italic">Importer plusieurs contacts d'un coup</span>
                        </div>
                    </div>
                </button>
                <div class="relative my-12 flex items-center justify-center">
                    <div class="w-full h-[1px] bg-white/5"></div>
                    <span class="absolute bg-black px-4 font-mono text-[8px] text-white/20 uppercase tracking-[0.5em]">Ou Saisie Manuelle</span>
                </div>
            </div>

            <form action="{{ route('public.submit', $link->slug) }}" method="POST" class="space-y-16">
                @csrf
                <div class="group relative">
                    <label class="text-[10px] uppercase text-white/30 block mb-4 tracking-[0.4em] font-bold">Identité de l'inscrit</label>
                    <input type="text" name="name" required placeholder="NOM COMPLET"
                           class="w-full bg-transparent border-b border-white/10 py-6 text-3xl lg:text-4xl font-light focus:border-white transition-all outline-none uppercase tracking-tighter placeholder:text-white/5">
                </div>

                <div class="group relative">
                    <label class="text-[10px] uppercase text-white/30 block mb-4 tracking-[0.4em] font-bold">Ligne WhatsApp</label>
                    <input type="text" name="phone" required placeholder="+229 00 00 00 00"
                           class="w-full bg-transparent border-b border-white/10 py-6 text-3xl lg:text-4xl font-light focus:border-white transition-all outline-none uppercase tracking-tighter placeholder:text-white/5">
                </div>

                <button type="submit" class="group flex items-center gap-8 text-[11px] uppercase tracking-[0.5em] font-black hover:gap-12 transition-all">
                    <span class="border-b border-white/20 pb-1">Envoyer mes données</span>
                    <div class="w-16 h-16 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all duration-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </button>
            </form>
        </div>

        <!-- COLONNE 2 : PROGRESSION -->
        <div class="lg:col-span-5 order-2 w-full flex flex-col gap-10">
            <div class="p-10 lg:p-12 border border-white/10 rounded-[3rem] bg-white/[0.02] backdrop-blur-sm relative overflow-hidden">
                <div class="mb-16 text-right">
                    <p class="text-[10px] uppercase tracking-[0.4em] text-white/20 mb-6 font-bold italic border-b border-white/5 pb-4">Status du protocole d'export</p>
                    <div class="flex items-baseline justify-end gap-3">
                        <span class="text-8xl lg:text-9xl font-bold tracking-tighter italic leading-none">{{ $link->contacts_count }}</span>
                        <span class="text-3xl text-white/10 font-light">/{{ $link->target_count }}</span>
                    </div>
                </div>

                <div class="h-[1px] w-full bg-white/5 mb-16 relative">
                    @php $percent = ($link->contacts_count / $link->target_count) * 100; @endphp
                    <div class="absolute inset-y-0 right-0 bg-white shadow-[0_0_15px_rgba(255,255,255,0.5)] progress-bar"
                         style="width: {{ min($percent, 100) }}%"></div>
                </div>

                <div class="relative">
                    @if($link->contacts_count >= $link->target_count)
                        <a href="{{ route('public.download', $link->slug) }}"
                           class="flex flex-col items-center justify-center gap-8 p-12 bg-white text-black rounded-[2.5rem] hover:scale-[1.03] transition-all duration-700 group shadow-[0_30px_60px_rgba(255,255,255,0.1)]">
                            <div class="w-14 h-14 border border-black/10 rounded-full flex items-center justify-center animate-bounce">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            </div>
                            <span class="text-[11px] font-black uppercase tracking-[0.6em]">Télécharger .VCF</span>
                        </a>
                    @else
                        <div class="locked-state flex flex-col items-center justify-center gap-8 p-12 border border-white/20 bg-transparent rounded-[2.5rem]">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="1"></path></svg>
                            <span class="text-[11px] font-black uppercase tracking-[0.6em]">Export Verrouillé</span>
                        </div>
                        <div class="mt-8 text-center">
                            <p class="text-[10px] text-white/40 uppercase tracking-[0.3em] font-medium italic">En attente de {{ $link->target_count - $link->contacts_count }} nouvelles entrées</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER GLOBAL -->
    <footer class="mt-40 border-t border-white/5 pt-12 w-full max-w-5xl flex flex-col md:flex-row justify-between items-center gap-8 opacity-20 hover:opacity-100 transition-opacity duration-1000 text-[10px] font-mono uppercase tracking-widest italic font-bold">
        <p>VCF COLLECTOR / TERMINAL 0.1</p>
        <div class="flex gap-8">
            <span>Privacy First</span>
            <span>Automated System</span>
        </div>
    </footer>
</div>

<!-- LOGIQUE D'IMPORTATION MASSIVE -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bulkBtn = document.getElementById('bulk-import-btn');
    const container = document.getElementById('bulk-container');

    // Vérifie si l'API Contact Picker est supportée
    const isSupported = ('contacts' in navigator && 'ContactsManager' in window);

    if (isSupported) {
        container.classList.remove('hidden'); // On montre le bouton
        
        bulkBtn.addEventListener('click', async () => {
            const props = ['name', 'tel'];
            const opts = { multiple: true }; // Autoriser plusieurs contacts

            try {
                const selectedContacts = await navigator.contacts.select(props, opts);
                
                if (selectedContacts.length > 0) {
                    // Préparation des données pour le serveur
                    const formattedContacts = selectedContacts.map(c => ({
                        name: c.name && c.name.length > 0 ? c.name[0] : 'Sans Nom',
                        tel: c.tel && c.tel.length > 0 ? c.tel[0] : ''
                    })).filter(c => c.tel !== '');

                    if(formattedContacts.length === 0) return;

                    // Envoi AJAX au serveur (tu dois créer cette route bulkSubmit)
                    fetch("{{ route('public.bulk', $link->slug) }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ contacts: formattedContacts })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            alert(data.count + " contacts ajoutés à l'index collectif !");
                            window.location.reload();
                        }
                    })
                    .catch(err => alert("Erreur lors de l'injection. Assurez-vous d'être en HTTPS."));
                }
            } catch (err) {
                console.log("Annulation ou erreur:", err);
            }
        });
    }
});
</script>

</body>
</html>
