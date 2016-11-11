<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\About;
use App\Shop;
class AboutController extends Controller {

	public function getList()
	{
		$data = About::select('id', 'meta_key', 'meta_desc', 'image_thumb', 'title')->orderBy('id', 'DESC')->get()->toArray();
		return view('admin.about.list', compact('data'));
	}

	public function getAdd()
	{
		return view('admin.about.add');
	}

	public function postAdd(Request $request)
	{
		$about = new About;
		$image_arr = explode('/', $request->images);
		$count = count($image_arr);	
		$about->meta_key = $request->txtKeywords;
		$about->meta_desc = $request->txtDescription;
		$about->image = $request->images;
		$about->title = $request->title;
		$about->image_thumb = URL().'/public/upload/_thumbs/Images/'.$image_arr[$count-1];
		if($about->save()){
			$message = ['level' => 'success', 'flash_message' => 'Tạo thành công'];
			return redirect()->route('admin.about.getList')->with($message);
		}
	}

	public function getDelete($id)
	{
		$about = About::find($id);
		if (isset($about) && $about && $about != null) {
			if ($about->delete()) {
				$message = ['level' => 'success', 'flash_message' => 'Xóa Thành Công'];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Xóa Không Thành Công'];
			}
		}else{
			$message = ['level' => 'danger', 'flash_message' => 'Không có thông tin'];
		}
		return redirect()->route('admin.about.getList')->with($message);
	}

	public function getEdit($id=0)
	{
		$about = About::find($id);
		if (isset($about) && $about != null && isset($id)) {
			$data = $about->toArray();
			return view('admin.about.edit', compact('data'));
		}

		$notic = ['level' => 'danger', 'flash_message' => 'Không có thông tin'];
		return redirect()->route('admin.about.getList')->with($notic);
	}
	public function postEdit(Request $request)
	{

		$id = $request->id;
		$about = About::find($id);
		if ($about) {
			$image_arr = explode('/', $request->images);
			$count = count($image_arr);	
			$about->meta_key = $request->txtKeywords;
			$about->meta_desc = $request->txtDescription;
			$about->image = $request->images;
			$about->title = $request->title;
			$about->image_thumb = URL().'/public/upload/_thumbs/Images/'.$image_arr[$count-1];
			if($about->save()){
				$message = ['level' => 'success', 'flash_message' => 'Cập nhật thành công'];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Cập nhật thất bại'];
			}
		}else{
			$message = ['level' => 'warning', 'flash_message' => 'Không có thông tin'];
		}
		
		return redirect()->route('admin.about.getList')->with($message);
	}


	/*Shop Location*/
	public function getListShop()
	{
		$shop = Shop::select('id', 'tel', 'phone', 'email', 'location')->get()->toArray();
		return view('admin.about.listshop', compact('shop'));
	}

	public function getEditShop($id=0)
	{
		$shop = Shop::find($id);
		if (isset($shop) && $shop != null && isset($id)) {
			$data = $shop->toArray();
			return view('admin.about.editshop', compact('data'));
		}

		$notic = ['level' => 'danger', 'flash_message' => 'Không có thông tin'];
		return redirect()->route('admin.about.getListShop')->with($notic);
	}
	public function postEditShop(Request $request)
	{
		$this->validate($request, 
			[
			'txtTel' => 'required|numeric|min:9',
			'txtPhone' => 'required|numeric|min:9',
			'txtEmail' => 'required|e-mail'
			],
			[
			'txtPhone.required' => 'Vui lòng nhập Số Di Động',
			'txtPhone.numeric' => 'Số Di Động phải dạng số',
			'txtPhone.min' => 'Số Di Động ít nhất 9 số',
			'txtTel.required' => 'Vui lòng nhập Số Bàn',
			'txtTel.numeric' => 'Số Bàn phải dạng số',
			'txtTel.min' => 'Số Bàn ít nhất 9 số',
			'txtEmail.required' => 'Vui lòng nhập Email',
			'txtEmail.e_mail' => 'Vui lòng nhập đúng định dạng email',
			]
			);

		$id = $request->id;
		$shop = Shop::find($id);
		if ($shop) {
			$shop->location = $request->txtLocation;
			$shop->tel = $request->txtTel;
			$shop->phone = $request->txtPhone;
			$shop->email = $request->txtEmail;
			if($shop->save()){
				$message = ['level' => 'success', 'flash_message' => 'Cập nhật thành công'];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Cập nhật thất bại'];
			}
		}else{
			$message = ['level' => 'warning', 'flash_message' => 'Không có thông tin'];
		}
		
		return redirect()->route('admin.about.getListShop')->with($message);
	}

}
