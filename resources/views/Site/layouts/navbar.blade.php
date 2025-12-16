<!-- start navbar -->

@php
    $media = setting('media');
@endphp

<nav class="navbar navbar-expand-lg navbar-light" style="height: 90px">
    <a class="navbar-brand" style="height: 85px; width:200px" href="{{ url('landing') }}"
        onclick='location.href="{{ url('/landing') . '/' }}";'>
        <img src="{{ asset('site/images/logo.png') }}" alt="" style="height: 100%; width:100%">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav m-auto mt-2 mt-lg-0">
            <li class="nav-item active">

                @php
                    $staticpages = Modules\StaticPage\Entities\StaticPage::all();
                @endphp

                @foreach ($staticpages as $staticpage)
            <li class="nav-item">
                <a class="nav-link" href="{{ url('') . '/' }}#section-{{ $staticpage->getTranslation('title', 'en')}}"
                    @if (!Request::is('/')) onclick='location.href="{{ url('') . '/' }}#section-{{$staticpage->getTranslation('title', 'en') }}";' @endif>{{ $staticpage->getTranslation('title', get_current_lang()) }}</a>
            </li>
            @endforeach
            <li class="nav-item">
                <a class="nav-link" href="{{ url('') . '/' }}#section-contact-us"
                    @if (!Request::is('/')) onclick='location.href="{{ url('') . '/' }}#section-contact-us";' @endif>@lang('Contact Us')</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('frontend.getOrg') }}"
                    @if (!Request::is('/')) onclick='location.href="{{ url('/register/org') }}";' @endif>@lang('register as organization')</a>
            </li>

        </ul>
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <a> {{ get_current_lang() == 'ar' ? t_('arabic') : t_('english') }} </a>
            </button>
            <div class="dropdown-menu">

                @foreach (Modules\Language\Models\Language::all() as $Lang)
                    <th class="language" style="width: 200px;" data-code="{{ $Lang->code }}"
                        data-local="{{ $Lang->local }}">
                        <a class="dropdown-item" href="{{ url('admin') . '/lang/' . $Lang->code }}"> {{ $Lang->name }} </a>
                    </th>
                @endforeach
            </div>
        </div>
    </div>
</nav>
<!-- end navbar -->
