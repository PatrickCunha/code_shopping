<?php

namespace CodeShopping\Http\Controllers\APi;

use CodeShopping\Models\Product;
use Illuminate\Http\Request;
use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\ProductStoreUpdateFormRequest;

class ProductController extends Controller
{


    public function index()
    {
        return Product::all();
    }
 
    public function store(ProductStoreUpdateFormRequest $request)
    {
        $Product = Product::create($request->all());
        $Product->refresh();
        return $Product;
        //return response($Product, $status = 201, []);

    }

    public function show($id)
    {       
        $Product =  Product::where('id', 1)->orWhere('slug',$id)->get();
        return $Product->first();
    }

   
    public function update(ProductStoreUpdateFormRequest $request, Product $Product)
    {
        $Product->fill($request->all());
        $Product->save();
        

        return $Product;
      //  return response($Product, $status = 204, []);
       
    }

    public function destroy(Product $Product)
    {
        $Product->delete();
        return response([], $status = 204, []);
    }
}
