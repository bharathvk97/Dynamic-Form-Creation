<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormResponse extends Model
{
    use SoftDeletes;

    protected $table = 'form_response';

    protected $guarded = [];

}
