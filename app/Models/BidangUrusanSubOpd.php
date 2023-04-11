<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, Pivot};

class BidangUrusanSubOpd extends Pivot
{
    use HasFactory;

    protected $table = 'bidang_urusan_sub_opds';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['subOpd'];

    public function bidangUrusan(): BelongsTo
    {
        return $this->belongsTo(BidangUrusan::class);
    }

    public function subOpd(): BelongsTo
    {
        return $this->belongsTo(Opd::class);
    }

    public function scopePencarian($query, string $cari = '')
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('sub_opd.nama', $cari);
            });
        });
    }
}
