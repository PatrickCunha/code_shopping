<?php

namespace CodeShopping\Http\Controllers\Api;

use Illuminate\Http\Request;
use CodeShopping\Models\Product;
use CodeShopping\Models\Category;
use CodeShopping\Models\ProductInput;
use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\ProductInputRequest;
use CodeShopping\Http\Resources\ProductProductInputResource;

class ProductInputController extends Controller
{
 
    public function index(Product $product)
    {        
        return new ProductProductInputResource($product);
    }

    public function store(ProductInputRequest $request, ProductInput $productInput, Product $product)
    { 
        $productInput = ProductInput::create($request->all() + ['product_id' => $product->id]);
        $product->refresh();
        $newStock = $product->stock + $productInput->amount;
        
        $product->fill(['stock' => $newStock]);
        $product->save();
        
        return new ProductProductInputResource($product);

    }



}
