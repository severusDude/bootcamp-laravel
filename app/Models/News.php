<?php

namespace App\Models;

use App\Traits\CreatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CreatedBy;

    protected $primaryKey = 'news_id';

    protected $fillable = ['news_title', 'news_body', 'category'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function createComment($content)
    {
        // find current comment_id of current news
        $current_id = $this->comments()->max('comment_id');
        $new_id = $current_id ? $current_id + 1 : 1;

        // add new comment
        return $this->comments()->create([
            'comment_id' => $new_id,
            'created_by' => Auth::user()->id,
            'content' => $content,
        ]);
    }
}
