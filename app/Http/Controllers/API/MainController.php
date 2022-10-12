<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //first problem
    public function printResult(Request $request)
    {
        $request->validate([
            'start' => 'required|integer',
            'end' => 'required|integer',
        ]);
        $range = ($request->end - $request->start) + 1;
        $result = $range - round($range / 10);

        return JsonResponse::json('ok', ['data' => $result]);
    }


    //three problem
    public function printNumberOfString(Request $request)
    {
        $request->validate([
            'char' => 'required|min:1|max:3',

        ]);

        $alphabetic = array(
            1 => 'A',
            2 => 'B',
            3 => 'C',
            4 => 'D',
            5 => 'E',
            6 => 'F',
            7 => 'G',
            8 => 'H',
            9 => 'I',
            10 => 'J',
            11 => 'K',
            12 => 'L',
            13 => 'M',
            14 => 'N',
            15 => 'O',
            16 => 'P',
            17 => 'Q',
            18 => 'R',
            19 => 'S',
            20 => 'T',
            21 => 'U',
            22 => 'V',
            23 => 'W',
            24 => 'X',
            25 => 'Y',
            26 => 'Z',
        );

        if (strlen($request->char) == 1) {
            $result = array_search($request->char, $alphabetic);

        } else if (strlen($request->char) == 2) {

            $result = array_search($request->char[0], $alphabetic) * 26 + array_search($request->char[1], $alphabetic);
        } else {
            $result = array_search($request->char[0], $alphabetic) * 26 * 26 + array_search($request->char[1], $alphabetic) * 26 + array_search($request->char[2], $alphabetic);

        }

        return JsonResponse::json('ok', ['data' => $result]);

    }

}
