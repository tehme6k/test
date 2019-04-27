@extends('layouts.app')

@section('content')

    @if(!$box->closed_by)


        <div class="d-flex justify-content-between">

            <div>
                @if($retentions->count() > 0)
                    <button type="button" class="btn btn-outline-danger" onclick="handleClose()">
                        Close this box
                    </button>
                @endif
            </div>

            <div>
                <button type="button" class="btn btn-primary my-2" onclick="handleAdd()">
                    Add Bottle
                </button>
            </div>
        </div>

    @else

        <div class="d-flex justify-content-between">

            <div>
                <a href="{{ route('ret.closed') }}" class="btn btn-info mb-2">
                    Closed Boxes
                </a>
            </div>


            <div>
                <button type="button" class="btn btn-outline-danger mb-2" onclick="handleReopen()">
                    Reopen Box
                </button>
            </div>




        </div>





    @endif


    <div class="card card-default">
        <div class="card-header">Retention Box # {{$box->id}}</div>
        <div class="card-body">

            @include('partials.errors')
            @include('partials.retention_bottles')





        </div>
    </div>

    <div>

    </div>

    <form action="{{ route('retention.add', $box->id) }}" method="POST">
        @csrf
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="lot_number">Lot Number</label>
                            <input type="number" name="lot_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="production_date">Production date</label>
                            <input type="text" name="production_date" id="production_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="expiration_length">Expiration Length</label>
                            <select name="expiration_length" id="expiration_length" class="form-control">
                                <option value="3">3 years</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="handleTest(event)">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <form action="{{ route('boxes.update', $box->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="closeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="closeModalLabel">Finished with this box and ready to close it?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="closed_by" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="closed_at" value="{{Carbon\Carbon::now()}}">
                        <input type="hidden" name="status" value="closed">

                        @if($max_date)
                            <input type="hidden" name="max_expiration_date" value="{{ $max_date->expiration_date }}">
                        @endif




                       <p>If you are ready to close and store this box, then click 'Save changes' below.</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <form action="{{ route('boxes.reopen', $box->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="reopenModal" tabindex="-1" role="dialog" aria-labelledby="reopenModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reopeneModalLabel">Reopen Box</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="opened_by_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="reopen_date" value="{{Carbon\Carbon::now()}}">
                        <input type="hidden" name="status" value="reopened">

                        <div class="form-group">
                            <label for="requested_by_id">Requested By</label>
                            <select name="requested_by_id" id="requested_by_id" class="form-control">
                                <option value="">---</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="reason">Reason</label>
                            <textarea name="reason" id="reason" cols="5" rows="5" class="form-control"></textarea>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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
        function handleTest(event) {
            // event.preventDefault();
            console.log('Default prevented');
        }
    </script>

    <script>

        function handleReopen() {
            console.log('reopen box')

            $('#reopenModal').modal('show')
        }


        function handleClose() {
            console.log('Opening Modal from box.blade.php script section')

            $('#closeModal').modal('show')
        }

        flatpickr('#production_date', {
        })

    </script>
@endsection