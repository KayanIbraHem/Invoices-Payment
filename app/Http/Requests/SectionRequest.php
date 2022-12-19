<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
            return [
                'section_name'=>'required|unique:sections|min:4|max:50',
                'description'=>'required|min:10|max:255'
        ];
    }
    public function messages()
    {
        return[
            'section_name.required'=>'اسم القسم مطلوب',
            'section_name.unique'=>'اسم القسم موجود بالفعل!',
            'section_name.min'=>'يجب الا يقل الاسم عن اربعة حروف',
            'section_name.max'=>'يجب الا يتجاوز اسم القسم عن خمسين حرف',

            'description.required'=>'يجب اداخل وصف للقسم',
            'description.min'=>'يجب الا يقل وصف القسم عن عشرة حروف',
            'description.max'=>'يجب الا يزيد وصف القسم عن 255 حرف',

            
            
        ];
    }
}
