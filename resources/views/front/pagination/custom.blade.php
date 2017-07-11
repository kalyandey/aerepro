@php
$link_limit = 5
@endphp
@if ($paginator->lastPage() > 1)
    <ul class="pagination">
        @if($paginator->currentPage() > 1)
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage()-1) }}"><<</a>
         </li>
        @endif
        @if($paginator->currentPage() >= $link_limit-2)
        <li class="{{ ($paginator->currentPage() == 1) ? ' active_list' : ''}}">
            <a href="{{ $paginator->url(1) }}">1</a>
        </li>
        @endif
        @if($paginator->currentPage() >= $link_limit-1)
        <li class="dot"><span>...</span></li>
        @endif
        
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
               $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            @endphp
            @if ($from < $i && $i < $to)
                @if($i != $paginator->lastPage() )
                <li class="{{ ($paginator->currentPage() == $i) ? ' active_list' : '' }}">
                    <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
                @endif
            @endif
        @endfor
        
       
        @if($paginator->lastPage() - $paginator->currentPage() > $paginator->currentPage() - $link_limit)
            <li class="dot"><span>...</span></li>
        @endif
        
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' active_list' : '' }}">
            <a href="{{ $paginator->url($paginator->lastPage()) }}">{{$paginator->lastPage()}}</a>
        </li>
        @if($paginator->currentPage() != $paginator->lastPage())
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >>></a>
        </li>
        @endif
    </ul>
@endif