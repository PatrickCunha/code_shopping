<?php

namespace CodeShopping\Http\Controllers\APi;

use CodeShopping\Models\Category;
use Illuminate\Http\Request;
use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\CategoryStoreUpdateFormRequest;
use CodeShopping\Http\Resources\CategoryResource;

class CategoryController extends Controller
{


    public function index()
    {
        return CategoryResource::collection(Category::all());
    }
 
    public function store(CategoryStoreUpdateFormRequest $request)
    {
        $category = Category::create($request->all());
        $category->refresh();
        return new CategoryResource($category);
        //return response($category, $status = 201, []);

    }

    public function show($id)
    {       
        $category =  Category::where('id', $id)->orWhere('slug',$id)->get();
        return new CategoryResource($category->first());
    }

   
    public function update(CategoryStoreUpdateFormRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();        

        return new CategoryResource($category);
      //  return response($category, $status = 204, []);
       
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([], $status = 204, []);
    }
}
