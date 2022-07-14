<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\HasSoftDeletedScope;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;


    // SoftDeletes
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'fullname',
        'username',
        'email',
        'gender',
        'birthdate',
        'image',
        'role',
        'confirm_code',
        'confirmed',

    ];

    protected $table = 'users';

    public $timestamps = true;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';




    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the TinTuc that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tinTuc(): HasMany
    {
        return $this->hasMany(TinTuc::class,'user_id');
    }


    /**
     * Truy vấn danh sách người dùng
     * @return array
     */
    public function dsNguoiDung()
    {
        $listUser = User::all();
        return $listUser;
    }

     /**
     * The "bootedHasSoftDeleted" method of the model.
     *
     * @return void
     */
    protected static function bootHasSoftDeleted()
    {
        static::addGlobalScope(new HasSoftDeletedScope);
    }

}
