<?php

namespace App\Http\Requests;

use App\Utilities\AppConstants;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInvestmentPackageRequest extends FormRequest
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
            'investment_category_id' => 'filled|exists:investment_package_categories,id',
            'package_name' => ['filled', Rule::unique('investment_packages')->ignore($this->id)],
            'unit_price' => 'filled|numeric|min:1',
            'duration' => 'filled|integer|min:1',
            'return_rate' => 'filled|numeric|min:1',
            'package_available_units' => 'filled|integer|min:1',
            'package_description' => 'nullable',
            'package_image_url' => 'image|nullable|string',
            'status' => 'filled|string|in:' . AppConstants::$ACTIVE . ',' . AppConstants::$INACTIVE
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
