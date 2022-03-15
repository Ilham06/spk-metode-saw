<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalculateController extends Controller
{
    /**
     * [Menampilkan Tabel Nilai]
     * @return [type] [description]
     */
    public function index()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();

        return view('pages.calculate.index', [
            'criterias' => $criterias,
            'alternatives' => $alternatives
        ]);
    }

    public function edit($id)
    {
        $criterias = Criteria::all();
        $alternative = Alternative::find($id);
        
        return view('pages.calculate.edit', [
            'criterias' => $criterias, 
            'alternative' => $alternative
        ]);
    }

    /**
     * [Insert Data ke tabel Pivot]
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        $alternative = Alternative::find($id);
        
        foreach ($request->criteria as $key => $criteria) {
            $data = explode('?', $criteria);
            $value = (int) $data[0];
            $crip = $data[1];
            if ($alternative->criteria()->where('criteria_id', $key)->exists()) {
                $alternative->criteria()->updateExistingPivot($key, [
                    'value' => $value,
                    'crip' => $crip
                ]);
            } else {
                $alternative->criteria()->attach($key, [
                    'value' => $value,
                    'crip' => $crip
                ]); 
            }  
        }

        return redirect()->route('calculate.index')->with('success', 'Data Berhasil di Tambahkan');
    }

    /**
     * [melakukan proses perhitungan]
     * @return [type] [description]
     */
    public function proses()
    {
        $alternatives = Alternative::all();
        $criterias = Criteria::all();

        // cari data normalisasi dan update ke db
        foreach ($alternatives as $alternative) {
            foreach ($alternative->criteria as $data) {
                $criteria = Criteria::find($data->id);
                if ($data->attribute == 'benefit') {
                    // jika attributnya benefit, cari data max lalu nilai/max
                    $max = DB::table('alternative_criteria')->where('criteria_id', $data->id)->max('value');
                    $normalize = $data->pivot->value/$max;
                    $bobot = $normalize * ($criteria->weight / $criteria->sum('weight'));
                    $alternative->criteria()->updateExistingPivot($data->id, [
                        'normalize' => $normalize,
                        'weighting' => $bobot
                    ]);
                } else {
                    // jika attributnya cost, cari data min lalu min/value
                    $min = DB::table('alternative_criteria')->where('criteria_id', $data->id)->min('value');
                    $normalize = $min/$data->pivot->value;
                    $bobot = $normalize * ($criteria->weight / $criteria->sum('weight'));
                    $alternative->criteria()->updateExistingPivot($data->id, [
                        'normalize' => $normalize,
                        'weighting' => $bobot
                    ]);
                }

                // $criteria = Criteria::find($data->id);
                // $bobot = $data->pivot->normalize * ($criteria->weight / $criteria->sum('weight'));
                // $alternative->criteria()->updateExistingPivot($data->id, [
                //         'weighting' => $bobot
                //     ]);
            }

            // $sum = DB::table('alternative_criteria')->where('alternative_id', $alternative->id)->sum('weighting');

            // if ($alternative->rank()->where('alternative_id', $alternative->id)->exists()) {
            //     $rank = Rank::where('alternative_id', $alternative->id)->first();
            //     $rank->total = $sum;
            //     $rank->save();
            // } else {
            //     Rank::updateOrCreate([
            //         'alternative_id' => $alternative->id,
            //         'total' => $sum
            //     ]);
            // }

            
        }

        $rank = Rank::orderBy('total', 'desc')->get();

        $alt = Alternative::orderBy('created_at', 'asc')->get();

        return view('pages.calculate.result', [
            'alternatives' => $alt,
            'criterias' => $criterias,
            'rank' => $rank
        ]);
        
        
    }


}
