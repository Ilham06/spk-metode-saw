<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
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
        
        foreach ($request->criteria as $key => $value) {
            if ($alternative->criteria()->where('criteria_id', $key)->exists()) {
                $alternative->criteria()->updateExistingPivot($key, [
                    'value' => $value
                ]);
            } else {
                $alternative->criteria()->attach($key, [
                    'value' => $value
                ]); 
            }  
        }

        return redirect()->route('calculate.index')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function proses()
    {
        $alternatives = Alternative::all();

        // cari data normalisasi
        foreach ($alternatives as $alternative) {
            foreach ($alternative->criteria as $data) {
                if ($data->attribute == 'benefit') {
                    $max = DB::table('alternative_criteria')->where('criteria_id', $data->id)->max('value');
                    $normalize = $data->pivot->value/$max;
                    $alternative->criteria()->updateExistingPivot($data->id, [
                        'normalize' => $normalize
                    ]);
                } else {
                    $min = DB::table('alternative_criteria')->where('criteria_id', $data->id)->min('value');
                    $normalize = $min/$data->pivot->value;
                    $alternative->criteria()->updateExistingPivot($data->id, [
                        'normalize' => $normalize
                    ]);
                }
            }
        }

        // cari bobot
        
        $arr = [];
        $i = 0;
        foreach ($alternatives as $alternative) {
            foreach ($alternative->criteria as $data) {
                $criteria = Criteria::find($data->id);

                $bobot = $data->pivot->normalize * ($criteria->weight / $criteria->sum('weight'));

                $arr[$data->pivot->alternative_id][$i] = $bobot;

                $i++;
            }
        }

        // cari ranking
        
        $rank = [];

        foreach ($arr as $key => $value) {
           $data = array_sum($arr[$key]);
           $rank[$key] = $data; 
        }



        return view('pages.calculate.result', [
            'alternatives' => $alternatives
        ]);
        
        
    }


}
