<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_uri',
        'content_uri',
        'pdf_uri',
        'level_id'
    ];

    public function categories():BelongsToMany{
        return $this->belongsToMany(Category::class);
    }

    public function level():BelongsTo{
        return $this->belongsTo(Level::class);
    }
}
