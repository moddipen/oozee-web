<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class News extends Model implements HasMedia
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

    public function getNewsById($id)
    {
        return $this->hydrate(
            DB::select(
                'call select_news_by_id('.$id.')'
            )
        )->first();
    }

    public function getNewsBySlug($slug)
    {
        return $this->hydrate(
            DB::select(
                'call select_news_by_slug('.$slug.')'
            )
        )->first();
    }

    public function getNews()
    {
        return $this->hydrate(
            DB::select(
                'call select_news()'
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
