<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return view('admin.contacts.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'info' => 'required|string|max:255',
        ]);

        Contact::create($request->only('name', 'info'));

        return back()->with('success', 'Контакт добавлен!');
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'info' => 'required|string|max:255',
        ]);

        $contact->update($request->only('name', 'info'));

        return back()->with('success', 'Контакт обновлён!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return back()->with('success', 'Контакт удалён!');
    }
}
