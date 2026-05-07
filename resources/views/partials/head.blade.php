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

<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'e8dcbb44f73adea20556932f2fab8997cbf3e865';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript>Powered by <a href="https://www.smartsupp.com" target="_blank">Smartsupp</a></noscript>


@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
