<?php $link_limit = 6; 

	if(isset($searchVariable)){
		$paginator->appends($searchVariable);
	}
	   if(isset($sortBy) && isset($order)){
       $paginator->appends(['sortBy' => $sortBy, 'order'=>$order])->links();  
    }
?>

@if ($paginator->lastPage() > 1)
<div class="text-right">
<div class="pagination_text">
Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }}
of total {{$paginator->total()}} entries </div>
<ul class="pagination">
    <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ ($paginator->currentPage() == 1) ? 'javascript:void(0)' : $paginator->url($paginator->currentPage()-1) }}">Previous</a>
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
			
                <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a href='{{ $paginator->url($i) }}'>{{ $i }}</a>
                </li>
            @endif
     @endfor
    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'javascript:void(0)' : $paginator->url($paginator->currentPage()+1) }}" >Next</a>
    </li>
</ul>
</div>

@else 

<div class="text-right">
    <div class="pagination_text">
        Showing total {{$paginator->total()}} entries 
    </div>    
</div>
@endif
