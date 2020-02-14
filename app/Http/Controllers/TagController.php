<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class TagController extends Controller
{
    public function datatable(){
        return datatables(Tag::with(['journals'])->get())->toJson();
    }

    public function index()
    {
        return view('tag.index');
    }

    public function edit($id)
    {
        $tag= Tag::with('journals')->findOrFail($id);
        return view('tag.edit', compact(['tag']));
    }


    public function destroy(Request $request, $id)
    {
        Tag::destroy($id);
        
        $request->session()->flash('success', 'Etiket başarılı bir şekilde silindi.');
        
        return response()->json(true);
   
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:tags,name,'.$id.',id,deleted_at,NULL|min:2'
        ],
        [
            'name.required' => 'Etiket ismi zorunludur.',
            'name.min' => 'Etiket ismi en az 2 karakter olmak zorundadır.',
            'name.unique' => 'Bu isimle daha önce bir etiket kayıt edilmiş.'
        ]);

        $tag = Tag::findOrFail($id);

        $tag->update($request->all());

        return redirect()->route('tags.index')->withSuccess('Etiket başarılı bir şekilde güncellendi.');
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,deleted_at,NULL|min:2'
        ],
        [
            'name.required' => 'Etiket ismi zorunludur.',
            'name.min' => 'Etiket ismi en az 2 karakter olmak zorundadır.',
            'name.unique' => 'Bu isimle daha önce bir etiket kayıt edilmiş.'
        ]);
    
        $tag=Tag::create($request->all());

        return redirect()->route('tags.index')->withSuccess('Etiket başarılı bir şekilde kaydedildi.');
    }
}
