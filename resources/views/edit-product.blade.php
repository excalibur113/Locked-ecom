@extends('layouts.mainLayout')

@section('content')

    <div class="row w-100 d-flex mx-auto h-100 align-items-around">
        <h4 class="py-3 px-4">
            <a href=" {{ url('/') }} " class="btn btn-primary float-end">Back</a>
        </h4>
        @if (session('status'))
            <h6 class="alert alert-success mx-0 w-100">{{ session('status') }}</h6>
        @endif
        <div class="border border-1 d-flex justify-content-between p-3 ">
            <div class="d-flex flex-column"> 
                <div class="col-5 p-3 h-50 w-100 cover-form-container">

                    <form action="/delete-cover/{{ $product->id }}" method="POST" class="cover-form">
                        @csrf
                        @method('DELETE')
                        <img src="/uploads/products/{{ $product->cover_image }}" alt="Cover Image" width="100%" height="100%" class="cover-image">
                        <button class="delete-cover"><i class="bi bi-x-circle"></i></button>
                    </form>
                    
                </div>
                <div class="row small-images py-4 px-2">

                    @if ( count($product->images) > 0 )
                        @foreach ($product->images as $img )    
                        <div class="col-3 small-images-column mb-3 px-1">
                            <img src="/uploads/images/{{ $img->image }}" width="100%" height="100%" class="small-image" >
                            
                            <form action="/delete-small-image/{{ $img->id }}" method="GET">
                                @csrf
                                <!-- @method('DELETE') -->
                                <button class="delete-small-images">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </form>
                            
                        </div>
                        @endforeach
                    @endif

                </div>
            </div>
            
            <div class="col-7 p-2 d-flex flex-column justify-content-center w-95 mx-auto" >
                <form action="{{ url('/update-product/'.$product->id) }}" method="POST" enctype="multipart/form-data" class="h-100 edit-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group span-2">
                        <label for="">Product Name</label>
                        <input type="text" name="productName" value="{{$product->productName}}"  class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="cover_image">Cover Image</label>
                        <input type="file" name="cover_image"  class="form-control">
                        <img src="{{ asset('/uploads/products/'.$product->cover_image) }}" alt="Cover Image" width="70px" height="70px"> 
                    </div>

                    <div class="form-group ">
                        <label for="images[]">Other Images</label>
                        <input type="file" name="images[]"  class="form-control" multiple>
                    </div>

                    <div class="form-group">
                        <label for="">SKU</label>
                        <input type="text" name="sku" value="{{$product->sku}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" name="price" value="{{$product->price}}" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="text" name="quantity" value="{{$product->quantity}}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Category</label>
                        <input type="text" name="category" value="{{$product->category}}" class="form-control">
                    </div>

                    <div class="form-group span-2">
                        <label for="">Description</label>
                        <textarea type="text" name="description" class="form-control" rows="15"> {{$product->description}} </textarea>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>

                </form>
            </div> <!-- col-7 -->
        </div> <!-- new div --->
    </div> <!-- row -->

@endsection