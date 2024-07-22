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
}
