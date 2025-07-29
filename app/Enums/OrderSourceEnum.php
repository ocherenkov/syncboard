<?php

namespace App\Enums;

enum OrderSourceEnum: string
{
    case ROZETKA = 'rozetka';
    case PROM = 'prom';
    case HOTLINE = 'hotline';
    case OTHER = 'other';
}
