<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DreamGroupUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group-name' => 'required|max:50',
            'display-name-u' => 'required|max:50|min:1',
            'idols' => 'required|min:2',
            'idols.*' => 'required|exists:idols,id'
        ];
    }
    public function attributes()
    {
        return [
            'display-name' => 'display name',
            'group-name' => 'group name',
        ];
    }
    public function messages()
    {
        return [
            'group-name.required' => 'The group name cannot be empty',
            'idols.required' => 'Choose at least 2 idols to update your group',
            'idols.min' => 'Choose at least 2 idols to update your group',
            'display-name-u.required' => "The display name cannot be empty",
        ];
    }
}
