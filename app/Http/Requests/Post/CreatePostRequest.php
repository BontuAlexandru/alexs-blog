<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'title' => 'required|unique:posts|max:128',
            'description' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,bmp,png,gif,svg|dimensions:min_width=1900,min_height=1200,max_width=1980,max_height=1300',
            'content' => 'required',
            'category' => 'required',
        ];
    }
}
