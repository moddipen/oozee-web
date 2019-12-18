<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Blog extends Model implements HasMedia
{
    use Sluggable, HasMediaTrait;
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

    public function getBlogById($id)
    {
        return $this->hydrate(
            DB::select(
                'call select_blog_by_id('.$id.')'
            )
        )->first();
    }

    public function getBlogBySlug($slug)
    {
        return $this->hydrate(
            DB::select(
                'call select_blog_by_slug('.$slug.')'
            )
        )->first();
    }

    public function getBlogs()
    {
        return $this->hydrate(
            DB::select(
                'call select_blogs()'
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
