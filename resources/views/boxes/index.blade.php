@extends('layouts.index')

@section('top-card-header')
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{ route('ret.closed') }}" class="btn btn-primary mb-2">
                View Closed Boxes
            </a>
        </div>

        <div>
            <button type="button" class="btn btn-success mb-2" onclick="handleAdd()">
                Add Box
            </button>
        </div>
    </div>
@endsection

@section('top-card-body')
    <div class="d-flex justify-content-between">
        <div>
            Total Open: <strong>{{$open_boxes_count->count()}}</strong><br>
            Total Reopened: <strong>{{$reopen_boxes->count()}}</strong>
        </div>

        <div>
            Total Closed: <strong>{{$closed_boxes->count()}}</strong><br>
            Total all: <strong>{{$all_boxes->count()}}</strong>
        </div>
    </div>
@endsection

@section('bottom-card-header')
    Open Retention Boxes
@endsection

@section('bottom-card-body')
    @if($open_boxes_count->count() > 0)
        <table class="table">
            <thead>
            <th>Box #</th>
            <th>Opened On</th>
            <th>Opened By</th>
            <th></th>
            </thead>

            <tbody>
            @foreach($open_boxes as $open_box)
                <tr>
                    <td>
                        {{$open_box->id}}
                    </td>

                    <td>
                        {{\Carbon\Carbon::parse($open_box->created_at)->format('d M Y')}}
                    </td>

                    <td>
                        {{ $open_box->openedBy->name }}
                    </td>

                    <td>
                        <a href="{{ route('boxes.show', $open_box->id) }}" class="btn btn-info btn-sm">View Contents</a>
                    </td>
                </tr>
            @endforeach

            @if($reopen_datas->count() > 0)
                @foreach($reopen_datas as $data)
                    <tr class="text-warning">
                        <td>
                            {{$data->box_id}}
                        </td>

                        <td>
                            {{\Carbon\Carbon::parse($data->reopen_date)->format('d M Y')}}
                        </td>

                        <td>
                            {{ $data->requestedBy->name }}
                        </td>

                        <td>
                            <a href="{{ route('reopen.show', [$data->box_id, $data->id]) }}" class="btn btn-outline-warning btn-sm">View Contents</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

        {{$open_boxes->links()}}
    @else
        <h3 class="text-center">No boxes at this time</h3>
    @endif
@endsection

@section('content')


        <form action="{{ route('boxes.store') }}" method="POST">
            @csrf
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addModalLabel">Add new box?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @if($open_boxes_count->count() > 0)
                                You have the boxes listed already open. Are you still sure you wish to start a new box?
                                <ul class="list-group">
                                    @foreach($open_boxes_count as $open_box)
                                        <li class="list-group-item">
                                            Box[{{ $open_box->id }}]
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                You have no boxes currenly open. Click 'New Box' Below to start a new box.
                            @endif

                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">New Box</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>



@endsection

@section('scripts')

@endsection













