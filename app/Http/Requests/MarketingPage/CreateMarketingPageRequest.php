<?php

namespace App\Http\Requests\MarketingPage;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CreateMarketingPageRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'              => ['required', 'string'],
            'name_en'              => ['required', 'string'],
            'desc_ar'              => ['required', 'string'],
            'desc_en'              => ['required', 'string'],
            'product_type_id'      => ['required', 'integer'],
            'marketing_page_photo' => ['file', 'mimes: jpeg,jpg,png'],
        ];
    }
}
