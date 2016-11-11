<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Shop extends Model {

	protected $table = 'shop';

	protected $fillable = ['id', 'location', 'tel', 'phone', 'email'];

	public $timestamps = false;

}
