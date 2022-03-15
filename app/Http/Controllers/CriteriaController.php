<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
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
        $criterias = Criteria::all();
        $total = 0;

        foreach ($criterias as $key => $value) {
            $total += $value->criteriaNormalize();
        }

        return view('pages.criteria.index', [
            'criterias' => $criterias,
            'total' => Criteria::sum('weight'),
            'normalTotal' => $total
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.criteria.create');
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
            'code' => 'required|unique:criterias,code',
            'name' => 'required|unique:criterias,name',
            'weight' => 'required',
            'attribute' => 'required'
        ]);

        Criteria::create($data);

        return redirect()->route('criteria.index')->with('success', 'Data Berhasil Ditambahkan');
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
        $criteria = Criteria::find($id);
        return view('pages.criteria.edit', [
            'criteria' => $criteria
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
            'name' => 'required|unique:criterias,name,'.$id,
            'code' => 'required|unique:criterias,code,'.$id,
            'weight' => 'required',
            'attribute' => 'required'
        ]);

        $criteria = Criteria::find($id);
        $criteria->code = $request->code;
        $criteria->name = $request->name;
        $criteria->weight = $request->weight;
        $criteria->attribute = $request->attribute;

        $criteria->save();
        return redirect()->route('criteria.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Criteria::destroy($id);
        return redirect()->route('criteria.index')->with('success', 'Data Berhasil Dihapus');
    }
}
