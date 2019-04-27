@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Create Product
        </div>
        <div class="card-body">

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-success">
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection