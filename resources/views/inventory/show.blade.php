@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-success mb-2 " onclick="handleApprove()">Approve</button>

        <button type="button" class="btn btn-danger mb-2 ml-2" onclick="handleReject()">Reject</button>

    </div>

    @include('partials.errors')

    <div class="card card-default">
        <div class="card-header d-flex justify-content-between">
            <div>
                {{$inventory->product->name}}
            </div>

            <div>
                @if(isset($total))
                    Total: {{number_format($total->sum('amount'), 2)}}
                    {{$inventory->product->category->name == 'Powder' ? 'Kg' : 'each'}}
                @else
                    Total: 0
                @endif
            </div>
        </div>
        <div class="card-body">
            @if($inventory->count() > 0)


                <table class="table">
                    <thead>
                    <th>Amount</th>
                    <th>Added By</th>
                    <th>Added On</th>
                    <th>Status</th>
                    </thead>

                    <tbody>
                                            <tr>
                            <td>
                                {{number_format($inventory->amount, 2)}} {{$unit}}
                            </td>

                            <td>
                                {{ $inventory->createdBy->name }}
                            </td>

                            <td>
                                {{ $inventory->created_at}}
                            </td>

                            <td>
                                {{$inventory->status}}
                            </td>
                        </tr>
                    </tbody>
                </table>


            @else
                <h3 class="text-center">No inventory at this time</h3>
            @endif

        </div>
    </div>

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