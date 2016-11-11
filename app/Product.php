<?php 
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $table = 'products';

	protected $fillable = ['name', 'alias', 'price', 'intro', 'content', 'image', 'keywords', 'description', 'user_id', 'cate_id'];

	//public $timestamps = false;

	//Quan hệ 1:1
	//1 sản phẩm thuộc về 1 danh mục ^^
	public function cate()
	{
		return $this->belongTo('App\Cate');
	}

	//1 sản phẩm thuộc 1 user đăng
	public function user()
	{
		return $this->belongTo('App\User');
	}

	//1 sản phẩm có nhiều hình
	public function pimage()
	{
		return $this->hasMany('App\ProductImage');
	}

	public static function getListTags()
	{
		$result = DB::table('tags')->select('id', 'name')->get();
		$listTags = array();
		foreach ($result as $val) {
			$listTags[$val->id] =  $val->name;
		}
		return $listTags;
	}

	public static function getListManufacturer()
	{
		$result = DB::table('manufacturer')->select('id', 'name')->get();
		$listManufacturer = array();
		foreach ($result as $val) {
			$listManufacturer[$val->id] =  $val->name;
		}
		return $listManufacturer;
	}
}
