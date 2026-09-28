<?php

namespace App\Domains\Identity\DTOs\forgetPassword;

use App\Common\ValueObjectSystem\EmailVO;

class ForgetPasswordDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly EmailVO $email,
    ) {}


    public static function fromArray(array $data)
    {
        return new self(
            email: EmailVO::from($data['email']),
        );
    }
}
