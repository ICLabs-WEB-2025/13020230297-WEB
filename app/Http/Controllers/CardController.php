<?php

namespace App\Http\Controllers;

use App\Models\MembershipCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CardController extends Controller
{
    public function show()
    {
        return redirect()->route('dashboard');
    }

    public function print($id)
    {
        $card = MembershipCard::findOrFail($id);

        if ($card->name !== Auth::user()->name) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke kartu ini');
        }

        $html = View::make('cards.print', [
            'card' => $card,
            'user' => Auth::user()
        ])->render();

        return response($html)
            ->header('Content-Type', 'text/html');
    }

    public function download($id)
    {
        $card = MembershipCard::findOrFail($id);

        if ($card->name !== Auth::user()->name) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke kartu ini');
        }

        // Render view yang akan menangani download di sisi client
        return view('cards.download', [
            'card' => $card,
            'user' => Auth::user()
        ]);
    }
}
