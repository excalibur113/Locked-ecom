<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductsController extends Controller
{

    // displays
    // products->admin
    // public function products() {
    //     $products = Product::all();
    //     return view('admin', compact('products'));
    // }
    // products->withCategory->categoryPage
    // Snipers->snipersPage
    

    public function products(Request $request) {
        $query = Product::query();

        // Search
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('productName', 'like', '%'.$searchTerm.'%');
        } // filter by search term

        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('category', $category);
        } // filter by category

        $products = $query->orderBy('created_at', 'desc')->get(); // desc->descending | asc-> ascending

        return view('admin', compact('products'));
    }



    public function addProduct() {
        return view('add-product');
    }

    public function saveProduct(Request $request) {

        $validator = Validator::make($request->all(), [
            'productName' => 'required',
            'sku' => 'required',
            'description' => 'required',
            'category' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('status0', 'Please fill up all the fields');
        }
    
        $product = new Product([
            'productName' => $request->productName,
            'sku' => $request->sku,
            'description' => $request->description,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(\public_path('uploads/products'), $filename);
    
            $product->cover_image = $filename;
        }
    
        if ($product->save()) {
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                foreach ($files as $file) {
                    $extension = $file->getClientOriginalExtension();
                    $filename = time(). '_' .Str::random(10). '.' .$extension;
                    $request['product_id'] = $product->id;
                    $request['image'] = $filename;
                    $file->move(\public_path('uploads/images'), $filename);

                    ProductImage::create($request->all());
                }
            }
            return redirect()->back()->with('status1', 'Product Added Successfully');
        }
    }

    public function editProduct($id) {
        $product = Product::find($id);

        return view('/edit-product', compact('product'));
        // return view('edit-product')->with('product', $product);
    }

    public function updateProduct(Request $request, $id) {
        $product = Product::find($id);

        $product->productName = $request->input('productName');
        $product->sku = $request->input('sku');
        $product->description = $request->input('description');
        $product->category = $request->input('category');

        if ($request->hasFile('cover_image')) {

            $destination = '/uploads/products'.$product->cover_image;
            if ( File::exists($destination) ) {
                File::delete($destination);
            }
            $file = $request->file('cover_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' .$extension;
            $file->move(\public_path('uploads/products/'), $filename);
            $product->cover_image = $filename;
        };

        if ($request->hasFile('images') ) {
            $files = $request->file('images');
            foreach( $files as $file ) {
                $extension = $file->getClientOriginalExtension();
                $filename = time(). '_' .Str::random(10). '.' .$extension;
                $request['product_id'] = $product->id;
                $request['image'] = $filename;
                $file->move(\public_path('/uploads/images/'), $filename);
                ProductImage::create($request->all());
            }
        };

        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');

        $product->update();
        return redirect()->back()->with('status', 'Product Updated Successfully');
    }

    public function deleteProduct($id) {
        $product = Product::find($id);
        $destination = '/uploads/products/'.$product->cover_image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $productImages = ProductImage::where('product_id', $id)->get();
        foreach ($productImages as $productImage) {
            $destination2 = '/uploads/images/'.$productImage->image;
            if (File::exists($destination2)) {
                File::delete($destination2);
            }
            $productImage->delete();
        }


        $product-> delete();
        return redirect()->back()->with('status', 'Product Deleted Successfully');
    }


    public function deleteSmallImages($id) {
        $images = ProductImage::findOrFail($id);
        $destination = '/uploads/images/'.$images->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        ProductImage::find($id)->delete();
        return back();
    }

    public function deleteCover($id) {
        $image = Product::find($id)->cover_image;
        $destination = '/uploads/products/'.$image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        return back();
    }


    // API FUNCTIONS 

    public function featuredProducts() {
        $products = Product::where('category', 'featured')->orderBy('created_at', 'desc')->get();
        return response()->json($products);
    }

    public function productsApi() {
        $query = Product::query()->where('category', '!=', 'featured');

        $products = $query->orderBy('created_at', 'desc')->get(); // desc->descending | asc-> ascending

        return response()->json([
            'data' => $products,
            'message' => 'All products retrieved successfully',
            'status' => 'success'
        ]);
    }

    public function categoryApi(Request $request) {
        $query = Product::query();

        if ($request->has('category')) {
            $category = $request->input('category');
            $query->where('category', $category);
        } // filter by category

        $products = $query->orderBy('created_at', 'desc')->get(); // desc->descending | asc-> ascending

        return response()->json(['data' => $products]);
    }

    public function getProduct(Request $request, $id) {
        try {
            $product = Product::with('images')->findOrFail($id);
            return response()->json(['data' => $product]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Product not found.'], 404);
        }
    }

}
