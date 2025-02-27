<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AraEvaluation;

class AraEvaluationController extends Controller
{
    public function update(Request $request)
    {

        $evaluationsData = $request->input('evaluations', []);

        if (empty($evaluationsData)) {
            return redirect()->back()->withErrors(['evaluations' => 'Tidak ada nilai yang dimasukkan.']);
        }

        foreach ($evaluationsData as $alternativeId => $criteriaValues) {
            foreach ($criteriaValues as $criteriaId => $value) {
                $evaluation = AraEvaluation::firstOrNew([
                    'id_alternative' => $alternativeId,
                    'id_criteria' => $criteriaId,
                ]);

                $evaluation->value = $value;
                $evaluation->save();
            }
        }

        return redirect()->back()->with('success', 'Nilai Evaluasi Berhasil Diubah');
    }
}