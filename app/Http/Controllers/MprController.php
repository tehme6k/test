<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductToMprRequest;
use App\Http\Requests\ApproveStatusRequest;
use App\Http\Requests\NewMprRequest;
use App\Mpr;
use App\User;
use App\MprProduct;
use App\Product;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MprController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(NewMprRequest $request)
    {
        if($request->version < 0){
            $version = '';
        }else{
            $version = $request->version +1;

        }



        Mpr::create([
            'project_id' => $request->project_id,
            'version' => $version,
            'serving_size' => $request->serving_size,
            'created_by' => auth()->user()->id
        ]);

        session()->flash('success', 'Mpr Created Successfully');

        return back();
    }

    public function show(Mpr $mpr)
    {


        return view('mprs.show')
            ->with('mpr', $mpr)
            ->with('allProducts', Product::all());
    }

    public function addProduct(AddProductToMprRequest $request)
    {
        MprProduct::create([
            'mpr_id' => $request->mpr_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount
        ]);

        session()->flash('success', 'Item added!');

        return back();
    }

    public function approve(Mpr $mpr, ApproveStatusRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);


//        $sum = $mpr->products->whereHas('product_id', function ($q){
//            $q->where('category', 'Powder')->get();
//        });

        $sum =

        dd($sum);

//        $sum = $mpr->products()->whereHas('category', )->sum('amount');

//        $gpb = ($sum * $mpr->serving_size) / 1000;

        dd($gpb);

        if (Hash::check($request->password, $user->password)) {
            $mpr->update([
                'approved_by' => auth()->user()->id,
                'status' => 'approved'
            ]);

            session()->flash('success', 'Item Approved');

            return back();
        }
        else {
            session()->flash('fail', 'Approval Failed');

            return back();
        }
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
