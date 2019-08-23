<?php

namespace CodeShopping\Http\Controllers\APi;

use CodeShopping\Models\Product;
use Illuminate\Http\Request;
use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\ProductStoreUpdateFormRequest;
use CodeShopping\Http\Resources\ProductResource;

class ProductController extends Controller
{


    public function index()
    {
        $products = Product::paginate(30);
        return ProductResource::collection($products);
    }
 
    public function store(ProductStoreUpdateFormRequest $request)
    {
        $product = Product::create($request->all());
        $product->refresh();
        return new ProductResource($product);
        //return response($product, $status = 201, []);
    }

    public function show($id)
    {       
        $product =  Product::where('id', $id)->orWhere('slug',$id)->get();
        return new ProductResource($product->first());
    }

    public function update(ProductStoreUpdateFormRequest $request, Product $product)
    {
        $product->fill($request->all());
        $product->save();
        
        return new ProductResource($product);
      //  return response($product, $status = 204, []);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([], $status = 204, []);
    }
}
