<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\HasSoftDeletedScope;
class TinTuc extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tintuc_tieude',
        'tintuc_tomtat',
        'tintuc_noidung',
        'user_id',
        'tintuc_trangthai',

    ];

    protected $table = 'tin_tucs';

    const CREATED_AT = 'tintuc_taomoi';
    const UPDATED_AT = 'tintuc_capnhat';

    public $timestamps = true;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'tintuc_id';

    /**
     * Get the user that owns the TinTuc
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }

    public function dsTinTuc(){
        $listTinTuc = TinTuc::all();
        return $listTinTuc;
    }

    use SoftDeletes;
    protected $dates = ['deleted_at'];

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

