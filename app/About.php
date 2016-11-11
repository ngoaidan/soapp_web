<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class About extends Model {

	protected $table = 'abouts';

	protected $fillable = ['id', 'meta_key', 'meta_desc', 'image'];

	public $timestamps = false;
	public static function getTags()
	{
		return DB::table('tags')->orderBy('id', 'ASC')->take(15)->get();
	}

	public static function checkActiveMenu($id)
	{
		$checkParent = DB::table('cates')->select('parent_id')->where('id', $id)->first();
		if ($checkParent->parent_id == 0) {
			return $id;
		}else{
			return $checkParent->parent_id;
		}
	}

}
