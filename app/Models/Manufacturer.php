<?php namespace Cyclepedia\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cyclepedia\Traits\EloquentTrait;

class Manufacturer extends Model implements SluggableInterface {

    use SluggableTrait;
    use EloquentTrait;

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to'    => 'slug',
    );

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function scopeSearch($query, $search)
    {
        return $query->where('name','LIKE',"%$search%");
    }

    public function components()
    {
        return $this->hasMany('Component');
    }
    
}