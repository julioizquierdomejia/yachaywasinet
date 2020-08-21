<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    
    protected $fillable = [
        'title',
        'enabled',
        'slug',
        'competence',
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
        return url('/admin/courses/'.$this->getKey());
    }

    
}
