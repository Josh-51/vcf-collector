<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $link->title }} — COLLECTE PRIVÉE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['Space Grotesk', 'sans-serif'], mono: ['JetBrains Mono', 'monospace'] } } }
        }
    </script>
    <style>
        .grain::before {
            content: ""; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none; opacity: .05; z-index: 9999;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
        }
        body { background-color: #000; color: #fff; }
        input:focus, select:focus { outline: none !important; box-shadow: none !important; border-bottom: 2px solid #fff !important; }
        .progress-bar { transition: width 1.5s cubic-bezier(0.65, 0, 0.35, 1); }
        .country-list::-webkit-scrollbar { width: 4px; }
        .country-list::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased grain overflow-x-hidden selection:bg-indigo-500/30">
<div class="min-h-screen flex flex-col items-center justify-center px-6 py-12 lg:py-24">

    <!-- EN-TÊTE -->
    <header class="max-w-4xl w-full mb-16 lg:mb-32 text-center lg:text-left">
        <div class="inline-block px-3 py-1 border border-white/10 rounded-full mb-6">
            <span class="text-[10px] uppercase font-mono tracking-[0.5em] text-white/40 italic font-bold text-indigo-400">System Protocol Active</span>
        </div>
        <h1 class="text-5xl md:text-8xl lg:text-9xl font-bold tracking-tighter uppercase leading-[0.85] italic">{{ $link->title }}</h1>
    </header>

    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start">

        <!-- COLONNE 1 : FORMULAIRE -->
        <div class="lg:col-span-7 order-1 flex flex-col gap-12">
            @if(session('success'))
                <div class="p-8 border border-white/10 rounded-[2rem] bg-indigo-500/10 border-indigo-500/20 animate-pulse">
                    <p class="text-2xl italic font-light tracking-tight text-indigo-400">"{{ session('success') }}"</p>
                </div>
            @endif

            <!-- INJECTION MASSIVE -->
            <div id="bulk-container" class="hidden">
                <button id="bulk-import-btn" class="w-full p-8 lg:p-12 border-2 border-dashed border-indigo-500/20 rounded-[2.5rem] bg-indigo-500/[0.02] hover:bg-indigo-500/[0.05] transition-all group text-left">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center shadow-[0_0_30px_rgba(99,102,241,0.3)] group-hover:scale-105 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round"/></svg>
                        </div>
                        <div>
                            <span class="block text-sm font-black uppercase tracking-[0.3em] text-indigo-400 mb-1">Injection Massive</span>
                            <span class="block font-mono text-[9px] text-white/20 uppercase italic font-bold">Import direct depuis votre répertoire</span>
                        </div>
                    </div>
                </button>
                <div class="relative my-16 flex items-center justify-center text-center">
                    <div class="w-full h-[1px] bg-white/5"></div>
                    <span class="absolute bg-black px-6 font-mono text-[9px] text-white/20 uppercase tracking-[0.5em]">Ou Saisie Individuelle</span>
                </div>
            </div>

            <form action="{{ route('public.submit', $link->slug) }}" method="POST" class="space-y-16">
                @csrf
                <div class="group relative">
                    <label class="text-[10px] uppercase text-white/30 block mb-4 tracking-[0.4em] font-bold italic">Identité du participant</label>
                    <input type="text" name="name" required placeholder="VOTRE NOM COMPLET" class="w-full bg-transparent border-b border-white/10 py-6 text-3xl lg:text-4xl font-light focus:border-white transition-all outline-none uppercase tracking-tighter placeholder:text-white/5">
                </div>

                <div class="group relative">
                    <label class="text-[10px] uppercase text-white/30 block mb-4 tracking-[0.4em] font-bold italic">Contact WhatsApp</label>

                    <div class="flex flex-col md:flex-row gap-4 border-b border-white/10 focus-within:border-white transition-all relative"
                         x-data="countrySelector()" x-init="init()">

                        <input type="hidden" name="country_code" :value="selected.code">

                        <!-- Sélecteur Recherchable -->
                        <div class="relative min-w-[240px]">
                            <div @click="open = !open" class="cursor-pointer py-6 flex items-center gap-3">
                                <span class="text-3xl" x-text="selected.flag"></span>
                                <span class="text-lg font-bold uppercase italic text-indigo-400" x-text="selected.code"></span>
                                <span class="text-xs text-white/30 truncate max-w-[100px]" x-text="selected.name"></span>
                                <svg class="w-4 h-4 text-indigo-400 ml-auto" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="3"/></svg>
                            </div>

                            <!-- Dropdown -->
                            <div x-show="open" @click.away="open = false" x-cloak
                                 class="absolute top-full left-0 w-[300px] bg-[#0a0a0a] border border-white/10 rounded-2xl shadow-2xl z-[100] mt-2 overflow-hidden">
                                <div class="p-4 border-b border-white/5 bg-white/[0.02]">
                                    <input type="text" x-model="search" placeholder="Chercher pays..."
                                           class="w-full bg-transparent border-none p-0 text-sm font-mono focus:ring-0 uppercase placeholder:text-white/10">
                                </div>
                                <div class="max-h-[350px] overflow-y-auto country-list">
                                    <template x-for="country in filteredCountries" :key="country.name">
                                        <div @click="selectCountry(country)"
                                             class="flex items-center gap-4 px-6 py-4 hover:bg-white/10 cursor-pointer transition-colors border-b border-white/[0.02]">
                                            <span class="text-2xl" x-text="country.flag"></span>
                                            <div class="flex flex-col">
                                                <span class="text-[11px] font-black uppercase tracking-tight" x-text="country.name"></span>
                                                <span class="text-[10px] font-mono text-indigo-500" x-text="country.code"></span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <input type="text" name="phone" required placeholder="00 00 00 00" class="flex-1 bg-transparent border-none py-6 text-3xl lg:text-4xl font-light focus:ring-0 uppercase tracking-tighter placeholder:text-white/5">
                    </div>
                </div>

                <button type="submit" class="group flex items-center gap-8 text-[11px] uppercase tracking-[0.5em] font-black hover:gap-12 transition-all">
                    <span>Enregistrer mes données</span>
                    <div class="w-16 h-16 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-black transition-all duration-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </button>
            </form>
        </div>

        <!-- COLONNE 2 : STATS -->
        <div class="lg:col-span-5 order-2 w-full flex flex-col gap-10 lg:sticky lg:top-24">
            <div class="p-10 lg:p-12 border border-white/10 rounded-[3rem] bg-white/[0.02] backdrop-blur-sm relative overflow-hidden text-right">
                <div class="mb-16">
                    <p class="text-[10px] uppercase font-mono tracking-[0.4em] text-white/20 mb-6 font-bold italic border-b border-white/5 pb-4">Status du Réseau</p>
                    <div class="flex items-baseline justify-end gap-3">
                        <span class="text-8xl lg:text-9xl font-bold tracking-tighter italic leading-none">{{ $link->contacts_count }}</span>
                        <span class="text-3xl text-white/10 font-light">/{{ $link->target_count }}</span>
                    </div>
                </div>

                <div class="h-[1px] w-full bg-white/5 mb-16 relative">
                    @php $percent = $link->target_count > 0 ? ($link->contacts_count / $link->target_count) * 100 : 0; @endphp
                    <div class="absolute inset-y-0 right-0 bg-white shadow-[0_0_15px_rgba(255,255,255,0.5)] progress-bar"
                         style="width: {{ min($percent, 100) }}%"></div>
                </div>

                @php $isCreator = auth()->check() && auth()->id() == $link->user_id; @endphp

                <div class="relative">
                    @if($link->is_download_public || $isCreator)
                        <a href="{{ route('public.download', $link->slug) }}" class="flex flex-col items-center justify-center gap-8 p-12 bg-white text-black rounded-[2.5rem] hover:scale-[1.03] transition-all shadow-[0_30px_60px_rgba(255,255,255,0.1)] group">
                            <svg class="w-8 h-8 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            <span class="text-[11px] font-black uppercase tracking-[0.6em]">Télécharger .VCF</span>
                        </a>
                        @if(!$link->is_download_public && $isCreator)
                            <p class="mt-6 text-center text-[9px] text-indigo-400 uppercase font-mono font-bold tracking-widest italic">Note : Mode Privé Actif</p>
                        @endif
                    @else
                        <div class="flex flex-col items-center justify-center gap-8 p-12 border border-white/10 bg-transparent rounded-[2.5rem] opacity-20 cursor-not-allowed">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke-width="1.5"></path></svg>
                            <span class="text-[11px] font-black uppercase tracking-[0.6em] text-center">Accès au fichier réservé à l'administrateur</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function countrySelector() {
        return {
            open: false,
            search: '',
            selected: { flag: '🇧🇯', name: 'Bénin', code: '+229' },
            allCountries: [
                { name: 'Afghanistan', code: '+93', flag: '🇦🇫' },
                { name: 'Afrique du Sud', code: '+27', flag: '🇿🇦' },
                { name: 'Albanie', code: '+355', flag: '🇦🇱' },
                { name: 'Algérie', code: '+213', flag: '🇩🇿' },
                { name: 'Allemagne', code: '+49', flag: '🇩🇪' },
                { name: 'Andorre', code: '+376', flag: '🇦🇩' },
                { name: 'Angola', code: '+244', flag: '🇦🇴' },
                { name: 'Anguilla', code: '+1264', flag: '🇦🇮' },
                { name: 'Antigua-et-Barbuda', code: '+1268', flag: '🇦🇬' },
                { name: 'Arabie saoudite', code: '+966', flag: '🇸🇦' },
                { name: 'Argentine', code: '+54', flag: '🇦🇷' },
                { name: 'Arménie', code: '+374', flag: '🇦🇲' },
                { name: 'Aruba', code: '+297', flag: '🇦🇼' },
                { name: 'Australie', code: '+61', flag: '🇦🇺' },
                { name: 'Autriche', code: '+43', flag: '🇦🇹' },
                { name: 'Azerbaïdjan', code: '+994', flag: '🇦🇿' },
                { name: 'Bahamas', code: '+1242', flag: '🇧🇸' },
                { name: 'Bahreïn', code: '+973', flag: '🇧🇭' },
                { name: 'Bangladesh', code: '+880', flag: '🇧🇩' },
                { name: 'Barbade', code: '+1246', flag: '🇧🇧' },
                { name: 'Belgique', code: '+32', flag: '🇧🇪' },
                { name: 'Belize', code: '+501', flag: '🇧🇿' },
                { name: 'Bénin', code: '+229', flag: '🇧🇯' },
                { name: 'Bermudes', code: '+1441', flag: '🇧🇲' },
                { name: 'Bhoutan', code: '+975', flag: '🇧🇹' },
                { name: 'Biélorussie', code: '+375', flag: '🇧🇾' },
                { name: 'Birmanie', code: '+95', flag: '🇲🇲' },
                { name: 'Bolivie', code: '+591', flag: '🇧🇴' },
                { name: 'Bosnie-Herzégovine', code: '+387', flag: '🇧🇦' },
                { name: 'Botswana', code: '+267', flag: '🇧🇼' },
                { name: 'Brésil', code: '+55', flag: '🇧🇷' },
                { name: 'Brunei', code: '+673', flag: '🇧🇳' },
                { name: 'Bulgarie', code: '+359', flag: '🇧🇬' },
                { name: 'Burkina Faso', code: '+226', flag: '🇧🇫' },
                { name: 'Burundi', code: '+257', flag: '🇧🇮' },
                { name: 'Cambodge', code: '+855', flag: '🇰🇭' },
                { name: 'Cameroun', code: '+237', flag: '🇨🇲' },
                { name: 'Canada', code: '+1', flag: '🇨🇦' },
                { name: 'Cap-Vert', code: '+238', flag: '🇨🇻' },
                { name: 'Chili', code: '+56', flag: '🇨🇱' },
                { name: 'Chine', code: '+86', flag: '🇨🇳' },
                { name: 'Chypre', code: '+357', flag: '🇨🇾' },
                { name: 'Colombie', code: '+57', flag: '🇨🇴' },
                { name: 'Comores', code: '+269', flag: '🇰🇲' },
                { name: 'Congo-Brazzaville', code: '+242', flag: '🇨🇬' },
                { name: 'Congo-Kinshasa', code: '+243', flag: '🇨🇩' },
                { name: 'Corée du Nord', code: '+850', flag: '🇰🇵' },
                { name: 'Corée du Sud', code: '+82', flag: '🇰🇷' },
                { name: 'Costa Rica', code: '+506', flag: '🇨🇷' },
                { name: 'Côte d’Ivoire', code: '+225', flag: '🇨🇮' },
                { name: 'Croatie', code: '+385', flag: '🇭🇷' },
                { name: 'Cuba', code: '+53', flag: '🇨🇺' },
                { name: 'Danemark', code: '+45', flag: '🇩🇰' },
                { name: 'Djibouti', code: '+253', flag: '🇩🇯' },
                { name: 'Dominique', code: '+1767', flag: '🇩🇲' },
                { name: 'Égypte', code: '+20', flag: '🇪🇬' },
                { name: 'Émirats arabes unis', code: '+971', flag: '🇦🇪' },
                { name: 'Équateur', code: '+593', flag: '🇪🇨' },
                { name: 'Érythrée', code: '+291', flag: '🇪🇷' },
                { name: 'Espagne', code: '+34', flag: '🇪🇸' },
                { name: 'Estonie', code: '+372', flag: '🇪🇪' },
                { name: 'États-Unis', code: '+1', flag: '🇺🇸' },
                { name: 'Éthiopie', code: '+251', flag: '🇪🇹' },
                { name: 'Fidji', code: '+679', flag: '🇫🇯' },
                { name: 'Finlande', code: '+358', flag: '🇫🇮' },
                { name: 'France', code: '+33', flag: '🇫🇷' },
                { name: 'Gabon', code: '+241', flag: '🇬🇦' },
                { name: 'Gambie', code: '+220', flag: '🇬🇲' },
                { name: 'Géorgie', code: '+995', flag: '🇬🇪' },
                { name: 'Ghana', code: '+233', flag: '🇬🇭' },
                { name: 'Gibraltar', code: '+350', flag: '🇬🇮' },
                { name: 'Grèce', code: '+30', flag: '🇬🇷' },
                { name: 'Grenade', code: '+1473', flag: '🇬🇩' },
                { name: 'Groenland', code: '+299', flag: '🇬🇱' },
                { name: 'Guadeloupe', code: '+590', flag: '🇬🇵' },
                { name: 'Guam', code: '+1671', flag: '🇬🇺' },
                { name: 'Guatemala', code: '+502', flag: '🇬🇹' },
                { name: 'Guinée', code: '+224', flag: '🇬🇳' },
                { name: 'Guinée équatoriale', code: '+240', flag: '🇬🇶' },
                { name: 'Guinée-Bissau', code: '+245', flag: '🇬🇼' },
                { name: 'Guyane', code: '+592', flag: '🇬🇾' },
                { name: 'Haïti', code: '+509', flag: '🇭🇹' },
                { name: 'Honduras', code: '+504', flag: '🇭🇳' },
                { name: 'Hong Kong', code: '+852', flag: '🇭🇰' },
                { name: 'Hongrie', code: '+36', flag: '🇭🇺' },
                { name: 'Inde', code: '+91', flag: '🇮🇳' },
                { name: 'Indonésie', code: '+62', flag: '🇮🇩' },
                { name: 'Irak', code: '+964', flag: '🇮🇶' },
                { name: 'Iran', code: '+98', flag: '🇮🇷' },
                { name: 'Irlande', code: '+353', flag: '🇮🇪' },
                { name: 'Islande', code: '+354', flag: '🇮🇸' },
                { name: 'Israël', code: '+972', flag: '🇮🇱' },
                { name: 'Italie', code: '+39', flag: '🇮🇹' },
                { name: 'Jamaïque', code: '+1876', flag: '🇯🇲' },
                { name: 'Japon', code: '+81', flag: '🇯🇵' },
                { name: 'Jordanie', code: '+962', flag: '🇯🇴' },
                { name: 'Kazakhstan', code: '+7', flag: '🇰🇿' },
                { name: 'Kenya', code: '+254', flag: '🇰🇪' },
                { name: 'Kirghizistan', code: '+996', flag: '🇰🇬' },
                { name: 'Kiribati', code: '+686', flag: '🇰🇮' },
                { name: 'Koweït', code: '+965', flag: '🇰🇼' },
                { name: 'Laos', code: '+856', flag: '🇱🇦' },
                { name: 'Lesotho', code: '+266', flag: '🇱🇸' },
                { name: 'Lettonie', code: '+371', flag: '🇱🇻' },
                { name: 'Liban', code: '+961', flag: '🇱🇧' },
                { name: 'Libéria', code: '+231', flag: '🇱🇷' },
                { name: 'Libye', code: '+218', flag: '🇱🇾' },
                { name: 'Liechtenstein', code: '+423', flag: '🇱🇮' },
                { name: 'Lituanie', code: '+370', flag: '🇱🇹' },
                { name: 'Luxembourg', code: '+352', flag: '🇱🇺' },
                { name: 'Macao', code: '+853', flag: '🇲🇴' },
                { name: 'Macédoine du Nord', code: '+389', flag: '🇲🇰' },
                { name: 'Madagascar', code: '+261', flag: '🇲🇬' },
                { name: 'Malaisie', code: '+60', flag: '🇲🇾' },
                { name: 'Malawi', code: '+265', flag: '🇲🇼' },
                { name: 'Maldives', code: '+960', flag: '🇲🇻' },
                { name: 'Mali', code: '+223', flag: '🇲🇱' },
                { name: 'Malte', code: '+356', flag: '🇲🇹' },
                { name: 'Martinique', code: '+596', flag: '🇲🇶' },
                { name: 'Maurice', code: '+230', flag: '🇲🇺' },
                { name: 'Mauritanie', code: '+222', flag: '🇲🇷' },
                { name: 'Mayotte', code: '+262', flag: '🇾🇹' },
                { name: 'Mexique', code: '+52', flag: '🇲🇽' },
                { name: 'Moldavie', code: '+373', flag: '🇲🇩' },
                { name: 'Monaco', code: '+377', flag: '🇲🇨' },
                { name: 'Mongolie', code: '+976', flag: '🇲🇳' },
                { name: 'Monténégro', code: '+382', flag: '🇲🇪' },
                { name: 'Mozambique', code: '+258', flag: '🇲🇿' },
                { name: 'Namibie', code: '+264', flag: '🇳🇦' },
                { name: 'Nauru', code: '+674', flag: '🇳🇷' },
                { name: 'Népal', code: '+977', flag: '🇳🇵' },
                { name: 'Nicaragua', code: '+505', flag: '🇳🇮' },
                { name: 'Niger', code: '+227', flag: '🇳🇪' },
                { name: 'Nigéria', code: '+234', flag: '🇳🇬' },
                { name: 'Norvège', code: '+47', flag: '🇳🇴' },
                { name: 'Nouvelle-Calédonie', code: '+687', flag: '🇳🇨' },
                { name: 'Nouvelle-Zélande', code: '+64', flag: '🇳🇿' },
                { name: 'Oman', code: '+968', flag: '🇴🇲' },
                { name: 'Ouganda', code: '+256', flag: '🇺🇬' },
                { name: 'Ouzbékistan', code: '+998', flag: '🇺🇿' },
                { name: 'Pakistan', code: '+92', flag: '🇵🇰' },
                { name: 'Palaos', code: '+680', flag: '🇵🇼' },
                { name: 'Palestine', code: '+970', flag: '🇵🇸' },
                { name: 'Panama', code: '+507', flag: '🇵🇦' },
                { name: 'Papouasie-Nouvelle-Guinée', code: '+675', flag: '🇵🇬' },
                { name: 'Paraguay', code: '+595', flag: '🇵🇾' },
                { name: 'Pays-Bas', code: '+31', flag: '🇳🇱' },
                { name: 'Pérou', code: '+51', flag: '🇵🇪' },
                { name: 'Philippines', code: '+63', flag: '🇵🇭' },
                { name: 'Pologne', code: '+48', flag: '🇵🇱' },
                { name: 'Polynésie française', code: '+689', flag: '🇵🇫' },
                { name: 'Portugal', code: '+351', flag: '🇵🇹' },
                { name: 'Qatar', code: '+974', flag: '🇶🇦' },
                { name: 'République centrafricaine', code: '+236', flag: '🇨🇫' },
                { name: 'République dominicaine', code: '+1809', flag: '🇩🇴' },
                { name: 'République tchèque', code: '+420', flag: '🇨🇿' },
                { name: 'Réunion', code: '+262', flag: '🇷🇪' },
                { name: 'Roumanie', code: '+40', flag: '🇷🇴' },
                { name: 'Royaume-Uni', code: '+44', flag: '🇬🇧' },
                { name: 'Russie', code: '+7', flag: '🇷🇺' },
                { name: 'Rwanda', code: '+250', flag: '🇷🇼' },
                { name: 'Saint-Marin', code: '+378', flag: '🇸🇲' },
                { name: 'Salvador', code: '+503', flag: '🇸🇻' },
                { name: 'Samoa', code: '+685', flag: '🇼🇸' },
                { name: 'Sénégal', code: '+221', flag: '🇸🇳' },
                { name: 'Serbie', code: '+381', flag: '🇷🇸' },
                { name: 'Seychelles', code: '+248', flag: '🇸🇨' },
                { name: 'Sierra Leone', code: '+232', flag: '🇸🇱' },
                { name: 'Singapour', code: '+65', flag: '🇸🇬' },
                { name: 'Slovaquie', code: '+421', flag: '🇸🇰' },
                { name: 'Slovénie', code: '+386', flag: '🇸🇮' },
                { name: 'Somalie', code: '+252', flag: '🇸🇴' },
                { name: 'Soudan', code: '+249', flag: '🇸🇩' },
                { name: 'Soudan du Sud', code: '+211', flag: '🇸🇸' },
                { name: 'Sri Lanka', code: '+94', flag: '🇱🇰' },
                { name: 'Suède', code: '+46', flag: '🇸🇪' },
                { name: 'Suisse', code: '+41', flag: '🇨🇭' },
                { name: 'Suriname', code: '+597', flag: '🇸🇷' },
                { name: 'Syrie', code: '+963', flag: '🇸🇾' },
                { name: 'Tadjikistan', code: '+992', flag: '🇹🇯' },
                { name: 'Taïwan', code: '+886', flag: '🇹🇼' },
                { name: 'Tanzanie', code: '+255', flag: '🇹🇿' },
                { name: 'Tchad', code: '+235', flag: '🇹🇩' },
                { name: 'Thaïlande', code: '+6 Thai', flag: '🇹🇭' },
                { name: 'Timor oriental', code: '+670', flag: '🇹🇱' },
                { name: 'Togo', code: '+228', flag: '🇹🇬' },
                { name: 'Tonga', code: '+676', flag: '🇹🇴' },
                { name: 'Trinité-et-Tobago', code: '+1868', flag: '🇹🇹' },
                { name: 'Tunisie', code: '+216', flag: '🇹🇳' },
                { name: 'Turkménistan', code: '+993', flag: '🇹🇲' },
                { name: 'Turquie', code: '+90', flag: '🇹🇷' },
                { name: 'Tuvalu', code: '+688', flag: '🇹🇻' },
                { name: 'Ukraine', code: '+380', flag: '🇺🇦' },
                { name: 'Uruguay', code: '+598', flag: '🇺🇾' },
                { name: 'Vanuatu', code: '+678', flag: '🇻🇺' },
                { name: 'Venezuela', code: '+58', flag: '🇻🇪' },
                { name: 'Vietnam', code: '+84', flag: '🇻🇳' },
                { name: 'Yémen', code: '+967', flag: '🇾🇪' },
                { name: 'Zambie', code: '+260', flag: '🇿🇲' },
                { name: 'Zimbabwe', code: '+263', flag: '🇿🇼' }
            ],
            get filteredCountries() {
                if (this.search === '') return this.allCountries;
                return this.allCountries.filter(c =>
                    c.name.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").includes(this.search.toLowerCase()) ||
                    c.code.includes(this.search)
                );
            },
            selectCountry(country) {
                this.selected = country;
                this.open = false;
                this.search = '';
            }
        }
    }

    // Logique d'importation
    document.addEventListener('DOMContentLoaded', function() {
        const bulkBtn = document.getElementById('bulk-import-btn');
        const container = document.getElementById('bulk-container');
        if ('contacts' in navigator && 'ContactsManager' in window) {
            container.classList.remove('hidden');
            bulkBtn.addEventListener('click', async () => {
                try {
                    const selectedContacts = await navigator.contacts.select(['name', 'tel'], { multiple: true });
                    if (selectedContacts.length > 0) {
                        const formatted = selectedContacts.map(c => ({
                            name: c.name && c.name.length > 0 ? c.name[0] : 'Contact VCF',
                            tel: c.tel && c.tel.length > 0 ? c.tel[0] : ''
                        })).filter(c => c.tel !== '');
                        fetch("{{ route('public.bulk', $link->slug) }}", {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: JSON.stringify({ contacts: formatted })
                        }).then(res => res.json()).then(data => { if(data.success) window.location.reload(); });
                    }
                } catch (err) { console.log(err); }
            });
        }
    });
</script>
</body>
</html>
