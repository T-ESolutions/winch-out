<?php

namespace App\Http\Requests\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class CalculateBrandCostRequest extends FormRequest
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
        return [
            'service_id' => 'required|exists:services,id',
            'brand_id' => 'required|exists:brands,id',
            'modell_id' => 'required|exists:modells,id,brand_id,' . $this->brand_id,
            'year_id' => 'required|exists:modell_years,id,modell_id,' . $this->modell_id,
        ];
    }
}
