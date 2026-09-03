<?php

namespace App\Domains\Patient\Http\Controllers\Patient;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\Controller;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;
use App\Models\Patient;

class ViewMedicalDocumentController extends Controller
{
    use ApiResponse, LogMessage;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */



    /*
    |--------------------------------------------------------------------------
    | Invoke
    |--------------------------------------------------------------------------
    */

    public function __invoke(
        Patient $patient,
        Media $media
    ) {
        try {
            abort_unless(
                $media->model_type === Patient::class
                    && (int) $media->model_id === $patient->id
                    && $media->collection_name === 'medical_documents',
                404
            );

            return response()->file(
                $media->getPath(),
                [
                    'Content-Type' => $media->mime_type,
                ]
            );
        } catch (\Throwable $e) {

            $this->logMessage($e);

            return $this->apiResponse(
                null,
                $e->getMessage(),
                500
            );
        }
    }
}
