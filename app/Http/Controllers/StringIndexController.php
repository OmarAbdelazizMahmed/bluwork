<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StringIndexController extends Controller
{
    public function stringIndex(Request $request)
    {
        $inputString = $request->input('input_string');

        $index = 0;
        $chars = str_split($inputString);
        foreach ($chars as $char) {
            $index = $index * 26 + ord($char) - 64;
        }

        return response()->json([
            'index' => $index,
        ]);
    }

}
