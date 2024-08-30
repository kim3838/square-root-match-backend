<?php

namespace App\Http\Controllers;

use App\Models\Matches;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function getMatch(Request $request)
    {
        $value = $request->input('value');

        if(!is_numeric($value)){
            return response()->json([]);
        }

        $matchesQueryBuilder = Matches::getQuery();
        $matchCache = $matchesQueryBuilder
            ->where('value', $value)
            ->count();

        $combinations = [];

        if($matchCache > 0){
            //Retrieve record of matches if value found on matches
            $combinations = $matchesQueryBuilder->where('value', $value)->get()->map(function($combination){
                return [
                    'value' => $combination->value,
                    'a' => $combination->a,
                    'b' => $combination->b,
                    'c' => $combination->c,
                    'avg' => $combination->avg
                ];
            })->toArray();
        } else {

            //Get match combinations when record not found
            $valueSquareRoot = sqrt($value);

            for ($a = 0; $a <= $valueSquareRoot; $a++) {

                for ($b = $a; $b <= $valueSquareRoot; $b++) {

                    //Add the multiplied a and b by itself and check if match the value
                    $aSquare =($a * $a);
                    $bSquare =($b * $b);

                    if ($aSquare + $bSquare == $value) {

                        $avg = ($a + $b + $valueSquareRoot) / 3;

                        $combinations[] = [
                            'value' => $value,
                            'a' => $a,
                            'b' => $b,
                            'c' => sqrt($value),
                            'avg' => number_format($avg, 2),
                        ];
                    }
                }
            }

            foreach ($combinations as $combination) {

                Matches::create([
                    'value' => $value,
                    'a' => $combination['a'],
                    'b' => $combination['b'],
                    'c' => $combination['c'],
                    'avg' => $combination['avg']
                ]);
            }
        }

        return response()->json($combinations);
    }
}
