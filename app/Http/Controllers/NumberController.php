<?php

namespace App\Http\Controllers;

use App\Http\Resources\NumberResource;
use App\Models\Number;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NumberController extends Controller
{


    public function generate(Request $request)
    {
        $randomNumber = rand(1, 1000000000);
        $number = Number::create([
            'value'=>$randomNumber
        ]);

        return (new NumberResource($number))->response()->setStatusCode(201);
    }

    public function retrieve(string $id)
    {
        $number = Number::find($id);
        if(!$number) {
            return response([
                'error'=> 'Not found'
            ], 404);
        }
        return new NumberResource($number);
    }

}
