<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use App\CatePost;

class CatePostController extends Controller {

	public function getList()
	{
		$data = CatePost::get()->toArray();
		return view('admin.catepost.list', compact('data'));
	}

	public function getAdd()
	{
		$parent = CatePost::get()->toArray();
		return view('admin.catepost.add', ['parent'=>$parent]);
	}

	public function postAdd(Request $request)
	{
		/*validate*/
		$this->validate($request, 
			[
			'txtCateName' => 'required||unique:cates,name'
			],
			[
			'txtCateName.required' => 'Vui lòng nhập Tên Danh Mục',
			'txtCateName.unique' => 'Tên Danh Mục đã tồn tại',
			]
			);

		$catepost = new CatePost;
		$catepost->name = $request->txtCateName;
		$catepost->alias = convert_vi_to_en($request->txtCateName);
		$catepost->order = $request->txtOrder;
		$catepost->meta_key = $request->txtKeywords;
		$catepost->meta_desc = $request->txtDescription;
		if($catepost->save()){
			$message = ['level' => 'success', 'flash_message' => 'Tạo thành công Category '.$request->txtCateName];
			return redirect()->route('admin.catepost.list')->with($message);
		}
	}

	public function getDelete($id = 0)
	{
		$catepost = CatePost::find($id);
		if (isset($catepost) && $catepost != NULL) {
			if ($catepost->delete()) {
				$message = ['level' => 'success', 'flash_message' => 'Xóa thành công thẻ <b>'.$catepost->name.'</b>'];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Xóa không thành công thẻ <b>'.$catepost->name.'</b>'];
			}
		}else{
			$message = ['level' => 'danger', 'flash_message' => 'Không có thông tin'];
		}

		return redirect()->route('admin.catepost.list')->with($message);
	}


	public function getEdit($id=0)
	{
		$data = CatePost::find($id);
		if (isset($data) && $data != null && isset($id)) {
			$data = $data->toArray();
			return view('admin.catepost.edit', compact('data'));
		}
		$notic = ['level' => 'danger', 'flash_message' => 'Không có thông tin'];
		return redirect()->route('admin.cate.list')->with($notic);
	}
	public function postEdit(Request $request)
	{
		$this->validate($request, 
			['txtCateName' => 'required'],
			['txtCateName.required' => 'Vui lòng nhập Category']
			);
		$id = $request->id;
		$catepost = CatePost::find($id);
		if ($catepost) {
			$catepost->name = $request->txtCateName;
			$catepost->alias = convert_vi_to_en($request->txtCateName);
			$catepost->order = $request->txtOrder;
			$catepost->meta_key = $request->txtKeywords;
			$catepost->meta_desc = $request->txtDescription;
			if($catepost->save()){
				$message = ['level' => 'success', 'flash_message' => 'Cập nhật thành công Category '.$request->txtCateName];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Cập nhật thất bại Category '.$request->txtCateName];
			}
		}else{
			$message = ['level' => 'warning', 'flash_message' => 'Không có thông tin'];
		}
		
		return redirect()->route('admin.catepost.list')->with($message);
	}

}
