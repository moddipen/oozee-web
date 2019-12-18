<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

class Cms extends Model
{
    use Sluggable;
    protected $fillable = ['title'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Call store procedures
     */

    public function getCmsById($id)
    {
        return $this->hydrate(
            DB::select(
                'call select_cms_by_id('.$id.')'
            )
        )->first();
    }

    public function getCmsBySlug($slug)
    {
        return $this->hydrate(
            DB::select(
                'call select_cms_by_slug('.$slug.')'
            )
        )->first();
    }

    public function getCms()
    {
        return $this->hydrate(
            DB::select(
                'call select_cms()'
            )
        );
    }

    /**
     * Relations
     */

    /**
     * @return mixed
     */
    public function creator()
    {
        return $this->belongsTo(AdminUser::class, 'created_by')->withTrashed();
    }
}
