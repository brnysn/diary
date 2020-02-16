<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function datatable(){
        return datatables(Contact::all())->toJson();
    }

    public function index()
    {
        return view('contact.index');
    }

    public function edit($id)
    {
        $contact= Contact::findOrFail($id);
        return view('contact.edit', compact(['contact']));
    }


    public function destroy(Request $request, $id)
    {
        Contact::destroy($id);
        
        $request->session()->flash('success', 'Kişi başarılı bir şekilde silindi.');
        
        return response()->json(true);
   
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
        ],
        [
            'firstname.required' => 'Kişi ismi zorunludur.',
            'firstname.min' => 'Kişi ismi en az 2 karakter olmak zorundadır.',
            'lastname.required' => 'Kişi soyismi zorunludur.',
            'lastname.min' => 'Kişi soyismi en az 2 karakter olmak zorundadır.',
        ]);

        $contact = Contact::findOrFail($id);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->withSuccess('Kişi başarılı bir şekilde güncellendi.');
    }

    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
        ],
        [
            'firstname.required' => 'Kişi ismi zorunludur.',
            'firstname.min' => 'Kişi ismi en az 2 karakter olmak zorundadır.',
            'lastname.required' => 'Kişi soyismi zorunludur.',
            'lastname.min' => 'Kişi soyismi en az 2 karakter olmak zorundadır.',
        ]);
    
        Contact::create($request->all());

        return redirect()->route('contacts.index')->withSuccess('Kişi başarılı bir şekilde kaydedildi.');
    }
}
