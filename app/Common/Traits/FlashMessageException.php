<?php

namespace App\Common\Traits;

use Illuminate\Support\Facades\Validator;
use Throwable;

trait FlashMessageException
{

    protected function handleException(Throwable $exception): void
    {
        report($exception);

        $this->addError(
            'general',
            $exception->getMessage()
        );
    }
    public function flashValidationMessage(array $data, array $rules): array
    {
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $this->dispatch(
                'notify',
                type: 'error',
                message: 'Please review the form.',
                errors: $validator->errors()->all()
            );
        }
        return $validator->validated();
    }
}
