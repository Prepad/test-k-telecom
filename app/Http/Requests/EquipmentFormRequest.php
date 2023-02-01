<?php

namespace App\Http\Requests;

use App\Models\EquipmentType;
use App\Service\EquipmentTypeService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EquipmentFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'data.*.note' => 'required',
            'data.*.equipment_type_id' => 'required|exists:equipment_types,id',
        ];
        if ($this->post('data')) {
            $data = $this->post('data');
        } else {
            $data[] = $this->all();
        }
        $regularMasks = EquipmentTypeService::getMasks($data);
        foreach ($data as $key => $item) {
            $rules['data.' . $key . '.serial_key'] = 'required|regex:' . $regularMasks[$item['equipment_type_id']];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'empty :attribute',
            'exists' => 'invalid :attribute',
        ];
    }

    public function getValidator(): Validator
    {
        return $this->validator;
    }

    protected function failedValidation(Validator $validator)
    {

    }

}
