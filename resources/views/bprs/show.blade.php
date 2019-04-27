@extends('layouts.app')

@section('content')


    <div class="d-flex justify-content-between">
        <div>
            <a href="{{ URL::previous() }}" type="button" class="btn btn-primary mb-2 ">Back</a>
        </div>

        <div>

        </div>
    </div>


    <div class="d-flex justify-content-between mb-2">
        <div>
            <h2>{{ $bpr->mpr->project->name }} -
                {{ $bpr->mpr->project->flavor }}</h2>
            By: <strong> {{ $bpr->mpr->createdBy->name }}</strong>


        </div>

        <div>
            <h3>Mpr Version # <strong>{{$bpr->mpr->version}}</strong></h3>
            Created <strong>{{ $bpr->created_at->diffForHumans() }}</strong>
        </div>
    </div>



        <table class="table">
            <thead>
            <th>Name</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>UOM</th>
            </thead>

            <tbody>
            @foreach($bpr->products as $product)
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
                            g
                        @else
                            each
                        @endif
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>








@endsection

@section('scripts')

@endsection