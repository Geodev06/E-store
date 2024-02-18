<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">

@php
$logo = DB::table('system_settings')->where('setting_name', 'SYSTEM_LOGO')->first();
$sys_name = DB::table('system_settings')->where('setting_name', 'SYSTEM_NAME')->first();

@endphp

@if($logo)
<link rel="icon" type="image/png" href="{{ asset($logo->value) }}">

@else 
<link rel="icon" type="image/png" href="../assets/img/favicon.png">

@endif
<title>
  {{ $sys_name->value ?? '' }}
</title>