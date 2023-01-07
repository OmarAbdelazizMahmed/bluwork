<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NumberCountController extends Controller
{
    public function count(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        $count = 0;
        for ($i = $start; $i <= $end; $i++) {

            $num = abs($i);
            while ($num > 0) {
                if ($num % 10 == 5) {
                    $count++;
                    break;
                }
                $num = (int) ($num / 10);
            }
        }

        return response()->json([
            'count' => $count,
        ]);
    }

}
