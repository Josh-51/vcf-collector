<?php

namespace App\Http\Controllers;

use App\Models\CollectionLink;
use App\Models\Contact;
use Illuminate\Http\Request;
use JeroenDesloovere\VCard\VCard;

class PublicLinkController extends Controller
{
    // Afficher le formulaire
    public function show($slug) {
        $link = CollectionLink::where('slug', $slug)->withCount('contacts')->firstOrFail();
        return view('public.form', compact('link'));
    }

    // Enregistrer un contact
    public function submit(Request $request, $slug) {
        $link = CollectionLink::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:contacts,phone,NULL,id,collection_link_id,' . $link->id,
        ]);

        $link->contacts()->create($request->only('name', 'phone'));

        return back()->with('success', 'Numéro enregistré avec succès !');
    }

    // Export VCF (Visible si le nombre est atteint)
    public function export($slug)
    {
        $link = CollectionLink::where('slug', $slug)->with('contacts')->firstOrFail();

        // Vérifier si le quota est atteint
        if ($link->contacts->count() < $link->target_count) {
            return back()->with('error', 'Le quota n\'est pas encore atteint.');
        }

        $allVcards = ""; // Variable qui va stocker tous les contacts

        foreach ($link->contacts as $contact) {
            // On crée un NOUVEL objet VCard pour CHAQUE contact
            $vcard = new VCard();

            // On ajoute les infos
            $vcard->addName($contact->name);
            $vcard->addPhoneNumber($contact->phone, 'CELL');

            // On extrait le contenu texte de ce contact et on l'ajoute à la suite
            // buildVCard() génère le format "BEGIN:VCARD...END:VCARD"
            $allVcards .= $vcard->buildVCard();
        }

        // On renvoie le gros fichier texte contenant tous les contacts
        return response($allVcards, 200, [
            'Content-Type' => 'text/vcard',
            'Content-Disposition' => 'attachment; filename="contacts-'.$link->slug.'.vcf"',
        ]);
    }
}
