<?php

namespace App\Http\Controllers;

use App\immagineuploadata;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

//  For Testing Dependencies
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;


class ImmagineuploadataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // retrieving and paginating the results - must be done on a query builder
        // not on the collection itself. instead of (query)->get()->paginate(x) MUST do (query)->paginate(x)
        $immagine = immagineuploadata::with('user')->paginate(6);
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
        
        // storing the creator of the image (user) into the table

        // TESTING RELATIONSHIPS
        // auth()->user()->immagineuploadata
        // $test = immagineuploadata::find(1);
        // $test = User::find(2);
        // dd($test);   

        // STREAM METHOD (NEED TO CHANGE PHP.INI)
        // $path2 = Storage::put('teststream', $path);
        // $path = $request->file('nomeimmagine');

        $path = $request->file('nomeimmagine')->storeAs(
            'public/immagini', $request->file('nomeimmagine')->getClientOriginalName().'.'.time()
        );

        // crator User name
        $userName = auth()->user()->id;
        // saving the imagedata in the DB
        $immagine = new immagineuploadata;
        $immagine->user_id = $userName;
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
        // $ciao = Input::all();
        $singolo = immagineuploadata::findOrFail($id);
        return view ('immagineuploadata.show', array(
            'immagine' => $singolo,
            // 'test' => $ciao
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

    public function test() {
        
        $user = user::all()->find(1)->immagineuploadata->pluck('descrizione');
        // dd($user);  
        return view('test', compact('user'));
    }
}
