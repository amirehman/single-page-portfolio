
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="I'm Amir Rehman. a full stack developer from Pakistan, Specializing in building everything from small business sites to rich interactive web apps. Currently working for Icon Adverting LLC. check out some of my latest work.">
<link rel="shortcut icon" href="{{{ asset('images/assets/favicon.png') }}}">
<title>{{ config('app.name') }} - Full Stack Developer </title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

@yield('headlinks')

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-129128246-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-129128246-1');
</script>
