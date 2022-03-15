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
                if ($data->attribute == 'benefit') {
                    // jika attributnya benefit, cari data max lalu nilai/max
                    $max = DB::table('alternative_criteria')->where('criteria_id', $data->id)->max('value');
                    $normalize = $data->pivot->value/$max;
                    $alternative->criteria()->updateExistingPivot($data->id, [
                        'normalize' => $normalize
                    ]);
                } else {
                    // jika attributnya cost, cari dara min lalu min/value
                    $min = DB::table('alternative_criteria')->where('criteria_id', $data->id)->min('value');
                    $normalize = $min/$data->pivot->value;
                    $alternative->criteria()->updateExistingPivot($data->id, [
                        'normalize' => $normalize
                    ]);
                }
            }
        }

        // tahap pembobotan
        // untuk membantu saat menentukan ranking, kita ubah dulu nilai yang sudah di normalisasi tadi.
        $arr = [];
        $i = 0;
        foreach ($alternatives as $alternative) {
            foreach ($alternative->criteria as $data) {
                $criteria = Criteria::find($data->id);

                // data normalisasi * bentuk normalisasi dari bobot kriteria
                // rumus cari bentuk normal dari keriteria adalah bobot kriteria / sigma bobot kriteria.
                $bobot = $data->pivot->normalize * ($criteria->weight / $criteria->sum('weight'));

                $arr[$alternative->name][$i] = $bobot;

                $i++;
            }
        }

        // tahap perangkingan
        // setelah mendapat nilai bobotnya, makaa kita jumlahkan bobot tiap alternatif
        $rank = [];

        foreach ($arr as $key => $value) {
           $data = array_sum($arr[$key]);
           $rank[$key] = $data; 
        }

        // kita urutkan dari yang terbesar ygy
        $rank = collect($rank)->sortDesc();


        return view('pages.calculate.result', [
            'alternatives' => $alternatives,
            'criterias' => $criterias,
            'rank' => $rank
        ]);
        
        
    }


}
