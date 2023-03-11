<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BidangUrusanOpd extends Pivot
{
    use HasFactory;

    protected $table = 'bidang_urusan_opds';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function bidangUrusan(): BelongsTo
    {
        return $this->belongsTo(BidangUrusan::class);
    }

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class);
    }
}
