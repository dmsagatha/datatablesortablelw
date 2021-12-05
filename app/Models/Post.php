<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory, HasAdvancedFilter;

  protected $fillable = [
    'title',
    'slug',
    'description',
    'user_id',
  ];

  public $orderable = [
    'id',
    'title',
    'slug',
    'description',
    'user.name',
  ];

  public $filterable = [
    'id',
    'title',
    'slug',
    'description',
    'user.name',
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}