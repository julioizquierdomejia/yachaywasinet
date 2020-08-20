<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    
    
    protected $fillable = [
        'title',
        'level_id',
        'courses',
        'enabled',
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    
    
    public $timestamps = true;
    
    protected $appends = ['resource_url'];

    public function level_id()
    {
        return $this->belongsTo('App\Models\Level', 'level_id');
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/grades/'.$this->getKey());
    }

    
}
