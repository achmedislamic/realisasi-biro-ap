<?php

namespace App\Enums;

enum RoleName: string
{
    case ADMIN = 'admin';
    case BIDANG = 'bidang';
    case SUB_OPD = 'sub_opd';

    public function teks(): string
    {
        return match($this) {
            self::ADMIN => __('Administrator'),
            self::BIDANG => __('Bidang'),
            self::SUB_OPD => __('Sub OPD'),
        };
    }
}
