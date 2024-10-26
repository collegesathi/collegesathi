<?php 
namespace App\Modules\Block\Models;
use Eloquent,Session;

/**
 * BlockDescription Model
 */
 
class BlockDescription extends Eloquent {

	public $timestamps = false;
	
	/**
	 * The database table used by the model.
	 *
	 */
	protected $table = 'block_descriptions';
	
}// end BlockDescription class
