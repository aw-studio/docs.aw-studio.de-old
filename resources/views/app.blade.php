<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ mix('/js/app.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
    </head>
    <body>
        @inertia
    </body>
</html>