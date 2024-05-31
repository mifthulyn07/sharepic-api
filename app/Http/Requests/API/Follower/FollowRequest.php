<?php

namespace App\Http\Requests\API\Follower;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FollowRequest extends FormRequest
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
    // follower_id & user_id notsame follower_id
    public function rules(): array
    {
        return [
            'user_id' => [
                'exists:users,id',
                'different:follower_id',
                Rule::unique('followers')->where(function ($query) {
                    return $query->where('follower_id', auth()->user()->id);
                })
            ]
        ];
    }
}
