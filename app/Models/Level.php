<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    
    
    protected $fillable = [
        'title'
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    
    
    public $timestamps = true;
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/levels/'.$this->getKey());
    }

    
}
