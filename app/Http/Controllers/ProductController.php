<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tags;
use App\Manufacturer;
use Request;
use App\Http\Requests\ProductRequest;
use App\Cate;
use App\Product;
use DB, Auth, File; 
use App\ProductImage;

class ProductController extends Controller {

	public function getList()
	{
		$data = Product::leftjoin('cates', 'products.cate_id', '=' , 'cates.id')
						->select('products.id', 'products.image_thumb', 'products.name as pName', 'products.created_at', 'products.price', 'cates.name as cName')
						->get()->toArray();
		return view('admin.product.list', compact('data'));
	}

	public function getAdd()
	{
		$listTags = Product::getListTags();
		$listManufacturer = Product::getListManufacturer();
		$parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
		return view('admin.product.add', compact('parent', 'listTags', 'listManufacturer'));
	}

	public function postAdd(ProductRequest $request)
	{
		$listTagsOld = array();
		foreach ($request->tags as $tag) {
			if (array_key_exists($tag, Product::getListTags())) {
				array_push($listTagsOld, $tag);
			}else{
				$dbTags = new Tags();
				$dbTags->name = $tag;
				$dbTags->save();
				array_push($listTagsOld, $dbTags->id);
			}
		}

		$listManufacturerOld = array();
		foreach ($request->txtMake as $manufacturer) {
			if (array_key_exists($manufacturer, Product::getListManufacturer())) {
				array_push($listManufacturerOld, $manufacturer);
			}else{
				$dbManufacturer = new Manufacturer();
				$dbManufacturer->name = $manufacturer;
				$dbManufacturer->save();
				array_push($listManufacturerOld, $dbTags->id);
			}
		}
		
		$image_arr = explode('/', $request->fImages);
		$count = count($image_arr);				

		$product = new Product();
		$product->tags = implode(',', $listTagsOld);
		$product->make = implode(',', $listManufacturerOld);
		$product->name = $request->txtName;
		$product->alias = convert_vi_to_en($request->txtName);
		$product->price = $request->txtPrice;
		$product->price_old = $request->txtPriceOld;
		$product->quantity = $request->txtQuantity;
		$product->cate_id = $request->cate_id;
		$product->intro = $request->txtIntro;
		$product->content = $request->txtContent;
		$product->user_id = /*Auth::user()->id*/ 1;
		$product->image_link = $request->fImages;
		$product->alt = $request->txtAltImage;
		$product->image_thumb = URL().'/public/upload/_thumbs/Images/'.$image_arr[$count-1];
		//$request->file('fImages')->move('/public/uploads/', $product->image);
		$product->keywords = $request->txtKeywords;
		$product->description = $request->txtDescription;
		if($product->save()){
			$product_id = $product->id;
			$dataImg = $request->detailImg;
			$dataAlt = $request->txtAltImageDetail;
			foreach ($dataImg as $key => $img) {
				if ($img != null) {
					$productImage = new ProductImage();
					if (array_key_exists($key, $dataAlt)) 
					{
						$productImage->alt = $dataAlt[$key];
					}
					
					$productImage->image = $img;
					$image_arr_detail = explode('/', $img);
					$count_detail = count($image_arr_detail);	
					$productImage->image_thumb =  URL().'/public/upload/_thumbs/Images/'.$image_arr_detail[$count_detail-1];
					$productImage->product_id = $product_id;
					$productImage->save();		
				}
			}

			$message = ['level' => 'success', 'flash_message' => 'Tạo thành công Sản Phẩm <b>'.$request->txtName.'</b>'];
		}else{
			$message = ['level' => 'danger', 'flash_message' => 'Tạo không thành công Sản Phẩm <b>'.$request->txtName.'</b>'];
		}

		return redirect()->route('admin.product.list')->with($message);
	}
	public function getEdit($id=0)
	{
		$product = Product::find($id);
		if (isset($product) && $product && $product != null) {
			$data = $product->toArray();
			$imgDetail = Product::find($id)->pimage()->get()->toArray();
			$listManufacturer = Product::getListManufacturer();
			$parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
			$listTags = Product::getListTags();
			return view('admin.product.edit', compact('data', 'parent', 'imgDetail', 'listTags', 'listManufacturer'));
		}else{
			$message = ['level' => 'danger', 'flash_message' => 'Không có thông tin'];
			return redirect()->route('admin.product.list')->with($message);
		}
		
	}

	public function getDelImg($id)
	{
		if (Request::ajax()) {
			$idHinh = (int)Request::get('idHinh');
			$imageDetail = ProductImage::find($idHinh);
			if (!empty($imageDetail)) {
				if (File::exists($imageDetail->image)) {
					File::delete($imageDetail->image);
				}
				$imageDetail->delete();
			}
			return 'Okie';
		}
	}

	public function postEdit(Request $request)
	{

		$listTagsOld = array();
		
		foreach (Request::input('tags') as $tag) {
				if (array_key_exists($tag, Product::getListTags())) {
					array_push($listTagsOld, $tag);
				}else{
					$dbTags = new Tags();
					$dbTags->name = $tag;
					$dbTags->save();
					array_push($listTagsOld, $dbTags->id);
				}
		}

		$listManufacturerOld = array();
		foreach (Request::input('txtMake') as $manufacturer) {
			if (array_key_exists($manufacturer, Product::getListManufacturer())) {
				array_push($listManufacturerOld, $manufacturer);
			}else{
				$dbManufacturer = new Manufacturer();
				$dbManufacturer->name = $manufacturer;
				$dbManufacturer->save();
				array_push($listManufacturerOld, $dbTags->id);
			}
		}

		$product = Product::find(Request::input('id'));
		if ($product) {
			$image_arr = explode('/', Request::input('fImages'));
			$count = count($image_arr);
			$product->name = Request::input('txtName');
			$product->tags = implode(',', $listTagsOld);
			$product->make = implode(',', $listManufacturerOld);
			$product->alias = convert_vi_to_en(Request::input('txtName'));
			$product->price = Request::input('txtPrice');
			$product->price_old = Request::input('txtPriceOld');
			$product->quantity = Request::input('txtQuantity');
			$product->cate_id = Request::input('cate_id');
			$product->intro = Request::input('txtIntro');
			$product->content = Request::input('txtContent');
			$product->user_id = /*Auth::user()->id*/1;
			$product->image_link = Request::input('fImages');
			$product->alt = Request::input('txtAltImage');
			$product->image_thumb = URL().'/public/upload/_thumbs/Images/'.$image_arr[$count-1];
			$product->keywords = Request::input('txtKeywords');
			$product->description = Request::input('txtDescription');
			if($product->save()){
			$dataImg = Request::input('detailImg');
			$idDetail = Request::input('idDetail');
			$dataAlt = Request::input('txtAltImageDetail');

			
			if ($dataImg != null) {
				foreach ($dataImg as $key => $img) {
					if (array_key_exists($key, $idDetail)) 
					{
						$productImage = ProductImage::find($idDetail[$key]);
					}else{
						$productImage = new ProductImage();
					}
					if (array_key_exists($key, $dataAlt)) 
					{
						$productImage->alt = $dataAlt[$key];
					}
					if ($img != NULL) {
						$productImage->image = $img;
					}	
					
					$image_arr_detail = explode('/', $img);
					$count_detail = count($image_arr_detail);	
					$productImage->image_thumb =  URL().'/public/upload/_thumbs/Images/'.$image_arr_detail[$count_detail-1];
					$productImage->product_id = Request::input('id');
					$productImage->save();		
				}
			}
			
				$message = ['level' => 'success', 'flash_message' => 'Cập nhật thành công Sản Phẩm <b>'.Request::input('txtName').'</b>'];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Cập nhật không thành công Sản Phẩm <b>'.Request::input('txtName').'</b>'];
			}
		}
		

		return redirect()->route('admin.product.list')->with($message);
	}
	public function getDelete($id=0)
	{
		$product = Product::find($id);
		if (isset($product) && $product && $product != null) {
			if ($product->delete()) {
				$message = ['level' => 'success', 'flash_message' => 'Xóa Thành Công <b>'. $product->toArray()['name'].'</b>'];
			}else{
				$message = ['level' => 'danger', 'flash_message' => 'Xóa Không Thành Công <b>'. $product->toArray()['name'] .'</b>'];
			}
		}else{
			$message = ['level' => 'danger', 'flash_message' => 'Không có thông tin'];
		}
		return redirect()->route('admin.product.list')->with($message);
	}

}
