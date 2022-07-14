<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\HasSoftDeletedScope;
class LoaiSanPham extends Model
{
    use HasFactory;
     /**
     * Chỉ định bảng dữ liệu
     * @var string
     */
    protected $table = 'loai_san_phams';

    /**
     * Chỉ định Primary Key của bảng
     * @var string
     */
    protected $primaryKey = 'lsp_id';

    /**
     * Thiết lập cột Thời gian tạo mới
     * @var string
     */
     const CREATED_AT = 'lsp_taomoi';
     /**
     * Thiết lập cột Thời gian cập nhật
     * @var string
     */
    const UPDATED_AT = 'lsp_capnhat';

    /**
     * Chỉ định cột
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'lsp_id',
        'lsp_ten',
        'lsp_ghichu',
        'lsp_slug',
        'lsp_parent_id',
        'lsp_taomoi',
        'lsp_capnhat',
    ];

    public function getRouteKeyName(): string
    {
        return 'lsp_slug';
    }

    /**
     * Thiết lập quan hệ với sản phẩm
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasMany
      */
    public function sanPham(): HasMany
    {
       return $this->hasMany(App\Models\SanPham::class);
    }

    /**
     * Thiết lập quan hệ với nhà sản xuất
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nhaSanXuat(): BelongsToMany
    {
        return $this->belongsToMany(App\Models\NhaSanXuat::class,'lsp_nsx','lsp_id','nsx_id');
    }

    /**
     * Thiết lập quan hệ giữ các loại sản phẩm
     */
    public function lsp_parent()
    {
        return $this->belongsTo(LoaiSanPham::class,'lsp_parent_id');
    }

    public function lsp_child()
    {
        return $this->hasMany(LoaiSanPham::class,'lsp_parent_id');
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
