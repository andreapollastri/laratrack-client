<?php

namespace Andr3a\Laratrack;

class Laratrack
{
    private function isNotFound($exception): bool
    {
        $notFound = false;
        if (method_exists($exception, 'getStatusCode')) {
            if ($exception->getStatusCode() == 404) {
                $notFound = true;
            }
        }

        return $notFound;
    }

    private function sendReport($exception, $type = 'error'): void
    {
        try {
            $ch = curl_init(config('laratrack.endpoint'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                'error' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'url' => request()->fullUrl(),
                'method' => request()->method(),
                'request' => request()->all(),
                'header' => request()->header(),
                'user_agent' => request()->userAgent(),
                'ip' => request()->ip(),
                'user_id' => auth()->check() ? auth()->user()->id : null,
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'apikey: '.config('laratrack.api_key'),
                'type: '.$type,
            ]);
            curl_exec($ch);
            curl_close($ch);
        } catch (\Throwable $th) {
            //
        }
    }

    public function shouldReport($exception)
    {
        if ($this->isNotFound($exception)) {
            $this->sendReport($exception, 'not-found');
        } else {
            $this->sendReport($exception);
        }
    }
}
