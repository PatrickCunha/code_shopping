<?php

namespace CodeShopping\Http\Controllers\APi;

use CodeShopping\Models\Category;
use Illuminate\Http\Request;
use CodeShopping\Http\Controllers\Controller;
use CodeShopping\Http\Requests\CategoryStoreUpdateFormRequest;

class CategoryController extends Controller
{


    public function index()
    {
        return Category::all();
    }
 
    public function store(CategoryStoreUpdateFormRequest $request)
    {
        $category = Category::create($request->all());
        $category->refresh();
        return $category;
        //return response($category, $status = 201, []);

    }

    public function show($id)
    {       
        $category =  Category::where('id', 1)->orWhere('slug',$id)->get();
        return $category->first();
    }

   
    public function update(CategoryStoreUpdateFormRequest $request, Category $category)
    {
        $category->fill($request->all());
        $category->save();
        

        return $category;
      //  return response($category, $status = 204, []);
       
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response([], $status = 204, []);
    }
}
