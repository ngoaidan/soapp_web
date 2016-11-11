<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model {

	protected $table = 'manufacturer';

	protected $fillable = ['id', 'name', 'keywords', 'description'];

	public $timestamps = false;

}
