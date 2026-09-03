<?php

namespace App\Domains\Patient\Http\Controllers\Patient;


use App\Models\Patient;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DownloadMedicalDocumentController
{
    public function __invoke(
        Patient $patient,
        Media $media
    ) {
        abort_unless(
            $media->model_type === Patient::class
                && (int) $media->model_id === $patient->id
                && $media->collection_name === 'medical_documents',
            404
        );

        return response()->download(
            $media->getPath(),
            $media->file_name,
            [
                'Content-Type' => $media->mime_type,
            ]
        );
    }
}
