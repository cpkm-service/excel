<?php

namespace Cpkm\Excel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public $type = 'store';
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
        $this->rules = [
        ];
        foreach(config('excel.import.form.fields') as $key => $field) {
            $this->rules[$key]   =  array_merge($field['api_rules']['common'],$field['api_rules'][$this->type]??[]);
        }
        return $this->rules;
    }

    public function attributes(){
        $data = [];
        foreach(config('excel.import.form.fields') as $key => $field) {
            $data[$key]   =  __($field['text']);
        }
        return $data;
    }
}
