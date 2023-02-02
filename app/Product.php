<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    public $timestamp = true;
    protected $fillable = ["author", "name","price","price_old","code","cat_id","desc","content","cpu","ram","rom","weight","display","slug","opera","trandmake","avatar","thumb_1","thumb_2","thumb_3","thumb_4","state", "cat_product", "cat_parent", "qty"];

    function user() {
        return $this->belongsTo(User::class);
    }
}
