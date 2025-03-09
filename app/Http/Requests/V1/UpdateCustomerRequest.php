<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $method = $this->getMethod();
        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'name' => ['string', 'max:255'],
                'type' => ['string', 'max:255', Rule::in(['I', 'i', 'B', 'b'])], // I = Individual, B = Business
                'email' => ['string', 'email', 'max:255'],
                'address' => ['string', 'max:255'],
                'city' => ['string', 'max:255'],
                'state' => ['string', 'max:255'],
                'postalCode' => ['string', 'max:255'],
            ];
        } else { //PATCH
            return [
                'name' => ['sometimes', 'string', 'max:255'],
                'type' => ['sometimes', 'string', 'max:255', Rule::in(['I', 'i', 'B', 'b'])], // I = Individual, B = Business
                'email' => ['sometimes', 'string', 'email', 'max:255'],
                'address' => ['sometimes', 'string', 'max:255'],
                'city' => ['sometimes', 'string', 'max:255'],
                'state' => ['sometimes', 'string', 'max:255'],
                'postalCode' => ['sometimes', 'string', 'max:255'],
            ];
        }
    }


    protected function prepareForValidation()
    {
        if($this->has('postalCode')){
            $this->merge([
                'postal_code' => $this->postalCode,
            ]);
        }
    }
}
