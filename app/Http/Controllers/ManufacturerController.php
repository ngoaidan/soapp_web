<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use App\Manufacturer;

class ManufacturerController extends Controller {

	public function getList()
	{
		$data = Manufacturer::get()->toArray();
		return view('admin.manufacturer.list', compact('data'));
	}

	public function getAdd(Request $addRequest)
	{
		$this->validate($addRequest, 
			['manufacturer' => 'required|unique:manufacturer,name'],
			[
			'manufacturer.required' => 'Chưa có tên Manufacturer',
			'manufacturer.unique' => 'Manufacturer đã tồn tại'
			]);
		$manufacturer = new Manufacturer();
		$manufacturer->name = $addRequest->manufacturer;
		if ($manufacturer->save()) {
			$message = ['level' => 'success', 'flash_message' => 'Tạo thành công <b>'.$addRequest->manufacturer.'</b>'];
			$response = array(
					  'code' => 'success'
					);
		}else{
			$message = ['level' => 'danger', 'flash_message' => 'Tạo không thành công <b>'.$addRequest->manufacturer.'</b>'];
		}

		return redirect()->route('admin.manufacturer.list')->with($message);
	}

	public function postAction(Request $editRequest)
	{
		if ($editRequest->input('action') == 'edit') {
			$id = $editRequest->id;
			$this->validate($editRequest, 
				['manufacturer' => "required|unique:manufacturer,name,$id"],
				[
				'manufacturer.required' => 'Chưa có tên manufacturer',
				'manufacturer.unique' => 'manufacturer đã tồn tại'
				]);
			$manufacturer = Manufacturer::find($id);
			if (isset($manufacturer) && $manufacturer != null) {
				$manufacturer->name = $editRequest->manufacturer;
				if ($manufacturer->save()) {
					$message = ['level' => 'success', 'flash_message' => 'Cập nhật thành công thẻ <b>'.$editRequest->manufacturer.'</b>'];
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
			$manufacturer = Manufacturer::find($id);
			if (isset($manufacturer) && $manufacturer != null) {
				if ($manufacturer->delete()) {
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
		$manufacturer = Manufacturer::find($id);
		if (isset($manufacturer) && $manufacturer != NULL) {
			if ($manufacturer->delete()) {
				$message = ['level' => 'success', 'flash_message' => 'Xóa thành công thẻ <b>'.$manufacturer->name.'</b>'];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Xóa không thành công thẻ <b>'.$manufacturer->name.'</b>'];
			}
		}else{
			$message = ['level' => 'danger', 'flash_message' => 'Không có thông tin'];
		}

		return redirect()->route('admin.manufacturer.list')->with($message);
	}

}
