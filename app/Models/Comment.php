<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\DateFormattable;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CreatedBy;
    use Compoships;
    use DateFormattable;

    protected $fillable = ['content',];

    protected $hidden = ['deleted_at',];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Comment $comment) {
            // get news id
            $news_id = $comment->news_id;

            // current news comment count
            $current_id = self::where('news_id', $news_id)->withTrashed()->count();
            $new_id = $current_id ? $current_id + 1 : 1;

            // set new_id for comment_id
            $comment->id = $new_id;
        });
    }
}
