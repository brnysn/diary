<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Image;
use File;

class ContactController extends Controller
{

    private function save_photo($photo, $id){
        $path = public_path().'/uploads/contacts/'.$id;
        if(!File::isDirectory($path)) File::makeDirectory($path, 0775, true, true);

        foreach (['1000','500'] as $width) {
            ($width== '1000') ? $suffix = '1' : $suffix = '1_' . $width ;
            $img = Image::make($photo)->encode('jpg');
            $img->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($path . "/" . $suffix . ".jpg", 100);
        }
        Contact::updateOrCreate(
            ['id' => $id],
            ['photo' => $path."/1.jpg"]
        );
    }

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

        $contact->update($request->except('photo'));

        if ($request->has('photo')) {
            $this->save_photo($request->photo, $contact->id);
        }

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
    
        $contact = Contact::create($request->except('photo'));

        if ($request->has('photo')) {
            $this->save_photo($request->photo, $contact->id);
        }

        return redirect()->route('contacts.index')->withSuccess('Kişi başarılı bir şekilde kaydedildi.');
    }
}
