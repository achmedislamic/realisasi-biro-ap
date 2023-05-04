<?php

namespace App\Enums;

enum RoleName: string
{
  case ADMIN = 'admin';
  case OPD = 'opd';
  case SUB_OPD = 'sub_opd';
  case SEKTOR = 'sektor';
}
