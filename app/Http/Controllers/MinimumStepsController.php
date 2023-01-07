<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MinimumStepsController extends Controller
{
    public function minimumSteps(Request $request)
    {

        $N = $request->input('N');
        $Q = $request->input('Q');


        $result = $this->performDFS($Q);

        return response()->json(['result' => $result]);
    }


    private function performDFS($Q)
    {
        $result = [];
        foreach ($Q as $x) {
            $result[] = $this->dfs($x);
        }
        return $result;
    }

    private function dfs($x)
    {
        if ($x == 0) {
            return 0;
        }
        $minSteps = PHP_INT_MAX;

        for ($i = 2; $i <= sqrt($x); $i++) {

            if ($x % $i == 0) {
                $minSteps = min($minSteps, $this->dfs(max($i, $x/$i)) + 1);
            }
        }

        $minSteps = min($minSteps, $this->dfs($x-1) + 1);
        return $minSteps;
    }
}
