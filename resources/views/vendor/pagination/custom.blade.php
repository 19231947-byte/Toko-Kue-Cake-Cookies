@if ($paginator->hasPages())
<nav aria-label="Navigasi halaman">
    <ul class="pagination justify-content-center align-items-center gap-1 mb-0" style="list-style:none;padding:0;display:flex;">

        {{-- Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <span class="pagination-btn disabled">
                    <i class="fa fa-chevron-left me-1"></i> Sebelumnya
                </span>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn">
                    <i class="fa fa-chevron-left me-1"></i> Sebelumnya
                </a>
            </li>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li><span class="pagination-btn disabled">{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li>
                            <span class="pagination-btn active">{{ $page }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Berikutnya --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn">
                    Berikutnya <i class="fa fa-chevron-right ms-1"></i>
                </a>
            </li>
        @else
            <li class="disabled">
                <span class="pagination-btn disabled">
                    Berikutnya <i class="fa fa-chevron-right ms-1"></i>
                </span>
            </li>
        @endif

    </ul>
</nav>

<style>
.pagination-btn {
    display: inline-flex;
    align-items: center;
    padding: 7px 16px;
    border-radius: 50px;
    font-size: .85rem;
    font-weight: 500;
    color: #8B5E3C;
    background: #FDF6F0;
    border: 1px solid #e0cfc2;
    text-decoration: none;
    transition: all .2s ease;
    cursor: pointer;
}
.pagination-btn:hover {
    background: #8B5E3C;
    color: #fff;
    border-color: #8B5E3C;
}
.pagination-btn.active {
    background: #8B5E3C;
    color: #fff;
    border-color: #8B5E3C;
    cursor: default;
}
.pagination-btn.disabled {
    opacity: .45;
    cursor: default;
    pointer-events: none;
}
</style>
@endif
