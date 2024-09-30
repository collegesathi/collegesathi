<?php $link_limit = 6;

if (isset($searchVariable)) {
    $paginator->appends($searchVariable);
}
?>

@if ($paginator->lastPage() > 1)
    <div class="pagination_group text-center custom_pagination">
        <ul class="pagination justify-content-center custom-pager">
            <li class="page-item {{ $paginator->currentPage() == 1 ? ' disabled' : '' }}">
                <a class="page-link prev_page"
                    href="{{ $paginator->currentPage() == 1 ? 'javascript:void(0)' : $paginator->url($paginator->currentPage() - 1) }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                <?php
                $half_total_links = floor($link_limit / 2);
                $from = $paginator->currentPage() - $half_total_links;
                $to = $paginator->currentPage() + $half_total_links;
                if ($paginator->currentPage() < $half_total_links) {
                    $to += $half_total_links - $paginator->currentPage();
                }
                if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                    $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                }
                ?>
                @if ($from < $i && $i < $to)
                    <li class="page-item {{ $paginator->currentPage() == $i ? ' active' : '' }}">
                        <a class="page-link" href='{{ $paginator->url($i) }}'>{{ $i }}</a>
                    </li>
                @endif
            @endfor
            <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
                <a class="page-link next_page"
                    href="{{ $paginator->currentPage() == $paginator->lastPage() ? 'javascript:void(0)' : $paginator->url($paginator->currentPage() + 1) }}">Next</a>
            </li>
        </ul>
    </div>
@endif
