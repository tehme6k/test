<?php

namespace App\Http\Controllers;

use App\Box;
use App\ReopenedBoxes;
use App\User;
use App\Retention;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BoxesController extends Controller
{

    public function index()
    {
        $open_boxes = Box::where('status', 'open')->paginate(2);
        $reopen_boxes_list = Box::where('status', 'reopened')->get();
        $reopen_datas = ReopenedBoxes::where('close_date', NULL)->get();

        $retired = Box::where('hold_date', Carbon::today())->get();

        return view('boxes.index')
            ->with('open_boxes', $open_boxes)
            ->with('reopen_boxes', $reopen_boxes_list)
            ->with('reopen_datas', $reopen_datas)
            ->with('retired', $retired)
            ->with('users', User::all());
    }

    public function closed()
    {
        $closed_boxes = Box::where('closed_by', '=', null)->orderBy('id', 'DESC')->paginate(2);
        return view('boxes.closed')->with('boxes', $closed_boxes);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Box::Create([
            'opened_by' => auth()->user()->id
        ]);

        session()->flash('success', 'Started new box');

        return redirect(route('boxes.index'));
    }

    public function show(Box $box)
    {
        $retentions = Retention::where('box_id', $box->id)->get();

        $max_date = Retention::where('box_id', $box->id)->latest('expiration_date')->first();

        return view('boxes.box')->with('box', $box)
            ->with('retentions', $retentions)
            ->with('max_date', $max_date)
            ->with('users', User::all());

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Box $box)
    {
        $data = $request->only(['closed_by', 'closed_at', 'status', 'hold_date']);

        $max_expirtation_date = $request->max_expiration_date;

        $hold_date = Carbon::create($max_expirtation_date);

        $hold_date->addYear();


        $box->update([
            'closed_by' => $request->closed_by,
            'closed_at' => $request->closed_at,
            'status' => $request->status,
            'hold_date' => $hold_date

        ]);

        session()->flash('success', 'Box Closed');

        return back();
    }

    public function print(Box $box)
    {
        $retentions = Retention::where('box_id', $box->id)->get();
        $max_date = Retention::where('box_id', $box->id)->latest('expiration_date')->first();
        $min_date = Retention::where('box_id', $box->id)->oldest('expiration_date')->first();

        return view('boxes.print')
            ->with('box', $box)
            ->with('retentions', $retentions)
            ->with('max_date', $max_date)
            ->with('min_date', $min_date);
    }


    public function destroy($id)
    {
        //
    }
}
