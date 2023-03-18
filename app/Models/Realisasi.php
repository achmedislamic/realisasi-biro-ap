<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;
use Znck\Eloquent\Relations\BelongsToThrough;

class Realisasi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tahapanApbd(): BelongsTo
    {
        return $this->belongsTo(TahapanApbd::class);
    }

    public function subOpd(): BelongsTo
    {
        return $this->belongsTo(SubOpd::class);
    }

    public function subKegiatan(): BelongsTo
    {
        return $this->belongsTo(SubKegiatan::class);
    }

    public function subRincianObjekBelanja(): BelongsTo
    {
        return $this->belongsTo(SubRincianObjekBelanja::class, 'sub_rincian_objek_id');
    }
}
