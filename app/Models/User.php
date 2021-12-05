<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens;
  use HasFactory;
  use HasProfilePhoto;
  use Notifiable;
  use TwoFactorAuthenticatable;
  use HasAdvancedFilter;

  /**
   * The attributes that are mass assignable.
   *
   * @var string[]
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'gender',
    'phone',
    'role_id'
  ];

  public $orderable = [
    'id',
    'name',
    'email',
    'email_verified_at',
    'phone',
    'role.name',
  ];

  public $filterable = [
    'id',
    'name',
    'email',
    'email_verified_at',
    'phone',
    'role.name',
  ];

  public function role(): BelongsTo
  {
    return $this->belongsTo(Role::class);
  }

  public function posts(): HasMany
  {
    return $this->hasMany(Post::class);
  }

  protected $withCount = [
    'role',
    'posts'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array
   */
  protected $hidden = [
    'password',
    'remember_token',
    'two_factor_recovery_codes',
    'two_factor_secret',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * The accessors to append to the model's array form.
   *
   * @var array
   */
  protected $appends = [
    'profile_photo_url',
  ];
}