<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class CatePost extends Model {

	protected $table = 'category_post';

	protected $fillable = ['id', 'meta_key', 'meta_desc', 'name'];

	public $timestamps = false;

}
