<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model {

	protected $table = 'cates';

	protected $fillable = ['name', 'alias', 'order', 'keywords', 'description'];

	public $timestamps = false;

	//quan hệ 1:n dùng hasMany
	//1 danh mục có nhiều sản phẩm ^^
	public function product()
	{
		return $this->hasMany('App\Product');
	}

}
