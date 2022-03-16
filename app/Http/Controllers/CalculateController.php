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


        $arrNormalize = []; // array menampung data normalisasi
        $arrWeighting = []; // array menampung data pembomotan
        $i = 0;

        // loop setiap alernatif
        foreach ($alternatives as $alternative) {
            // loop relasinya dengan kriteria
            foreach ($alternative->criteria as $data) {

                $criteria = Criteria::find($data->id);

                if ($data->attribute == 'benefit') {
                    // jika attributnya benefit, cari data max lalu nilai/max
                    $max = DB::table('alternative_criteria')->where('criteria_id', $data->id)->max('value');
                    $normalize = $data->pivot->value/$max; // rumus normalisasi data
                    $arrNormalize[$alternative->name][$i] = round($normalize, 4); //push ke array

                    $bobot = $normalize * ($criteria->weight / $criteria->sum('weight')); //rumus pembobotan data
                    $arrWeighting[$alternative->name][$i] = round($bobot, 4); //push ke array
                } else {
                    // jika attributnya cost, cari data min lalu min/value
                    $min = DB::table('alternative_criteria')->where('criteria_id', $data->id)->min('value');
                    $normalize = $min/$data->pivot->value; // rumus normalisasi data
                    $arrNormalize[$alternative->name][$i] = round($normalize, 4); //push ke array

                    $bobot = $normalize * ($criteria->weight / $criteria->sum('weight')); //rumus pembobotan data
                    $arrWeighting[$alternative->name][$i] = round($bobot, 4); //push ke array
                }

                $i++;
            }
            
        }

        $rank = []; // array menampung rangking

        // loop array pembobotan sebelumnya
        foreach ($arrWeighting as $key => $value) {
            $data = array_sum($arrWeighting[$key]); // jumlahkan setiap alternatifnya
            $rank[$key] = $data; // push ke array rank, nama alternatif sebagai indexnya
        }

        return view('pages.calculate.result', [
            'alternatives' => Alternative::all(),
            'criterias' => $criterias,
            'arrNormalize' => $arrNormalize,
            'rank' => collect($rank)->sortDesc() // sorting dari yang tertinggi
        ]);
        
        
    }


}
