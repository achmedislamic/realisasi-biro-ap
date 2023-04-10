<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, Pivot};
use Illuminate\Database\Query\Builder;

class BidangUrusanOpd extends Pivot
{
    use HasFactory;

    protected $table = 'bidang_urusan_opds';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['opd'];

    public function bidangUrusan(): BelongsTo
    {
        return $this->belongsTo(BidangUrusan::class);
    }

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class);
    }

    public function scopePencarian($query, string $cari = '')
    {
        return $query->when($cari, function ($query) use ($cari) {
            $query->where(function ($query) use ($cari) {
                $query->search('opd.nama', $cari);
            });
        });
    }
}
