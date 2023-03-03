@extends('layouts.mainLayout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('status1'))
                <h6 class="alert alert-success">{{ session('status1') }}</h6>
            @endif
            @if (session('status0'))
                <h6 class="alert alert-danger">{{ session('status0') }}</h6>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>
                        <a href=" {{ url('/') }} " class="btn btn-primary float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                <form action="{{ url('/save-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Product Name</label>
                        <input type="text" name="productName" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Cover Image</label>
                        <input type="file" name="cover_image" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Other Images</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">SKU</label>
                        <input type="text" name="sku" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Price</label>
                        <input type="text" name="price" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Quantity</label>
                        <input type="text" name="quantity" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Category</label>
                        <select name="category" class="form-control">
                            <option value="">Select a category</option>
                            <option value="Pistols">Pistols</option>
                            <option value="Shotguns">Shotguns</option>
                            <option value="Snipers">Snipers</option>
                            <option value="Rifles">Rifles</option>
                            <option value="Others">Others</option>
                            <option value="Featured">Featured</option>
                            <!-- add more categories as needed -->
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="">Description</label>
                        <textarea type="text" name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>

                </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection