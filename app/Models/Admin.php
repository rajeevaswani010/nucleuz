<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model{
    protected $guarded = [];
    
	protected $table = 'admin';
	public $timestamps = false;
	protected $primaryKey = 'admin_id';
}
?>