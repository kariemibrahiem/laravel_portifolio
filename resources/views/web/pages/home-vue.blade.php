<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#071117">
    <title>{{ data_get($payload, 'branding.siteName', config('app.name')) }}</title>
    @vite(['resources/css/portfolio.css', 'resources/js/portfolio/app.ts'])
</head>

<body>
    <div id="portfolio-app"></div>
    <script id="portfolio-page-data" type="application/json">
        @json($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    </script>
</body>

</html>
