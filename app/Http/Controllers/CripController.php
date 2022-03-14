<?php

namespace App\Http\Controllers;

use App\Models\Crip;
use App\Models\Criteria;
use Illuminate\Http\Request;

class CripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $criterias = Criteria::all();

        return view('pages.crips.index', [
            'criterias' => $criterias
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $criteria = Criteria::find($id);

        return view('pages.crips.create', [
            'criteria' => $criteria
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if ($request->crips) {
            foreach ($request->crips as $key => $value) {
                Crip::create([
                    'criteria_id' => $id,
                    'note' => $value,
                    'value' => $request->value[$key]
                ]);
            }
        }

        return redirect()->route('crips.index', $id)->with('success', 'Data Berhasil Ditambahkan');;
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
        $crip = Crip::find($id);

        return view('pages.crips.edit', [
            'crip' => $crip
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
            'note' => 'required',
            'value' => 'required'
        ]);

        $crip = Crip::find($id);
        $crip->note = $request->note;
        $crip->value = $request->value;
        $crip->save();

        return redirect()->route('crips.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Crip::destroy($id);
        return redirect()->route('crips.index')->with('success', 'Data Berhasil Dihapus');
    }
}
