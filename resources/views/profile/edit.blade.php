<x-app-layout>
    <div class="min-h-screen pt-40 pb-20 px-6 lg:px-12">

        <div class="max-w-4xl mx-auto">
            <!-- HEADER CINÉMATIQUE -->
            <header class="mb-20">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-white/10 bg-white/5 mb-6">
                    <span class="text-[9px] font-mono uppercase tracking-[0.3em] text-white/40 font-bold italic tracking-widest">System Configuration</span>
                </div>
                <h1 class="text-7xl font-black tracking-tighter uppercase italic leading-none mb-4">Agent<br>Profile</h1>
                <p class="font-mono text-[10px] uppercase tracking-widest text-white/20 italic">Gestion des accès et protocoles de sécurité</p>
            </header>

            <!-- GRILLE DE RÉGLAGES -->
            <div class="space-y-32">

                <!-- SECTION 01 : INFORMATION -->
                <section class="group relative">
                    <div class="absolute -left-12 top-0 text-[10px] font-mono text-white/10 uppercase vertical-text hidden lg:block tracking-[0.5em] font-bold">Protocol — 01</div>
                    <div class="border-t border-white/10 pt-10">
                        <h2 class="text-2xl font-black uppercase italic mb-10 tracking-tight">Identification de l'agent</h2>
                        <div class="max-w-2xl obsidian-form">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </section>

                <!-- SECTION 02 : PASSWORD -->
                <section class="group relative">
                    <div class="absolute -left-12 top-0 text-[10px] font-mono text-white/10 uppercase vertical-text hidden lg:block tracking-[0.5em] font-bold">Security — 02</div>
                    <div class="border-t border-white/10 pt-10">
                        <h2 class="text-2xl font-black uppercase italic mb-10 tracking-tight">Clé d'accès (Password)</h2>
                        <div class="max-w-2xl obsidian-form">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </section>

                <!-- SECTION 03 : DELETE -->
                <section class="group relative opacity-50 hover:opacity-100 transition-opacity">
                    <div class="absolute -left-12 top-0 text-[10px] font-mono text-white/10 uppercase vertical-text hidden lg:block tracking-[0.5em] font-bold">Danger — 03</div>
                    <div class="border-t border-red-500/20 pt-10">
                        <h2 class="text-2xl font-black uppercase italic mb-10 tracking-tight text-red-500">Destruction de l'unité</h2>
                        <div class="max-w-2xl obsidian-form">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <!-- STYLE OVERRIDE POUR LES PARTIALS BREEZE -->
    <style>
        .vertical-text { writing-mode: vertical-rl; transform: rotate(180deg); }

        /* On force le style sur les composants Breeze à l'intérieur */
        .obsidian-form label {
            font-family: 'JetBrains Mono', monospace !important;
            text-transform: uppercase !important;
            font-size: 9px !important;
            letter-spacing: 0.3em !important;
            color: rgba(255,255,255,0.3) !important;
            margin-bottom: 8px !important;
            font-weight: 700 !important;
        }

        .obsidian-form input {
            background: transparent !important;
            border: none !important;
            border-bottom: 1px solid rgba(255,255,255,0.1) !important;
            padding: 12px 0 !important;
            font-size: 1.25rem !important; /* text-xl */
            font-weight: 300 !important;
            color: white !important;
            width: 100% !important;
            border-radius: 0 !important;
            font-style: italic !important;
            transition: all 0.5s ease !important;
        }

        .obsidian-form input:focus {
            outline: none !important;
            box-shadow: none !important;
            border-bottom-color: white !important;
        }

        .obsidian-form button {
            background: white !important;
            color: black !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            font-size: 10px !important;
            letter-spacing: 0.4em !important;
            padding: 16px 32px !important;
            border-radius: 12px !important;
            margin-top: 20px !important;
            transition: all 0.3s ease !important;
        }

        .obsidian-form button:hover {
            background: #6366f1 !important; /* Indigo */
            color: white !important;
        }

        .obsidian-form p {
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 10px !important;
            color: rgba(255,255,255,0.2) !important;
            text-transform: uppercase !important;
            margin-top: 10px !important;
        }

        /* Correction pour les messages d'erreur */
        .obsidian-form .mt-2 {
            color: #ef4444 !important; /* Red */
            font-size: 9px !important;
            font-weight: bold !important;
        }
    </style>
</x-app-layout>
