<?php

namespace App\Http\Controllers;

use App\immagineuploadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class ImmagineuploadataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $immagine = DB::table('immagineuploadatas')->paginate(15);;
        // $ciao = auth()->user();
        // $ciao = Auth::user()->name;
        return view ('immagineuploadata.index', array(
            'immagine' => $immagine
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('immagineuploadata.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $validatedData = $request->validate([
            'nomeimmagine' => 'required|mimetypes:image/jpeg,image/png,image/gif|max:5000|min:1',
            'descrizione' => 'required',
        ]);

        // storing file
        
        // STREAM METHOD (NEED TO CHANGE PHP.INI)
        // $path2 = Storage::put('teststream', $path);
        // $path = $request->file('nomeimmagine');

        $path = $request->file('nomeimmagine')->storeAs(
            'public/immagini', $request->file('nomeimmagine')->getClientOriginalName().'.'.time()
        );

        $immagine = new immagineuploadata;

        $immagine->descrizione = $request->descrizione;
        $immagine->nomeimmagine = $request->file('nomeimmagine')->getClientOriginalName().'.'.time();

        $immagine->save();

        return redirect('/immagineuploadata')->with('status', 'Immagine Aggiunta!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\immagineuploadata  $immagineuploadata
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $singolo = immagineuploadata::findOrFail($id);
        return view ('immagineuploadata.show', array(
            'immagine' => $singolo
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\immagineuploadata  $immagineuploadata
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\immagineuploadata  $immagineuploadata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nomeimmagine' => 'required|mimetypes:image/jpeg,image/png,image/gif|max:5000|min:1',
            'descrizione' => 'required',
        ]);
        
        //store file
        $path = $request->file('nomeimmagine')->storeAs(
            'public/immagini', $request->file('nomeimmagine')->getClientOriginalName().'.'.time()
        );


        $immagine = immagineuploadata::findOrFail($id);

        $immagine->descrizione = $request->descrizione;
        $immagine->nomeimmagine = $request->file('nomeimmagine')->getClientOriginalName().'.'.time();
        $immagine->save();

        return redirect('/immagineuploadata')->with('status', 'Campi Aggiornati!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\immagineuploadata  $immagineuploadata
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        immagineuploadata::findOrFail($id)->delete();

        return redirect('/immagineuploadata')->with('status-delete', 'Elemento Eliminato');
    }

    public function testafterregistr () 
    {
        return redirect('/immagineuploadata')->with('status-delete', 'Elemento Eliminato');
    }
}
