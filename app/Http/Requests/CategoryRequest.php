<?php 
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'parent_category_id' => 'nullable|exists:categories,id',
        ];
    }

    public function messages()
   {
    return [
        'name.required' => 'The category name is required.',
        'parent_category_id.exists' => 'The selected parent category does not exist.',
    ];
   }
   protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors(),
        ], 422));
    }
}