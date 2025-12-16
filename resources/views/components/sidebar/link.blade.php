@props(['name','icon'=>'','url'])

<div class="menu-item">
    <!--begin:Menu link-->
    <a class="menu-link" href="{{ $url }}">

        <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
        <span class="menu-title">{{ $name }}</span>
    </a>
    <!--end:Menu link-->
</div>
