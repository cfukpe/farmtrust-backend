<?php

namespace App\Http\Requests;

use App\Utilities\AppConstants;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInvestmentPackageCategoryRequest extends FormRequest
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
            'investment_category_name' => ['filled', Rule::unique('investment_package_categories')->ignore($this->id)],
            'investment_category_description' => 'nullable',
            'investment_category_cover_image' => 'image|nullable|string',
            'status' => 'filled|string|in:' . AppConstants::$ACTIVE . ',' . AppConstants::$INACTIVE
        ];
    }
}