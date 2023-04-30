<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model{
    use SoftDeletes;
    protected $guarded = [];
    protected $table = 'ls_licenses';
    protected $fillable = ['user_id', 'created_by', 'domain', 'license_key', 'status', 'expiration_date', 'is_trial', 'is_lifetime'];
}
?>