<td class="">
    @if ($voice)
        <audio controls style="width: 110px ; height:30px ">
            <source src="{{ $voice }}" type="audio/mpeg">
        </audio>
    @else
        {!! '---' !!}
    @endif
</td>
