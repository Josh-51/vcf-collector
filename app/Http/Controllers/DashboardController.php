<?php

namespace App\Http\Controllers;

use App\Models\CollectionLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index() {
        $links = auth()->user()->collectionLinks()->withCount('contacts')->get();
        return view('dashboard', compact('links'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'target_count' => 'required|integer|min:1'
        ]);

        auth()->user()->collectionLinks()->create([
            'title' => $request->title,
            'target_count' => $request->target_count,
            'slug' => Str::slug($request->title) . '-' . Str::random(5)
        ]);

        return back()->with('success', 'Lien créé !');
    }
}
