<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\Paginator;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view ( 'backend.categories.index',compact('categories'));
    }

    public function categoryStatus(Request $request){
//        dd($request->all());
        if($request->mode=='true'){
            DB::table('categories')->where('id',$request->id)->update(['status'=>'active']);

        }
        else{
            DB::table('categories')->where('id',$request->id)->update(['status'=>'inactive']);
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
        $parent_cats = Category::where('is_parent',1)->orderBy('title','ASC')->get();
        return view ('backend.categories.create',compact('parent_cats'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
       // return request()->all();
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|required',
            'is_parent'=>'sometimes|in:1',
            'parent_id' => 'nullable',
            'status'=>'nullable|in:active,inactive'

        ]);
        $data= $request->all();
        $slug= Str::slug($request->input('title'));
        $slug_count = Category::where('slug',$slug)->count();
        if($slug_count>0){
            $slug = time().'-'.$slug;
        }
        $data['slug']=$slug;
        $data['is_parent'] = $request->input('is_parent', 0);
        if($request->is_parent==1) {
            $data['parent_id'] = null;
        }
        $Create_status = Category::create($data);

        if ($Create_status){

            return redirect()->route('categories.index')->with("success","Category Successfully Created");

        }else {
            return back()->with('error',"Something went wrong");
        }
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
        $parent_cats = Category::where('is_parent',1)->orderBy('title','ASC')->get();
        $categories = Category::find($id);
        if ($categories){
            return view ('backend.categories.edit',compact(['categories','parent_cats']));
        }
        else{
            return back()->with('error', 'Category not found');
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
        //
       // return request()->all();

        $categories = Category::find($id);
        if ($categories){
            $request->validate([
                'title'=>'string|required',
                'summary'=>'string|required',
                'is_parent'=>'sometimes|in:1',
                'parent_id' => 'nullable',
                'status'=>'nullable|in:active,inactive'
            ]);
            $data= $request->all();


            $data['is_parent']=$request->input('is_parent',0);
            if ($request->is_parent==1){
                $data['parent_id']=null;
            }

            $Create_status =$categories->fill($data)->save();

            if ($Create_status){

                return redirect()->route('categories.index')->with("success","Category Successfully Created");

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
        $category = Category::find($id);
        $child_cat_id=Category::where('parent_id',$id)->pluck('id');
        if ($category){
            // dd($banner);
            $category =$category->delete();
            if($category){
                if(count($child_cat_id)>0){
                    Category::shiftChild($child_cat_id);
                }
                return redirect()->route('categories.index')->with('success','Category Successfully Deleted');
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
