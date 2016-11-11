<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Session;
use App\CatePost;

class CatePostController extends Controller {

	public function getList()
	{
		$data = CatePost::get()->toArray();
		return view('admin.catepost.list', compact('data'));
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

}
