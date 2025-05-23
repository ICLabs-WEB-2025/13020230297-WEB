<?php

namespace App\Http\Controllers;

use App\Models\MembershipCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class MembershipCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cards = MembershipCard::where('name', Auth::user()->name)->get();
        return view('admin.membership_cards.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.membership_cards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'membership_number' => 'required|string|unique:membership_cards,membership_number',
        ]);

        MembershipCard::create([
            'name' => Auth::user()->name,
            'joining_date' => $request->joining_date,
            'expiry_date' => $request->expiry_date,
            'membership_number' => $request->membership_number,
        ]);

        return redirect()->route('dashboard')->with('success', 'Membership card created successfully!');
    }

    public function show($id)
    {
        $card = MembershipCard::findOrFail($id);
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        return view('admin.membership_cards.show', compact('card'));
    }

    public function edit($id)
    {
        $card = MembershipCard::findOrFail($id);
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        return view('admin.membership_cards.edit', compact('card'));
    }

    public function update(Request $request, $id)
    {
        $card = MembershipCard::findOrFail($id);
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'membership_number' => 'required|string|unique:membership_cards,membership_number,' . $card->id,
        ]);

        $card->update([
            'name' => Auth::user()->name,
            'joining_date' => $request->joining_date,
            'expiry_date' => $request->expiry_date,
            'membership_number' => $request->membership_number,
        ]);

        return redirect()->route('dashboard')->with('success', 'Membership card updated successfully!');
    }

    public function destroy($id)
    {
        $card = MembershipCard::findOrFail($id);
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }
        $card->delete();
        return redirect()->route('dashboard')->with('success', 'Membership card deleted successfully!');
    }

    /**
     * Generate dan print kartu member berdasarkan data membership card
     */
    public function generateCard($id)
    {
        $card = MembershipCard::findOrFail($id);

        // Cek kepemilikan kartu
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Render view untuk print kartu
        $html = View::make('cards.print', [
            'card' => $card,
            'user' => Auth::user()
        ])->render();

        return response($html)
            ->header('Content-Type', 'text/html');
    }

    /**
     * Download kartu sebagai PDF/HTML
     */
    public function downloadCard($id)
    {
        $card = MembershipCard::findOrFail($id);

        // Cek kepemilikan kartu
        if ($card->name !== Auth::user()->name) {
            return redirect()->route('dashboard')->with('error', 'Unauthorized access.');
        }

        // Render view untuk download
        $html = View::make('cards.print', [
            'card' => $card,
            'user' => Auth::user()
        ])->render();

        $headers = [
            'Content-Type' => 'text/html',
            'Content-Disposition' => 'attachment; filename="member_card_' . $card->membership_number . '.html"'
        ];

        return Response::make($html, 200, $headers);
    }
}
