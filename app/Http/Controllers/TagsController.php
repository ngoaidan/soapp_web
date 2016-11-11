<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Tags;

class TagsController extends Controller {

	public function getList()
	{
		$data = Tags::get()->toArray();
		return view('admin.tags.list', compact('data'));
	}

	public function getAdd(Request $addRequest)
	{
		$this->validate($addRequest, 
			['tags' => 'required|unique:tags,name'],
			[
			'tags.required' => 'Chưa có tên tags',
			'tags.unique' => 'Tags đã tồn tại'
			]);
		$tags = new Tags();
		$tags->name = $addRequest->tags;
		if ($tags->save()) {
			$message = ['level' => 'success', 'flash_message' => 'Tạo thành công thẻ <b>'.$addRequest->tags.'</b>'];
			$response = array(
					  'code' => 'success'
					);
		}else{
			$message = ['level' => 'danger', 'flash_message' => 'Tạo không thành công thẻ <b>'.$addRequest->tags.'</b>'];
		}

		return redirect()->route('admin.tags.list')->with($message);
	}

	public function postAction(Request $editRequest)
	{
		if ($editRequest->input('action') == 'edit') {
			$id = $editRequest->id;
			$this->validate($editRequest, 
				['tags' => "required|unique:tags,name,$id"],
				[
				'tags.required' => 'Chưa có tên tags',
				'tags.unique' => 'Tags đã tồn tại'
				]);
			$tags = Tags::find($id);
			if (isset($tags) && $tags != null) {
				$tags->name = $editRequest->tags;
				if ($tags->save()) {
					$message = ['level' => 'success', 'flash_message' => 'Cập nhật thành công thẻ <b>'.$editRequest->tags.'</b>'];
					//Session::flash($message);
					Session::flash('flash_message_action', 'Cập nhật thành công');
					$response = array('code' => 'success');
				}else{
					Session::flash('flash_message_action', 'Cập nhật không thành công');
					$response = array('code' => 'success');
				}
			}
		}
		if ($editRequest->input('action') == 'delete') {
			$id = $editRequest->id;
			$tags = Tags::find($id);
			if (isset($tags) && $tags != null) {
				if ($tags->delete()) {
					Session::flash('flash_message_action', 'Xóa thành công');
					$response = array('code' => 'success');
				}else{
					Session::flash('flash_message_action', 'Xóa không thành công');
					$response = array('code' => 'success');
				}
			}
		}
		echo json_encode($response);
	}

	public function getDelete($id = 0)
	{
		$tags = Tags::find($id);
		if (isset($tags) && $tags != NULL) {
			if ($tags->delete()) {
				$message = ['level' => 'success', 'flash_message' => 'Xóa thành công thẻ <b>'.$tags->name.'</b>'];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Xóa không thành công thẻ <b>'.$tags->name.'</b>'];
			}
		}else{
			$message = ['level' => 'danger', 'flash_message' => 'Không có thông tin'];
		}

		return redirect()->route('admin.tags.list')->with($message);
	}

}
