<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view ( 'backend.brands.index',compact('brands'));
    }

    public function brandStatus(Request $request){
//        dd($request->all());
        if($request->mode=='true'){
            DB::table('brands')->where('id',$request->id)->update(['status'=>'active']);

        }
        else{
            DB::table('brands')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view ('backend.brands.create');

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
            "title"=>"string|required",
            "photo" => "required",
            "slug" => "string",
            "status" => "nullable|in:active,inactive"
        ]);
        $data= $request->all();
        $slug= Str::slug($request->input('title'));
        $slug_count = Banner::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().'-'.$slug;
        }
        $data['slug']=$slug;
        // return $data;
        $Create_status = Brand::create($data);

        if ($Create_status){

            return redirect()->route('brands.index')->with("success","Successfully Created");

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands = Brand::find($id);
        if ($brands){
            return view ('backend.brands.edit',compact('brands'));
        }
        else{
            return back()->with('error', 'Data nt found');
        }
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

        $brands = Brand::find($id);
        if ($brands){
            $request->validate([
                "title"=>"string|required",
                "photo" => "required",
                "slug" => "string",
                "status" => "nullable|in:active,inactive"
            ]);
            $data= $request->all();

            // return $data;
            $Create_status =$brands->fill($data)->save();

            if ($Create_status){

                return redirect()->route('brands.index')->with("success","Successfully Created");

            }else {
                return back()->with('error',"Something went wrong");
            }
        }
        else{
            return back()->with('error', 'Data not found');
        }
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
        $brands = Brand::find($id);
        if ($brands){
            // dd($banner);
            $status =$brands->delete();
            if($status){
                return redirect()->route('brands.index')->with('success','Banner Successfully Deleted');
            }
            else {
                return back()->with('error',"Something Went Wrong");
            }

        }
        else{
            return back()->with('error', 'Data not found');
        }
    }

}
