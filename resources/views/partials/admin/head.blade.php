<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    {{ filled($title ?? null) ? $title . ' - ' . config('app.name', 'Admin') : config('app.name', 'Laravel') }}
</title>

<link rel="icon" href="{{ asset('assets/images/beastimages/spin.jpg') }}" sizes="any">
<link rel="icon" href="{{ asset('assets/images/beastimages/spin.jpg') }}" type="image/svg+xml">
<link rel="apple-touch-icon" href="{{ asset('assets/images/beastimages/spin.jpg') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
