<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory, HasAdvancedFilter;

  protected $fillable = [
    'name',
    'slug',
  ];

  public $orderable = [
    'id',
    'name',
    'slug',
  ];

  public $filterable = [
    'id',
    'name',
    'slug',
  ];

  public function users(): HasMany
  {
    return $this->hasMany(User::class);
  }
}