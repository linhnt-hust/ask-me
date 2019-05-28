@if ($paginator->hasPages())
    <ul class="pagination m-t-0">
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <a href="#"><i class="fa fa-angle-left"></i></a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a>
            </li>
        @endif

        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">
                            <a href="#">{{ $page }}</a>
                        </li>
                    @else (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                        <li>
                            <a href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a>
            </li>
        @else
            <li class="disabled">
                <a href=""><i class="fa fa-angle-right"></i></a>
            </li>
        @endif
    </ul>
@endif
