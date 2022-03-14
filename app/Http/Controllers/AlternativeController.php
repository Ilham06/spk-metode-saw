<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alternatives = Alternative::all();

        return view('pages.alternative.index', [
            'alternatives' => $alternatives
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.alternative.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|unique:alternatives,code',
            'name' => 'required|unique:alternatives,name',
            'note' => 'nullable',
        ]);

        Alternative::create($data);

        return redirect()->route('alternative.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alternative = Alternative::find($id);
        return view('pages.alternative.edit', [
            'alternative' => $alternative
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:alternatives,name,'.$id,
            'code' => 'required|unique:alternatives,code,'.$id,
            'note' => 'nullable',
        ]);

        $alternative = Alternative::find($id);
        $alternative->code = $request->code;
        $alternative->name = $request->name;
        $alternative->note = $request->note;

        $alternative->save();
        return redirect()->route('alternative.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alternative::destroy($id);
        return redirect()->route('alternative.index')->with('success', 'Data Berhasil Dihapus');
    }
}
