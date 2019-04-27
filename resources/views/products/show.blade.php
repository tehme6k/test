@extends('layouts.show')

@section('jumbotron-header')
    {{$product->name}}
@endsection


@section('jumbotron-under-header')
    {{ $product->category->name }}
@endsection


@section('jumbotron-content')
    <h3> By: <strong> {{ $product->user->name }}</strong></h3>
    @if(isset($total))
        <h4>Total: {{number_format($total->sum('amount'), 2)}} {{$unit}}</h4>
    @else
        <h4>Total: 0</h4>
    @endif
@endsection


@section('jumbotron-buttons')
    <div>
        <button type="button" class="btn btn-success mb-2 " onclick="handleAdd()">Add</button>
        @if($total->sum('amount') > 0)
            <button type="button" class="btn btn-danger mb-2 ml-2" onclick="handleRemove()">Remove</button>
        @endif
    </div>
@endsection


@section('table-header')
    <th>Amount</th>
    <th>Added By</th>
    <th>Added On</th>
    <th>Status</th>
@endsection


@if($inventories->count() > 0)
    @section('table-body')
        @foreach($inventories as $inventory)
            <tr>
                <td>
                    <a href="{{ route('inventories.show', $inventory->id) }}" class="btn btn-link">
                        {{number_format($inventory->amount, 2)}} {{$unit}}
                    </a>
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
        @endforeach
    @endsection
@else
    @section('table-body')
        <tr>
            <td colspan="4">
                Nothing to show.
            </td>
        </tr>
    @endsection
@endif


@section('content')
    <form action="{{$unit == 'Kg' ?  route('inventories.powder.store')  :  route('inventories.nonpowder.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">{{$product->name}} : Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="product_id" id="product_name" value="{{$product->id}}">
                        <input type="hidden" name="adjustment_method" id="adjustment_method" value="add">


                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>

                        @if($unit == 'Kg')
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <select name="unit" id="unit" class="form-control">
                                    <option value="">---</option>
                                    <option value="g">grams</option>
                                    <option value="kg">kilograms</option>
                                    <option value="lb">pounds</option>
                                </select>
                            </div>
                        @endif



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>

    <form action="{{$unit == 'Kg' ?  route('inventories.powder.store')  :  route('inventories.nonpowder.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="removeModalLabel">{{$product->name}} : Remove</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="product_id" id="product_name" value="{{$product->id}}">
                        <input type="hidden" name="adjustment_method" id="adjustment_method" value="remove">



                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>

                        @if($unit == 'Kg')
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <select name="unit" id="unit" class="form-control">
                                    <option value="">---</option>
                                    <option value="g">grams</option>
                                    <option value="kg">kilograms</option>
                                    <option value="lb">pounds</option>
                                </select>
                            </div>
                        @endif



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
        function handleRemove() {
            console.log('Opening Modal from products.show.blade.php file scripts section')

            $('#removeModal').modal('show')
        }
    </script>
@endsection