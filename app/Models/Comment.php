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

    protected $fillable = ['content',];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    protected function setKeysForSaveQuery($query)
    {
        $query->where('comment_id', '=', $this->getAttribute('comment_id'))->where('news_id', '=', $this->getAttribute('news_id'));

        return $query;
    }

    protected static function booted(): void
    {
        static::creating(function (Comment $comment) {
            // get news id
            $news_id = $comment->news_id;

            // current news comment count
            $current_id = self::where('news_id', $news_id)->count();
            $new_id = $current_id ? $current_id + 1 : 1;

            // set new_id for comment_id
            $comment->comment_id = $new_id;
        });
    }
}
