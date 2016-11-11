<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;

class ManufacturerRequest extends Request {

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
			'manufacturer' => 'required|unique:manufacturer,name'
		];
	}

	public function messages()
	{
		return [
			'manufacturer.required' => 'Chưa có tên Manufacturer',
			'manufacturer.unique' => 'Manufacturer đã tồn tại'	
		];
	}

}
