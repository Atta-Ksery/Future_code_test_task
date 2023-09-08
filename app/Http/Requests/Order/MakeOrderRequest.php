<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class MakeOrderRequest extends BaseApiRequest
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
            'productIds'    => ['required', 'array'],
            'amounts'       => ['required', 'array'],
            'productIds.*'  => ['integer'],
            'amounts.*'     => ['integer'],
            'seller_id'     => ['required', 'integer'],
        ];
    }
}
