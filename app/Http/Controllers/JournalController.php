<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Journal;
use App\Tag;
use App\Contact;
use App\State;


class JournalController extends Controller
{
    public function datatable(){
        return datatables(Journal::with(['tags', 'contacts', 'state', 'city'])->get())->toJson();
    }

    public function index()
    {
        return view('journal.index');
    }

    public function edit($id)
    {
        $journal= Journal::with(['tags', 'contacts', 'state', 'city'])->findOrFail($id);
        $states = State::all()->makeHidden(['created_at', 'updated_at']);
        $tags = Tag::all()->makeHidden(['created_at', 'updated_at']);
        $contacts = Contact::all()->makeHidden(['created_at', 'updated_at']);
        return view('journal.edit', compact(['journal', 'states', 'tags', 'contacts']));
    }


    public function destroy(Request $request, $id)
    {
        Journal::destroy($id);
        
        $request->session()->flash('success', 'Günlük başarılı bir şekilde silindi.');
        
        return response()->json(true);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:2',
            'state_id' => 'numeric',
            'city_id' => 'numeric'
        ],
        [
            'title.required' => 'Günlük başlığı zorunludur.',
            'title.min' => 'Günlük başlığı en az 2 karakter olmak zorundadır.',
            'state_id.numeric' => 'Lütfen geçerli bir il seçiniz.',
            'city_id.numeric' => 'Lütfen geçerli bir ilçe seçiniz.'
        ]);

        $journal = Journal::findOrFail($id);

        $journal->update($request->except('tags', 'contacts'));

        if(!empty($request->tags))
        {
            $journal->tags()->sync( array_keys($request->tags) );
        } else {
            $journal->tags()->detach();
        }

        if(!empty($request->contacts))
        {
            $journal->contacts()->sync( array_keys($request->contacts) );
        } else {
            $journal->contacts()->detach();
        }

        return redirect()->route('journals.index')->withSuccess('Günlük başarılı bir şekilde güncellendi.');
    }

    public function create()
    {
        $states = State::all()->makeHidden(['created_at', 'updated_at']);
        $tags = Tag::all()->makeHidden(['created_at', 'updated_at']);
        $contacts = Contact::all()->makeHidden(['created_at', 'updated_at']);
        return view('journal.create', compact(['states', 'tags', 'contacts']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2',
            'state_id' => 'numeric',
            'city_id' => 'numeric'
        ],
        [
            'title.required' => 'Günlük başlığı zorunludur.',
            'title.min' => 'Günlük başlığı en az 2 karakter olmak zorundadır.',
            'state_id.numeric' => 'Lütfen geçerli bir il seçiniz.',
            'city_id.numeric' => 'Lütfen geçerli bir ilçe seçiniz.'
        ]);
    
        $journal = Journal::create($request->except('tags', 'contacts'));

        if(!empty($request->tags))
        {
            foreach ($request->tags as $tag => $value) 
            {
                DB::table('journal_has_tags')->insert([
                    'journal_id' => $journal->id,
                    'tag_id' => $tag,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                  ]);
            }
        }

        if(!empty($request->contacts))
        {
            foreach ($request->contacts as $contact => $value) 
            {
                DB::table('journal_has_contacts')->insert([
                    'journal_id' => $journal->id,
                    'contact_id' => $contact,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                  ]);
            }
        }

        return redirect()->route('journals.index')->withSuccess('Günlük başarılı bir şekilde kaydedildi.');
    }
}
