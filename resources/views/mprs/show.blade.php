@extends('layouts.app')

@section('content')


        <div class="d-flex justify-content-between">
                <div>
                        <a href="{{ URL::previous() }}" type="button" class="btn btn-primary mb-2 ">Back</a>
                </div>

                <div>
                        @if($mpr->status == 'approved')
                                <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-success mb-2 " onclick="handleNewBPR()">Create BPR</button>
                                </div>
                        @else
                                <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-success mb-2 " onclick="handleAdd()">Add Product</button>
                                </div>
                        @endif

                </div>
        </div>

        @include('partials.errors')

        <div class="d-flex justify-content-between mb-2">
                <div>
                        <h2>{{ $mpr->project->name }} -
                                {{ $mpr->project->flavor }}</h2>
                        By: <strong> {{ $mpr->createdBy->name }}</strong>


                </div>

                <div>
                        <h3>Version # <strong>{{$mpr->version}}</strong></h3>
                        Created <strong>{{ $mpr->created_at->diffForHumans() }}</strong>
                </div>
        </div>

        @if($mpr->products->count() > 0)

                <table class="table">
                        <thead>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>UOM</th>
                        </thead>

                        <tbody>
                        @foreach($mpr->products as $product)
                                <tr>
                                        <td>
                                                {{$product->name}}
                                        </td>

                                        <td>
                                                {{$product->category->name}}
                                        </td>

                                        <td>
                                                {{$product->pivot->amount}}
                                        </td>

                                        <td>
                                                @if($product->category->name == 'Powder')
                                                        mg
                                                @else
                                                        each
                                                @endif
                                        </td>

                                </tr>
                        @endforeach
                        </tbody>
                </table>

                <div class="d-flex justify-content-end">
                        @if($mpr->status == 'approved')

                        @else
                                <div>
                                        <button type="button" class="btn btn-outline-primary mt-2" onclick="handleApprove()">Approve</button>
                                </div>
                        @endif
                </div>

        @else
                <h3 class="text-center">No products added yet.</h3>
        @endif



        <form action="{{ route('mpr.add') }}" method="POST">
                @csrf
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="addModalLabel">Add Product</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">

                                                <input type="hidden" name="mpr_id" value="{{ $mpr->id }}">

                                                <div class="form-group">
                                                        <label for="product_id">Select Product</label>
                                                        <select class="form-control" name="product_id" id="product_id">
                                                                <option value="">---</option>
                                                                @foreach($allProducts as $allProduct)
                                                                        <option value="{{ $allProduct->id }}">{{ $allProduct->name }}</option>
                                                                @endforeach
                                                        </select>
                                                </div>

                                                <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input type="number" step="any" class="form-control" name="amount" id="amount">
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


        <form action="{{ route('bprs.store') }}" method="POST">
                @csrf
                <div class="modal fade" id="newBprModal" tabindex="-1" role="dialog" aria-labelledby="newBprModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="newBprModalLabel">New BPR</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                </button>
                                        </div>
                                        <div class="modal-body">

                                                <input type="hidden" name="mpr_id" value="{{ $mpr->id }}">
                                                <input type="hidden" name="serving_size" value="{{ $mpr->serving_size }}">
                                                <input type="hidden" name="project_id" value="{{ $mpr->project->id }}">
                                                <input type="hidden" name="run_count" value="{{ $mpr->bprs->max('run_count') }}">




                                                <div class="form-group">
                                                        <label for="bottle_count">Bottle Count</label>
                                                        <input type="number" class="form-control" name="bottle_count" id="bottle_count">
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


        <form autocomplete="off" action="{{route('mprs.approve', $mpr->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="approveModalLabel">{{$mpr->project->name}} - {{ $mpr->project->flavor }} : Approve</h5>
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
                function handleNewBPR() {
                        console.log('Opening Modal from mpr.show.blade.php file scripts section')

                        $('#newBprModal').modal('show')
                }

                function handleApprove() {
                        console.log('Opening Modal from mpr.show.blade.php file scripts section')

                        $('#approveModal').modal('show')
                }
        </script>
@endsection