<!-- MORE CSS -->
@foreach($css as $c)
    <link rel="stylesheet" href="{{ backend_asset("$c") }}">
@endforeach