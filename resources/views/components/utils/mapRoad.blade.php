@props(['source' => '', 'destination' => ''])
<div>
    <iframe width="100%" height="450" frameborder="0" style="border:0"
        src="https://www.google.com/maps/embed/v1/directions?origin={{ $source }}&destination={{ $destination }}&key={{ env('GOOGLE_API_KEY') }}"
        allowfullscreen>
    </iframe>
</div>
