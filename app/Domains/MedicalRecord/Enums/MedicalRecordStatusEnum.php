<?php

namespace App\Domains\MedicalRecord\Enums;

enum MedicalRecordStatusEnum: string
{
    case DRAFT = 'draft';
    case FINALIZED = 'finalized';
}