<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CollectionLink;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
        // Récupère tous les liens avec le nom du créateur et le nombre de contacts
        $links = CollectionLink::with('user')->withCount('contacts')->orderBy('created_at', 'desc')->get();

        $stats = [
            'total_users' => User::count(),
            'total_links' => CollectionLink::count(),
            'total_contacts' => \App\Models\Contact::count(),
        ];

        return view('admin.index', compact('links', 'stats'));
    }
}
