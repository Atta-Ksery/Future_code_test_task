<?php

namespace App\Http\Requests\MarketingPage;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddDiscountToProductRequest extends BaseApiRequest
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
            'product_id'            => ['required', 'integer'],
            'discount_percentage'   => ['required', 'integer'],
            'start_dateTime'        => ['required', 'date'],
            'end_dateTime'          => ['required', 'date', 'after:start_datetime']
        ];
    }
}
