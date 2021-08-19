<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //

        $products = Product::orderBy('id','DESC')->paginate(10);
        return view ( 'backend.products.index',compact('products'));
    }

    public function productsStatus(Request $request){
//        dd($request->all());
        if($request->mode=='true'){
            DB::table('products')->where('id',$request->id)->update(['status'=>'active']);

        }
        else{
            DB::table('products')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status',"Status"=>true]);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return  view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'stock'=>'nullable|numeric',
            'price'=>'nullable|numeric',
            'discount'=>'nullable|numeric',
            'photo'=>'required',
            'cat_id'=>'required|exists:categories,id',
            'child_cat_id'=>'nullable|exists:categories,id',
            'size'=>'nullable',
            'condition'=>'nullable',
            'status'=>'nullable|in:active,inactive',

        ]);

        $data= $request->all();
        $slug= Str::slug($request->input('title'));
        $slug_count = Product::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().'-'.$slug;
        }
        $data['slug']=$slug;

        $data['offer_price'] = ($request->price-(($request->price*$request->discount)/100));
        $Create_status = Product::create($data);

        if ($Create_status){

            return redirect()->route('products.index')->with("success","Product Successfully Created");

        }else {
            return back()->with('error',"Something went wrong");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent_cats = Product::where('is_parent',1)->orderBy('title','ASC')->get();
        $products = Product::find($id);
        if ($products){
            return view ('backend.products.view',compact(['products']));
        }
        else{
            return back()->with('error', 'Product not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
