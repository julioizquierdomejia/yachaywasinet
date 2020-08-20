<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    
    protected $fillable = [
        'name',
        'guard_name'
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    
    
    public $timestamps = false;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/roles/'.$this->getKey());
    }

    
}
