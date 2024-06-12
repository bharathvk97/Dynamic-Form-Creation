<?php


namespace App\Http\Controllers;


use App\Models\FieldOption;
use App\Models\FieldType;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function list_form()
    {
        $data = [
            'forms' => Form::all()
        ];

        return view('admin.form.list', $data);
    }

    public function add_form()
    {
        $data = [
            'fields' => FieldType::all()
        ];

        return view('admin.form.addForm', $data);
    }

    public function save_form(Request $request)
    {
        $ar1 = $request->field_name;
        $ar2 = $request->field_type;
        $ar3 = $request->field_option;
        $arr = [];
        foreach ($ar1 as $idx => $val) {
            $arr[$idx] = [$val, $ar2[$idx], $ar3[$idx]];
        }

        $form = Form::create([
            'form_name' => $request->form_name
        ]);

        foreach ($arr as $each) {
            $form_field = FormField::create([
                'form_id' => $form->id,
                'field_name' => $each[0],
                'field_type' => $each[1],
            ]);

            if ($each[2]) {
                foreach ($each[2] as $option) {
                    FieldOption::create([
                        'form_field_id' => $form_field->id,
                        'options' => $option,
                    ]);
                }
            }
        }

        return redirect()->back();
    }

    public function edit_form($id)
    {
        $data = [
            'fields' => FieldType::all(),
            'forms'  => Form::find($id),
            'form_fields'  => FormField::with('options')->where('form_id', $id)->get(),
        ];

        return view('admin.form.editForm', $data);
    }

    public function update_form(Request $request, $id)
    {
        $ar1 = $request->field_name;
        $ar2 = $request->field_type;
        $ar3 = $request->field_option;
        $arr = [];

        foreach ($ar1 as $idx => $val) {
            $arr[$idx] = [$val, $ar2[$idx], $ar3[$idx]];
        }

        $form = Form::where('id', $id)
        ->update([
            'form_name' => $request->form_name
        ]);

        $form_fields = FormField::where('form_id', $id)
        ->get();

        FormField::where('form_id', $id)
        ->delete();

        foreach($form_fields as $field){
            FieldOption::where('form_field_id', $field->id)
            ->delete();
        }

        foreach ($arr as $each) {
            $form_field = FormField::create([
                'form_id' => $id,
                'field_name' => $each[0],
                'field_type' => $each[1],
            ]);

            if ($each[2]) {
                foreach ($each[2] as $option) {
                    FieldOption::create([
                        'form_field_id' => $form_field->id,
                        'options' => $option,
                    ]);
                }
            }
        }

        return redirect()->back();
    }

    public function delete_form($id)
    {
        Form::find($id)->delete();
        return redirect()->back();
    }
}
