<?php

namespace App\Common\Exceptions;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Throwable;

trait HandlesLivewireExceptions
{
    protected function handleException(Throwable $exception): void
    {
        report($exception);

        $this->addError(
            'general',
            $exception->getMessage()
        );
    }
    protected function validateRequest()
    {
        $validator = Validator::make(
            [
                'name'     => $this->name,
                'email'    => $this->email,
                'password' => $this->password,
            ],
            $this->rules()
        );

        if ($validator->fails()) {

            $this->dispatch(
                'notify',
                type: 'error',
                message: 'Please review the form.',
                errors: $validator->errors()->all()
            );

            return;
        }

        return $validator->validated();
    }

    protected function success(string $message): void
    {
        session()->flash('success', $message);
    }

    protected function error(string $message): void
    {
        session()->flash('error', $message);
    }

    protected function warning(string $message): void
    {
        session()->flash('warning', $message);
    }

    protected function info(string $message): void
    {
        session()->flash('info', $message);
    }
}
