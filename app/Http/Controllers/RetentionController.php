<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddRetentionBottleRequest;
use App\Retention;
use App\Box;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RetentionController extends Controller
{

    public function add(AddRetentionBottleRequest $request, $id)
    {
        $bottle = Retention::where('lot_number', $request->lot_number)->first();


        if($bottle != null){
            echo "<script>";
            echo "window.confirm('test')";
            echo "</script>";




        }

            $product_id = substr($request->lot_number, 0, 4);

            $production_date = $request->production_date;

            $expiration_date = Carbon::create($production_date);

            $expiration_date->addYears($request->expiration_length);

            Retention::create([
                'lot_number' => $request->lot_number,
                'product_id' => $product_id,
                'production_date' => $production_date,
                'expiration_date' => $expiration_date,
                'expiration_length' => $request->expiration_length,
                'box_id' => $id,
                'user_id' => auth()->user()->id
            ]);

            session()->flash('success', 'Bottle added!');

            return back();




    }

    public function closed()
    {
        $closed_boxes = Box::where('closed_by', '!=', null)->orderBy('id', 'DESC')->paginate(10);
        return view('boxes.closed')->with('boxes', $closed_boxes);
    }


}
