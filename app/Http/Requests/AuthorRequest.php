<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $maxYear = Carbon::now()->subYears(18)->year;

        $rules = [
            'name' => 'required|string',
            'surname' => 'required|string',
            'patronymic' => 'required|string',
            'birth_year' => 'required|numeric|min:1|max:' . $maxYear,
            'death_year' => 'numeric|gt:birth_year',
        ];

        return $rules;
    }
}
