<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $table = 'forms';

    protected $guarded = [];

    public function FormField(){
        return $this->hasMany(FormField::class, 'form_id', 'id');
    }

}
