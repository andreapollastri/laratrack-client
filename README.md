# Laratrack Client
 Error Tracking Client For Laravel

## Installation

- Install client vendor:
```shell
composer require andreapollastri/laratrack
```

- Update app/Exceptions/Handler.php file adding:
```php
    public function report(Throwable $exception)
    {
        $log = New \Andr3a\Laratrack\Laratrack();
        $log->shouldReport($exception);

        parent::report($exception);
    }
```
- Add these vars into your .env file:
```
LARATRACK_API_KEY=<YOUR-LARATRACK-API-KEY>
LARATRACK_ENDPOINT=<YOUR-LARATRACK-API-URL>
```
