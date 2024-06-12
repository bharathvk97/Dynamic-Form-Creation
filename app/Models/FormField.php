<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $table = 'form_fields';

    protected $guarded = [];

    function options()
    {
        return $this->hasMany(FieldOption::class, 'form_field_id');
    }
}
