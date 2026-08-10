<?php

namespace App\Domains\Identity\Http\Resources\Login;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domains\Identity\DTOs\Login\LoginResultDTO;
use Illuminate\Http\Request;

class LoginResource extends JsonResource
{
    /** @var LoginResultDTO */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'token' => $this->token,
            'user' => [
                'id'    => $this->user->id,
                'name'  => $this->user->name,
                'email' => $this->user->email->value(),
            ]
        ];
    }
}
