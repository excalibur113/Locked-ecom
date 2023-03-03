@extends('layouts.mainLayout')

@section('content')

            <div class="card border-0">
                <div class="border border-1">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="">
                            <tr>
                                <th class="text-center"> ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">SKU</th>
                                <th class="text-center desc-column">Description</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Cover</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $products as $item )
                                <tr class="product-rows">
                                    <td class="text-center"> {{ $item->id }} </td>
                                    <td> {{ $item->productName }} </td>
                                    <td class="text-center"> {{ $item->sku }} </td>
                                    <td class="text-container"> 
                                        <p> 
                                            {{ $item->description }} 
                                        </p>
                                    </td>
                                    <td class="text-center"> {{ $item->category }} </td>
                                    <td class="text-center"> {{ $item->quantity }} </td>
                                    <td class="text-center"> {{ $item->price }} </td>
                                    <td class="text-center"> 
                                        <img src="{{ asset('/uploads/products/'.$item->cover_image) }}" alt="Product Image" width="80px" height="80px" /> 
                                    </td>
                                    <td class="text-center"> 
                                        <a href="{{ url('/edit-product/'.$item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                    <td class="text-center"> 
                                        <a href="{{ url('/delete-product/'.$item->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    
@endsection