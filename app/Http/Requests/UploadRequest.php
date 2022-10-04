<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UploadRequest extends FormRequest
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
        $rules = [
            'filename' => 'required'
        ];
        $files = count($this->input('files'));
        foreach(range(0, $files) as $index) {
            $rules['files.' . $index] = 'image|mimes:jpeg,png|max:1000';
        }
        return $rules;
    }
}
