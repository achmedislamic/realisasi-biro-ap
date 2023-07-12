<?php

namespace App\Enums;

enum RoleName: string
{
    case ADMIN = 'admin';
    case BIDANG = 'bidang';
    case UPT = 'upt';

    public function teks(): string
    {
        return match($this) {
            self::ADMIN => __('Administrator'),
            self::BIDANG => __('Bidang'),
            self::UPT => __('UPT'),
        };
    }
}
