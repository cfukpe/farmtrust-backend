<?php

namespace App\Http\Requests;

use App\Utilities\AppConstants;
use Illuminate\Foundation\Http\FormRequest;

class CreateInvestmentPackageRequest extends FormRequest
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
            'investment_category_id' => 'required|exists:investment_package_categories,id',
            'package_name' => 'required|string|max:100|min:3|unique:investment_packages,package_name',
            'unit_price' => 'required|numeric|min:1',
            'duration' => 'required|integer|min:1',
            'return_rate' => 'required|numeric|min:1',
            'package_available_units' => 'required|integer|min:1',
            'package_description' => 'nullable',
            'package_image_url' => 'image|nullable|string',
            'status' => 'required|string|in:' . AppConstants::$ACTIVE . ',' . AppConstants::$INACTIVE
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'This is not one of the acceptable options',
            'investment_category_id.exists' => 'The selected investment package is invalid.'
        ];
    }
}
