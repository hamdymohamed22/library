<?php

namespace App\Http\Controllers;

use App\Http\Resources\CatResource;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiCatController extends Controller
{
    //
    public function all()
    {
        $categories = Cat::all();
        return CatResource::collection($categories);
    }
    // show one 
    public function show($id)
    {
        $category = Cat::find($id);
        if ($category) {
            return new CatResource($category);
        } else {
            return response()->json([
                "msg" => "category not found"
            ], 404);
        }
    }
    // create category 
    public function create(Request $request)
    {

        // validation 
        $validation =  Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "desc" => "required|string",
            "image" => "required|image|mimes:jpeg,png,jpg",
        ]);

        // check if any fails or errors 
        if ($validation->fails()) {
            return response()->json([
                "msg" => $validation->errors()
            ], 301);
        }

        // store image 
        $imageName = Storage::putFile("catsApi", $request->image);

        // create 
        Cat::create([
            "name" => $request->name,
            "desc" => $request->desc,
            "image" => $imageName,
        ]);

        // return response

        return response()->json([
            "msg" => "category created successfuly"
        ], 201);
    }
    // update category
    public function update(Request $request, $id)
    {

        // validation 
        $validation =  Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "desc" => "required|string",
            "image" => "image|mimes:jpeg,png,jpg",
        ]);
        // check if any fails or errors 
        if ($validation->fails()) {
            return response()->json([
                "msg" => $validation->errors()
            ], 301);
        }
        // find catefory
        $category = Cat::find($id);
        if ($category == null) {
            return response()->json([
                "msg" => "category not found"
            ], 404);
        }

        // delete old image and up new one if exist
        $imageName = $category->image;
        if ($request->has('image')) {
            if ($imageName != null) {
                Storage::delete($category->image);
            }
            $imageName = Storage::putFile('catsApi', $request->image);
        }
        // update the new data
        $category->update([
            "name" => $request->name,
            "desc" => $request->desc,
            "image" => $imageName,
        ]);

        // return response 
        return response()->json([
            "msg" => "category updated successfuly"
        ], 201);
    }

    public function delete($id){
        // find catefory
        $category = Cat::find($id);
        if ($category == null) {
            return response()->json([
                "msg" => "category not found"
            ], 404);
        }
        // delete image 

        if ($category->image != null) {
            Storage::delete($category->image);
        }
    
        //delete category
        $category->delete();
        // return response 
        return response()->json([
            "msg" => "category deleted successfuly"
        ], 201);
    }
}
