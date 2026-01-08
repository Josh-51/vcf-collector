<?php

namespace App\Http\Controllers;

use App\Models\CollectionLink;
use App\Models\Contact;
use Illuminate\Http\Request;
use JeroenDesloovere\VCard\VCard;

class PublicLinkController extends Controller
{
    public function show($slug)
    {
        $link = CollectionLink::where('slug', $slug)->withCount('contacts')->firstOrFail();
        return view('public.form', compact('link'));
    }

    public function submit(Request $request, $slug)
    {
        $link = CollectionLink::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'country_code' => 'required',
            'phone' => 'required|string',
        ]);

        // Préparation du nom avec Suffixe si défini
        $finalName = trim($request->name);
        if ($link->suffix) {
            $finalName .= ' ' . trim($link->suffix);
        }

        // Nettoyage et fusion de l'indicatif + numéro
        $purePhone = ltrim(preg_replace('/[^0-9]/', '', $request->phone), '0');
        $cleanPhone = $request->country_code . $purePhone;

        $exists = $link->contacts()->where('phone', $cleanPhone)->exists();
        if($exists) {
            return back()->with('error', 'Ce numéro est déjà inscrit.');
        }

        $link->contacts()->create([
            'name' => $finalName,
            'phone' => $cleanPhone
        ]);

        return back()->with('success', 'Vos données ont été injectées avec succès.');
    }

    public function bulkSubmit(Request $request, $slug)
    {
        $link = CollectionLink::where('slug', $slug)->firstOrFail();
        $contacts = $request->input('contacts');
        $count = 0;

        foreach ($contacts as $contact) {
            $phone = preg_replace('/[^0-9+]/', '', $contact['tel']);

            // Préparation du nom avec Suffixe pour le bulk aussi
            $bulkName = trim($contact['name'] ?? 'Contact VCF');
            if ($link->suffix) {
                $bulkName .= ' ' . trim($link->suffix);
            }

            if (!empty($phone)) {
                $link->contacts()->firstOrCreate(
                    ['phone' => $phone],
                    ['name' => $bulkName]
                );
                $count++;
            }
        }

        return response()->json(['success' => true, 'count' => $count]);
    }

    public function export($slug)
    {
        $link = CollectionLink::where('slug', $slug)->with('contacts')->firstOrFail();

        $isCreator = auth()->check() && auth()->id() == $link->user_id;
        if (!$link->is_download_public && !$isCreator) {
            abort(403, 'Accès restreint à l\'administrateur.');
        }

        $allVcards = "";
        foreach ($link->contacts as $contact) {
            $vcard = new VCard();
            $vcard->addName($contact->name);
            $vcard->addPhoneNumber($contact->phone, 'CELL');
            $allVcards .= $vcard->buildVCard();
        }

        return response($allVcards, 200, [
            'Content-Type' => 'text/vcard',
            'Content-Disposition' => 'attachment; filename="contacts-'.$link->slug.'.vcf"',
        ]);
    }
}
