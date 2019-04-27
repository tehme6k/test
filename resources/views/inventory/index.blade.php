@extends('layouts.app')

@section('content')


    <div class="card card-default">
        <div class="card-header">Inventory</div>
        <div class="card-body">
            @include('partials.errors')
            @if($products->count() > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th>Adjustments Count</th>
                    <th>Projects Used In</th>
                    <th>Total Inventory</th>
                    <th></th>
                    </thead>

                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <a href="{{route('products.show', $product->id)}}" class="btn btn-link btn-md">
                                    {{$product->name}}
                                </a>

                            </td>

                            <td>
                                {{$product->inventories->count()}}
                            </td>

                            <td>0</td>

                            <td>
                                @if($product->inventories->sum('amount') > 0)
                                    @if($product->category->name === 'Powder')
                                        {{$product->inventories->sum('amount')}} Kg
                                    @else
                                        {{$product->inventories->sum('amount')}} each
                                    @endif
                                @else
                                 <font color="red">
                                     @if($product->category->name === 'Powder')
                                         {{$product->inventories->sum('amount')}} Kg
                                     @else
                                         {{$product->inventories->sum('amount')}} each
                                     @endif
                                 </font>
                                @endif
                            </td>

                            <td>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$products->links()}}
            @else
                <h3 class="text-center">No inventory products at this time</h3>
            @endif

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleAddPowder() {
            console.log('Opening Modal from inventory.index.blade.php file scripts section')

            $('#addModalPowder').modal('show')
        }

        function handleAddNonPowder() {
            console.log('Opening Modal from inventory.index.blade.php file scripts section')

            $('#addModalNonPowder').modal('show')
        }
    </script>
@endsection