@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{ route('boxes.index') }}" class="btn btn-primary mb-2">
                View Open Boxes
            </a>
        </div>

        <div>
            {{$boxes->links()}}
        </div>

        <div>
            <form action="{{ route('boxes.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success mb-2">
                    Add box
                </button>
            </form>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Closed Retention Boxes
        </div>

        <div class="card-body">
            @if($boxes->count() > 0)
                <table class="table">
                    <thead>
                    <th>Box #</th>
                    <th>Hold Until</th>
                    <th>Opened On</th>
                    <th>Closed On</th>
                    <th>Opened by</th>
                    <th>Closed By</th>
                    <th></th>
                    </thead>

                    <tbody>
                    @foreach($boxes as $box)
                        <tr>
                            <td>
                                {{$box->id}}
                            </td>

                            <td>
                                {{\Carbon\Carbon::parse($box->hold_date)->format('d M Y')}}

                            </td>

                            <td>
                                {{\Carbon\Carbon::parse($box->created_at)->format('d M Y')}}

                            </td>

                            <td>
                                {{\Carbon\Carbon::parse($box->closed_at)->format('d M Y')}}

                            </td>

                            <td>
                                {{ $box->openedBy->name }}
                            </td>

                            <td>
                                {{ $box->closedBy->name }}
                            </td>


                            <td>
                                <a href="{{ route('boxes.show', $box->id) }}" class="btn btn-info btn-sm">Open</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$boxes->links()}}
            @else
                <h3 class="text-center">No boxes at this time</h3>
            @endif



        </div>

    </div>

@endsection

@section('scripts')

@endsection