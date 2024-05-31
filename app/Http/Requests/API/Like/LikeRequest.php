<?php

namespace App\Http\Requests\API\Like;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LikeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => [
                'exists:posts,id',
                Rule::unique('likes')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                })
            ]
        ];
    }
}
