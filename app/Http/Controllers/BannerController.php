<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\Paginator;

class BannerController extends Controller
{

    use Paginator;
    /**
     * Display a listing of the resource.

     * @return Response
     */
    public function index()
    {
        //

        $banners = Banner::orderBy('id','DESC')->paginate(10);
        return view ( 'backend.banners.index',compact('banners'));
    }

    public function bannerStatus(Request $request){
//        dd($request->all());
        if($request->mode=='true'){
            DB::table('banners')->where('id',$request->id)->update(['status'=>'active']);

        }
        else{
            DB::table('banners')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully Updated Status',"Status"=>true]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view ('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            "title"=>"string|required",
            "description"=>"string|required",
            "photo" => "required",
            "condition" => "nullable|in:banner,promo",
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
        $Create_status = Banner::create($data);

        if ($Create_status){

            return redirect()->route('banner.index')->with("success","Successfully Created");

        }else {
            return back()->with('error',"Something went wrong");
        }
       // return $data ;







    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        if ($banner){
            return view ('backend.banners.edit',compact('banner'));
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        if ($banner){
            $request->validate([
                "title"=>"string|required",
               // "description"=>"string|required",
                "photo" => "required",
                "condition" => "nullable|in:banner,promo",
                "status" => "nullable|in:active,inactive"
            ]);
            $data= $request->all();

            // return $data;
            $Create_status =$banner->fill($data)->save();

            if ($Create_status){

                return redirect()->route('banner.index')->with("success","Successfully Created");

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
     * @return Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if ($banner){
           // dd($banner);
            $status =$banner->delete();
            if($status){
                return redirect()->route('banner.index')->with('success','Banner Successfully Deleted');
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
