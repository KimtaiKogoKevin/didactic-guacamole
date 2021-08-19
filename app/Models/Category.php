<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['title' , 'summary','photo','is_parent','parent_id','status','slug'];


    public static function shiftChild($cat_id){
        return Category::whereIn('id',$cat_id)->update(['is_parent'=>1]);

    }


//    public function children(): HasMany
//    {
//        return $this->hasMany(Category::class,"parent_id","id");
//    }

    public static function getChildByParentID($id){
        return Category::where('parent_id',$id)->pluck('title','id');
    }


}
