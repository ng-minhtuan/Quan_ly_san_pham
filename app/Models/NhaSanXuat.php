<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Scopes\HasSoftDeletedScope;
class NhaSanXuat extends Model
{
    use HasFactory;

    /**
     * Chỉ định bảng dữ liệu
     * @var string
     */
    protected $table = 'nha_san_xuats';

    /**
     * Chỉ định Primary Key của bảng
     * @var string
     */
    protected $primaryKey = 'nsx_id';

    /**
     * Thiết lập Primary Key string
     * Không tự động tăng
     * @var boolean
     */

    public $incrementing = true;

    /**
     * Thiết lập cột Thời gian tạo mới
     * @var string
     */
     const CREATED_AT = 'nsx_taomoi';
     /**
     * Thiết lập cột Thời gian cập nhật
     * @var string
     */
    const UPDATED_AT = 'nsx_capnhat';

    /**
     * Chỉ định cột
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nsx_id',
        'nsx_ten',
        'nsx_mota',
        'nsx_hinhanh',
        'nsx_capnhat',
        'nsx_taomoi',
    ];

    /**
     * Xác định mối quan hệ giữ Nhà sản xuất và Sản phẩm
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sanPham():HasMany
    {
       return $this->hasMany(SanPham::class,'nsx_id');
    }

    /**
     * Xác định mối quan hệ giữ Nhà sản xuất và Sản phẩm
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function loaiSanPham():BelongsToMany
    {
        return $this->belongsToMany(LoaiSanPham::class,'lsp_nsx','lsp_id','nsx_id');
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
