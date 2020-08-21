<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;

class Subject extends Model implements HasMediaCollections, HasMediaConversions
{
    
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    protected $fillable = [
        'title',
        'description',
        'course_id',
        'slug',
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

    public function course_id()
    {
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/subjects/'.$this->getKey());
    }

    public function registerMediaCollections() {
        $this->addMediaCollection('file')
            ->accepts('application/pdf')
            ->maxNumberOfFiles('1')
            ->maxFileSize(5245000);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();
    }
    
}
