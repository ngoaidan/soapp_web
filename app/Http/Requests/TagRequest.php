<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;

class TagRequest extends Request {

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
			'tags' => 'required|unique:tags,name'
		];
	}

	public function messages()
	{
		return [
			'tags.required' => 'Chưa có tên tags',
			'tags.unique' => 'Tags đã tồn tại'	
		];
	}

}
