<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model {

	protected $table = 'product_images';

	protected $fillable = ['image', 'product_id'];

	public $timestamps = false;

	//1 hình thuộc 1 sản phẩm
	public function product()
	{
		return $this->belongTo('App\Product');
	}

}
