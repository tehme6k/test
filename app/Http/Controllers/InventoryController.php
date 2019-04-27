<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ApproveStatusRequest;
use App\Http\Requests\RejectStatusRequest;
use App\Http\Requests\InventoryNonPowderAdjustmentRequest;
use App\Http\Requests\InventoryPowderAdjustmentRequest;
use App\Inventory;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::paginate(25);


        return view('inventory.index')
            ->with('products', $products);
    }

    public function create()
    {
        //
    }

    public function powderstore(InventoryPowderAdjustmentRequest $request)
    {

        $lbs_kg = 0.45359237;
        $g_kg = 0.001;
        $amount = $request->amount;

        if($request->unit === 'lb'){
            $amount = $request->amount * $lbs_kg;
        }elseif($request->unit === 'g'){
            $amount = $request->amount * $g_kg;
        }

        if($request->adjustment_method == 'remove'){
            $amount = $amount * -1;
        }

        Inventory::create([
            'product_id' => $request->product_id,
            'amount' => $amount,
            'created_by' => auth()->user()->id

        ]);


        session()->flash('success', 'Adjustment made to inventory successfully');

        return back();
    }

    public function nonpowderstore(InventoryNonPowderAdjustmentRequest $request)
    {
        if($request->adjustment_method == 'add'){
            $amount = $request->amount;
        }elseif($request->adjustment_method == 'remove'){
            $amount = $request->amount * -1;
        }



        Inventory::create([
            'product_id' => $request->product_id,
            'amount' => $amount,
            'created_by' => auth()->user()->id

        ]);

        session()->flash('success', 'Adjustment made to inventory successfully');

        return back();
    }

    public function show(Inventory $inventory)
    {

        $total = Inventory::where('product_id', $inventory->product->id)->where('status', 'approved');

        $hide_table = 'yes';

        if($inventory->product->category->name == 'Powder'){
            $unit = 'Kg';
        }else{
            $unit = 'each';
        }



        return view('inventory.show')
            ->with('inventory', $inventory)
            ->with('total', $total)
            ->with('hide_table', $hide_table)
            ->with('unit');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function approve(Inventory $inventory, ApproveStatusRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if (Hash::check($request->password, $user->password)) {
            $inventory->update([
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

    public function reject(Inventory $inventory, RejectStatusRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if (Hash::check($request->password, $user->password)) {
            $inventory->update([
                'status' => 'rejected'
            ]);

            session()->flash('success', 'Item Rejected');

            return back();
        }
        else {
            session()->flash('fail', 'Rejection Failed');

            return back();
        }
    }

    public function destroy($id)
    {
        //
    }
}
