<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LoaiSanPham;
use App\Models\NhaSanXuat;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasOne;
use Illuminate\Queue\Jobs\BeanstalkdJob;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\HasSoftDeletedScope;

class SanPham extends Model
{
    use HasFactory;

    use HasFactory;
    /**
    * Chỉ định bảng dữ liệu
    * @var string
    */
   protected $table = 'san_phams';

   /**
    * Chỉ định Primary Key của bảng
    * @var string
    */
   protected $primaryKey = 'sp_id';

   /**
    * Thiết lập cột Thời gian tạo mới
    * @var string
    */
    const CREATED_AT = 'sp_taomoi';
    /**
    * Thiết lập cột Thời gian cập nhật
    * @var string
    */
   const UPDATED_AT = 'sp_capnhat';

   /**
    * Chỉ định cột
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'sp_id',
       'sp_ma',
       'sp_ten',
       'sp_hinhanh',
       'sp_thongtin',
       'sp_gia',
       'sp_taomoi',
       'sp_capnhat',

       'nsx_id',
       'lsp_id',

   ];

   /**
    * Thiết lập quan hệ với sản phẩm
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
   public function loaiSanPham(): BelongsTo
   {
      return $this->belongsTo(LoaiSanPham::class,'lsp_id');
   }

   /**
    * Thiết lập quan hệ với nhà sản xuất
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function nhaSanXuat(): BelongsTo
   {
       return $this->belongsTo(NhaSanXuat::class,'nsx_id');
   }

   use SoftDeletes;
   protected $dates=['deleted_at'];

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
