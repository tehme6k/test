@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">

        <div>
            <a href="{{ URL::previous() }}" type="button" class="btn btn-primary mb-2 ">Back</a>
        </div>

        <div>
            <button type="button" class="btn btn-success mb-2 " onclick="handleAdd()">Add</button>
            @if($total->sum('amount') > 0)
                <button type="button" class="btn btn-danger mb-2 ml-2" onclick="handleRemove()">Remove</button>
            @endif
        </div>

    </div>

    @include('partials.errors')

    <div class="card card-default">
        <div class="card-header d-flex justify-content-between">
            <div>
                {{$product->name}}
            </div>

            <div>
               @if(isset($total))
                    Total: {{number_format($total->sum('amount'), 2)}} {{$unit}}
               @else
                   Total: 0
               @endif
            </div>
        </div>
        <div class="card-body">
            @if($inventories->count() > 0)

                <table class="table">
                    <thead>
                    <th>Amount</th>
                    <th>Added By</th>
                    <th>Added On</th>
                    <th>Status</th>
                    </thead>

                    <tbody>
                    @foreach($inventories as $inventory)
                        <tr>
                            <td>
                                <a href="{{ route('inventories.show', $inventory->id) }}" class="btn btn-link btn-sm">
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
                    </tbody>
                </table>
            @else
                <h3 class="text-center">No inventory at this time</h3>
            @endif

        </div>
    </div>

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