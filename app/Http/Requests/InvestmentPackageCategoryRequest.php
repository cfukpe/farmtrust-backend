<?php

namespace App\Http\Requests;

use App\Utilities\AppConstants;
use Illuminate\Foundation\Http\FormRequest;

class InvestmentPackageCategoryRequest extends FormRequest
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
            'investment_category_name' => 'required|string|max:100|min:3|unique:investment_package_categories,investment_category_name',
            'investment_category_description' => 'nullable',
            'investment_category_cover_image' => 'image|nullable|string',
            'status' => 'required|string|in:' . AppConstants::$ACTIVE . ',' . AppConstants::$INACTIVE
        ];
    }

    public function messages()
    {
        return [
            'in' => 'This is not one of the acceptable options',
        ];
    }
}