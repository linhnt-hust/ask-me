@if ($paginator->hasPages())
<div class="pagination">
    @if ($paginator->onFirstPage())
        <a class="prev-button" disabled><i class="icon-angle-left"></i></a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="prev-button" disabled><i class="icon-angle-left"></i></a>
    @endif

        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="current">{{ $page }}</span>
                    @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                        <a href="{{ $url }}">{{ $page }}</a>
                    @elseif ($page == $paginator->lastPage() - 1)
                        <span>...</span>
                    @endif
                @endforeach
            @endif
        @endforeach

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="next-button"><i class="icon-angle-right"></i></a>
    @else
        <a class="next-button" disabled><i class="icon-angle-right"></i></a>
    @endif
</div><!-- End pagination -->
@endif

