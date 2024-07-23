<?php

namespace App\Models;

use App\Traits\CreatedBy;
use App\Traits\DateFormattable;
use Awobaz\Compoships\Compoships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CreatedBy;
    use Compoships;
    use DateFormattable;

    protected $fillable = ['news_title', 'news_body', 'category_id'];

    protected $hidden = ['deleted_at'];

    // Relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
