<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $forms = Form::get();

        return view('user_form', compact('forms'));
    }

    public function store(Request $request, $id){

        foreach($request->field_name as $key => $row){

            $form = new FormResponse();
            $form->form_id = $id;
            $form->field = $key;
            $form->value = $row;
            $form->save();
        }

        return redirect()->back();
    }
}
