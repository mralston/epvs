<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Mralston\Epvs\Exceptions\InvalidResponseException;
use Mralston\Epvs\Models\File;
use Mralston\Epvs\Models\Validation;

trait Files
{
    public function upload(string $content, string $filename, ?Validation $validation = null, bool $persist = true): File
    {
        $this->requestPayload = [
            'upload_type' => 'validation'
        ];

        if (!empty($validation)) {
            $this->requestPayload['model_id'] = $validation->id;
        }

        $this->response = Http::withToken($this->token)
            ->timeout(120)
            ->asMultipart()
            ->acceptJson()
            ->attach('file', $content, $filename)
            ->post($this->endpoint . '/uploader', $this->requestPayload);

        $this->response->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw (new InvalidResponseException())->setResponse($this->response);
        }

        return (
            File::find($json['id'] ?? null) ??
            app(File::class)
        )->fillAndHydrate($json, $persist);
    }

    public function uploadFromFilesystem(string $path, ?Validation $validation = null, bool $persist = true): File
    {
        return $this->upload(
            file_get_contents($path),
            basename($path),
            $validation,
            $persist
        );
    }

    public function uploadFromStorage(string $disk, $path, ?Validation $validation = null, bool $persist = true): File
    {
        return $this->upload(
            Storage::disk($disk)->get($path),
            basename($path),
            $validation,
            $persist
        );
    }
}
