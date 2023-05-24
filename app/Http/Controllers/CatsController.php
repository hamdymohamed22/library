<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CatsController extends Controller
{
    public function mod()
    {
        // DB::table("customers")->all();
        // $all =  DB::table("customers")->get();
        // $clints =  DB::table("customers")->select("customerNumber", "customerName")->get();
        // dd($all);
        // return view("cats.all", ["clints" => $clints]);

    }
    public function all()
    {
        $lib = Cat::all();
        // $lib = Cat::select("name", "desc")->get();
                // some query needed

        // select * from categories where id > 2
        $lib = Cat::all()->where("id",">","2");
        // select * from categories where id > 2 and name = aya
        $lib = Cat::all()->where("id",">","2")->where("name","=","aya");
        // select * from categories where id > 2 and name start with n
        $lib = Cat::where("id",">","2")->where("name","like","n%")->get();
        // select * from categories where id > 2 or name start with n
        $lib = Cat::where("id",">","2")->orWhere("name","like","n%")->get();
        // select * from categories where id > 2 order by id desc
        $lib = Cat::where("id",">","2")->orderBy("id","desc")->get();
        // select * from categories where id > 2 order by id desc limit 3
        $lib = Cat::where("id",">","2")->orderBy("id","desc")->limit(3)->get();
        // select * from categories where id > 2 order by id desc limit 3
        $lib = Cat::where("id",">","2")->orderBy("id","desc")->limit(2)->offset(2)->get();



        $categories = Cat::paginate(6);


        return view("cats.all", ["categories" => $categories]);
    }
    // show one 
    public function one($id)
    {
        $category =  Cat::findorFail($id);
        return view("cats.show", compact("category"));
    }

    // create category 

    public function create()
    {
        return view("cats.create");
    }

    // store category
    public function store(Request $request)
    {
        // echo $request->name ;
        // validate
       $data =  $request->validate([
            "name" => "required|string|max:255",
            "desc" => "required|string",
            "image" => "required|mimes:png,jpg,jpeg|image"
        ]);
        // rename 
        // move uploaded file 
        $data['image'] = Storage::putFile("cats", $data['image']);
        // store data
        Cat::create($data);
        // success message in session 
        session()->flash("success","data inserted successfuly");
        // rdirect 
        return redirect(url("cats/all"));
    }


    // update
    public function edit($id){
        $category =  Cat::findorFail($id);
        return view("cats.edit",compact("category"));

    }
    public function update($id, Request $request){

      $data =  $request->validate([
            "name" => "required|string|max:255",
            "desc" => "required|string",
            "image" => "mimes:png,jpg,jpeg|image"
        ]);

        $category =  Cat::findorFail($id);

        // check if has image to update
        if ($request->has("image")) {
            // unlink for the old image

            if (strlen($category->image) != 0) {
                Storage::delete($category->image);
            }
            
            // stor the new image
            $data['image'] = Storage::putFile("cats",$data['image']);
        }

        // $subject->update($data);
        $category->update($data);
        return redirect()->action([CatsController::class, "mod"]);

    }
    // delete 
    public function delete($id)
    {
        $category =  Cat::findorFail($id);

        // delete image [unlink]
        if (strlen($category->image) != 0) {
            Storage::delete($category->image);
        }
        // dd($category);
        $category->delete();
        // return redirect()->action([CatsController::class, "mod"]);
        return redirect()->route("allCats");
    }

}
