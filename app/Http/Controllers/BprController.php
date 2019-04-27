<?php

namespace App\Http\Controllers;

use App\Bpr;
use App\BprProduct;
use App\MprProduct;
use App\Product;
use App\Mpr;
use Illuminate\Http\Request;

class BprController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        $MprProducts = MprProduct::where('mpr_id', $request->mpr_id)->get();

        $bpr = Bpr::create([
            'mpr_id' => $request->mpr_id,
            'lot_number' => 123401001,
            'bottle_count' => $request->bottle_count * 1.05,
            'created_by' => auth()->user()->id,
            'project_id' => $request->project_id
        ]);


        foreach($MprProducts as $mprProduct){
            $amount = $mprProduct->amount * 0.001 * $request->serving_size * $bpr->bottle_count ;

            $bpr->products()->attach($mprProduct->product_id, ['amount' => $amount]);
        }

        session()->flash('success', 'Batch created');

        return back();



//        $mprProducts = MprProduct::where('mpr_id', $request->mpr_id)->get();
//
//            foreach($mprProducts as $mprProduct){
//                dd($mprProduct->amount);
//            }


//        $mprs = Mpr::with('products')->toSql();
//
//        dd($mprs);
//
//
//        foreach($mprs as $mpr){
//            dd($mpr->products->pivot->amount);
//        }

//        $products = MprProduct::where('mpr_id', $request->mpr_id)->get();
//
//        $bpr = Bpr::create([
//            'mpr_id' => $request->mpr_id,
//            'project_id' => $request->project_id,
//            'lot_number' => '123401001',
//            'bottle_count' => 5250,
//            'created_by' => auth()->user()->id
//        ]);
//
//        foreach($products as $product){
//            dd($product->pivot);
//            $bpr->products()->attach($product->id, ['amount' => 500]);
//        }
    }

    public function show(Bpr $bpr)
    {
        return view('bprs.show')->with('bpr', $bpr);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
