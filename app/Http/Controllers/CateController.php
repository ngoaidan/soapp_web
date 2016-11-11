<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CateRequest;
use App\Cate;
class CateController extends Controller {

	public function getList()
	{
		$data = Cate::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
		return view('admin.cate.list', compact('data'));
	}

	public function getAdd()
	{
		$parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
		return view('admin.cate.add', compact('parent'));
	}

	public function postAdd(CateRequest $request)
	{
		$cate = new Cate;
		$cate->name = $request->txtCateName;
		$cate->alias = convert_vi_to_en($request->txtCateName);
		$cate->order = $request->txtOrder;
		$cate->parent_id = $request->parent_id;
		$cate->keywords = $request->txtKeywords;
		$cate->description = $request->txtDescription;
		if($cate->save()){
			$message = ['level' => 'success', 'flash_message' => 'Tạo thành công Category '.$request->txtCateName];
			return redirect()->route('admin.cate.list')->with($message);
		}
	}

	public function getDelete($id)
	{
		$parent = Cate::where('parent_id', $id)->count();
		if ($parent == 0) {
			$cate = Cate::find($id);
			if ($cate) {
				if ($cate->delete()) {
					$notic = ['level' => 'danger', 'flash_message' => 'Xóa thành công '.$cate->toArray()['name']];
				}else{
					$notic = ['level' => 'wraning', 'flash_message' => 'Xóa không thành công '.$cate->toArray()['name']];
				}
			}else{
				$notic = ['level' => 'warning', 'flash_message' => 'Không có thông tin'];
			}
		}else{
			echo "<script type = 'text/javascript'>
				alert('Sorry ! You can not delete this category');
				window.location= '";
			echo route('admin.cate.list');

			echo "'
			</script>";
		}
		
		return redirect()->route('admin.cate.list')->with($notic);
	}

	public function getEdit($id=0)
	{
		$data = Cate::find($id);
		if (isset($data) && $data != null && isset($id)) {
			$data = $data->toArray();
			$parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
			return view('admin.cate.edit', compact('parent', 'data'));
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
		$cate = Cate::find($id);
		if ($cate) {
			$cate->name = $request->txtCateName;
			$cate->alias = convert_vi_to_en($request->txtCateName);
			$cate->order = $request->txtOrder;
			$cate->parent_id = $request->parent_id;
			$cate->keywords = $request->txtKeywords;
			$cate->description = $request->txtDescription;
			if($cate->save()){
				$message = ['level' => 'success', 'flash_message' => 'Cập nhật thành công Category '.$request->txtCateName];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Cập nhật thất bại Category '.$request->txtCateName];
			}
		}else{
			$message = ['level' => 'warning', 'flash_message' => 'Không có thông tin'];
		}
		
		return redirect()->route('admin.cate.list')->with($message);
	}

}
