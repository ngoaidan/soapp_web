<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request {

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
			'cate_id' => 'required|exists:cates,id',
			'txtName' => 'required|unique:products,name',
			'txtPrice' => 'required|numeric|min:1',
			'txtPriceOld' => 'numeric|min:1',
			'fImages' => 'required'
		];
	}

	public function messages()
	{
		return [
			'cate_id.required' => 'Vui lòng nhập Category',
			'cate_id.exists' => 'Category không có trong danh mục',
			'txtName.required' => 'Vui lòng nhập tên sản phẩm',
			'txtName.unique' => 'Tên sản phẩm đã tồn tại',
			'txtPrice.required' => 'Vui lòng nhập giá tiền',
			'txtPrice.numeric' => 'Giá tiền không hợp lệ',
			'txtPrice.min' => 'Giá tối thiểu là 0 đồng',
			'txtPriceOld.numeric' => 'Giá tiền không hợp lệ',
			'txtPriceOld.min' => 'Giá tối thiểu là 0 đồng',
			'fImages.required' => 'Vui lòng nhập ảnh hiển thị',
			//'fImages.image' => 'Vui lòng chọn đúng định dạng ảnh',	
		];
	}

}
