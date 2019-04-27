@extends('layouts.show')

@section('jumbotron-header')
    <div class="d-flex justify-content-start">
        <div>
            <a href="{{ route('products.show', $inventory->product->id) }}" class="btn btn-link">Back</a>
        </div>
    </div>
    {{$inventory->product->name}}
@endsection


@section('jumbotron-under-header')
    {{number_format($inventory->amount, 2)}} {{$unit}}
@endsection


@section('jumbotron-content')
    <h4>Status <strong>{{$inventory->status}}</strong></h4>
    <h3>Created <strong>{{ $inventory->created_at->diffForHumans()}}</strong></h3>
    <h3>By <strong>{{ $inventory->createdBy->name }}</strong></h3>
@endsection


@section('jumbotron-buttons')
    @if($inventory->status != 'approved')
        <button type="button" class="btn btn-success mb-2 " onclick="handleApprove()">Approve</button>
    @endif

    @if($inventory->status != 'rejected')
        <button type="button" class="btn btn-danger mb-2 ml-2" onclick="handleReject()">Reject</button>
    @endif

@endsection



@section('content')
    <form autocomplete="off" action="{{route('inventories.approve', $inventory->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">{{$inventory->product->name}} : Approve</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <label for="email">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <form autocomplete="new-password" action="{{route('inventories.reject', $inventory->id)}}" method="POST">
        @csrf
        @method('put')
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">{{$inventory->product->name}} : Reject</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <label for="email">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection


@section('scripts')
    <script>
        function handleApprove() {
            console.log('Opening Modal from inventories.show.blade.php file scripts section')

            $('#approveModal').modal('show')
        }

        function handleReject() {
            console.log('Opening Modal from inventories.show.blade.php file scripts section')

            $('#rejectModal').modal('show')
        }
    </script>
@endsection