<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = ['comment_id', 'news_id'];
    public $incrementing = false;

    public function news()
    {
        $this->belongsTo(News::class);
    }

    protected function setKeysForSaveQuery($query)
    {
        $query->where('comment_id', '=', $this->getAttribute('comment_id'))->where('news_id', '=', $this->getAttribute('news_id'));

        return $query;
    }
}
