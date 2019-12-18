<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumberTag extends Model
{
    protected $table = 'tag_to_numbers';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id')->select('id', 'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub_tag()
    {
        return $this->belongsTo(SubTag::class, 'sub_tag_id')->select('id', 'name');
    }
}
