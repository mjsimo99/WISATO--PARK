@if ($paginator->hasPages())
    <ul id="newsPageUL" role="navigation">
        {{-- First Page --}}
             <li class="tcbB tcpBH">
                <a href="{{ $paginator->url(1) }}" class="tcw" rel="prev" aria-label="@lang('pagination.previous')"><img src="{{asset('img/paginationArrowDLeft.png')}}" height="15"></a>
            </li>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="tcbB tcpBH tcw disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span aria-hidden="true"><img src="{{asset('img/slider/sliderArrowLeft.png')}}" height="15"></span>
            </li>
        @else
            <li class="tcbB tcpBH">
                <a href="{{ $paginator->previousPageUrl() }}" class="tcw" rel="prev" aria-label="@lang('pagination.previous')"><img src="{{asset('img/slider/sliderArrowLeft.png')}}" height="15"></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="tcpB tcpBH tcw disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="tcdpB tcw active" aria-current="page"><span>{{ $page }}</span></li>
                    @else
                        <li class="tcpB tcpBH"><a href="{{ $url }}" class="tcw">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="tcbB tcpBH">
                <a href="{{ $paginator->nextPageUrl() }}" class="tcw" rel="next" aria-label="@lang('pagination.next')"><img src="{{asset('img/slider/sliderArrowRight.png')}}" height="15"></a>
            </li>
        @else
            <li class="tcbB tcpBH tcw disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true"><img src="{{asset('img/slider/sliderArrowRight.png')}}" height="15"></span>
            </li>
        @endif
        {{-- Last Page --}}
            <li class="tcbB tcpBH">
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="tcw" rel="prev" aria-label="@lang('pagination.previous')"><img src="{{asset('img/paginationArrowDRight.png')}}" height="15"></a>
            </li>
    </ul>
@endif
