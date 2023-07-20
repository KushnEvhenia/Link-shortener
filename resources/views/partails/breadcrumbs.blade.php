@unless($breadcrumbs->isEmpty())
    @foreach($breadcrumbs as $breadcrumb)

        @if(!is_null($breadcrumb->url) && !$loop->last)
            <a style="color:grey;" href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }} ></a></li>
        @else
            <a style="color:#0074FF;">{{ $breadcrumb->title }}</a>
        @endif

    @endforeach
@endunless 