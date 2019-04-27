@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between mb-2">
        <div>
            <a href="{{route('boxes.index')}}" class="btn btn-primary">
                Back
            </a>
        </div>

        <div>
            <button type="button" class="btn btn-outline-danger" onclick="handleClose()">
                Close this box
            </button>
        </div>
    </div>


    <div class="card card-default mb-4">
        <div class="card-header">
            Info for reopen of Box #: {{$box->id}}
        </div>

        <div class="card-body">
            Requested By: <strong>{{$reopendata->requestedBy->name}}</strong><br>
            On: <strong>{{\Carbon\Carbon::parse($reopendata->reopen_date)->format('d M Y')}}</strong><br>
            Reason: <strong>{{$reopendata->reason}}</strong>

        </div>
    </div>


    <div class="card card-default">
        <div class="card-header">Reopened Retention Box # {{$box->id}}</div>
        <div class="card-body">

            @include('partials.errors')
            @include('partials.retention_bottles')


        </div>
    </div>







    <form action="{{ route('reopen.close', [$box->id, $reopendata->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="closeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="closeModalLabel">Close Box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="close_date" value="{{ $reopendata->reopen_date }}">
                        <input type="hidden" name="closed_by" value="{{ auth()->user()->id }}">

                        Click 'Close Box' below if you are sure you wish to close this box and store it.

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Close Box</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection



@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>




        function handleClose() {
            console.log('Opening Modal from reopens.blade.php script section')

            $('#closeModal').modal('show')
        }

        flatpickr('#production_date', {
        })

    </script>
@endsection