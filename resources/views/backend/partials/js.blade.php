<!-- MORE JS SCRIPTS -->
@foreach($js as $j)
<script src="{{ backend_asset ("$j") }}"></script>
@endforeach