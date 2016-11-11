<?php namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	protected $table = 'posts';

	protected $fillable = ['name', 'alias', 'intro', 'keywords', 'description', 'content', 'image_link', 'image_thumnail', 'views', 'tags', 'views', 'user_id', 'cate_id'];

	//public $timestamps = false;

	public static function getListTags()
	{
		$result = DB::table('tags')->select('id', 'name')->get();
		$listTags = array();
		foreach ($result as $val) {
			$listTags[$val->id] =  $val->name;
		}
		return $listTags;
	}

}
