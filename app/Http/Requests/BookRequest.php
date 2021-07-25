<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        return [
            'title' => 'required|min:3|max:40',
            'description' => 'required|min:10|max:500',
            'author' => 'required|max:50',
            'image' => 'mimes:jpg,jpeg,bmp,png|max:5000',
            'genre' => 'required|max:50',
            'year' => 'required|integer|max:2021',
            'country' => 'required|max:50',
            'pages' => 'required|min:1',
            'book' => 'required'
        ];
    }
}