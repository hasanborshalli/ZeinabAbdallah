{{--
    Custom pager (not Laravel's default Tailwind/Bootstrap views, which don't
    match this site's design system). Works with any LengthAwarePaginator,
    including several independent ones on the same page (each built with its
    own page-name, e.g. paginate(18, ['*'], 'page_3')) — this component only
    ever touches the paginator instance it's given.
--}}
@props(['paginator'])

@if ($paginator->hasPages())
    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $start = max(1, $current - 1);
        $end = min($last, $current + 1);
    @endphp

    <nav class="pg-nav" aria-label="{{ __('site.pagination.label') }}">
        @if ($paginator->onFirstPage())
            <span class="pg-link pg-link-disabled" aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pg-link" aria-label="{{ __('site.pagination.previous') }}">
                <i class="bi bi-chevron-left"></i>
            </a>
        @endif

        @if ($start > 1)
            <a href="{{ $paginator->url(1) }}" class="pg-link">1</a>
            @if ($start > 2)
                <span class="pg-ellipsis">…</span>
            @endif
        @endif

        @for ($page = $start; $page <= $end; $page++)
            @if ($page === $current)
                <span class="pg-link pg-link-active" aria-current="page">{{ $page }}</span>
            @else
                <a href="{{ $paginator->url($page) }}" class="pg-link">{{ $page }}</a>
            @endif
        @endfor

        @if ($end < $last)
            @if ($end < $last - 1)
                <span class="pg-ellipsis">…</span>
            @endif
            <a href="{{ $paginator->url($last) }}" class="pg-link">{{ $last }}</a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pg-link" aria-label="{{ __('site.pagination.next') }}">
                <i class="bi bi-chevron-right"></i>
            </a>
        @else
            <span class="pg-link pg-link-disabled" aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
        @endif
    </nav>
@endif
