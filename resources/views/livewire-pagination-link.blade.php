<style>
    .pagination>li:last-child>a, .pagination>li:last-child>span{
        border-radius: 50%;
        font-size: 14px;
    }
    .pagination>li:first-child>a, .pagination>li:first-child>span{
        border-radius: 50%;
        font-size: 14px;
    }
    .pagination>li>a, .pagination>li>span{
        border-radius: 50%;
        margin-right: 5px;

    }
    .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
        background: #ee4266;
        font-size: 14px;
        border: none;
     }
</style>
@if ($paginator->hasPages())
    <ul class="pagination pagination-rounded justify-content-center mt-4" style="float: right;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><a href="javascript:;" wire:click="previousPage" class="page-link">««</a></li>
        @else
        <li class="page-item"><a href="javascript:;" wire:click="previousPage" rel="prev" class="page-link">««</a></li>
        @endif

        {{-- Pagination Element Here --}}
        @foreach ($elements as $element)
            {{-- Make dots here --}}
            @if (is_string($element))
                <li class="page-item disabled"><a class="page-link"><span>{{ $element }}</span></a></li>
            @endif

            {{-- Links array Here --}}
            @if (is_array($element))
                @foreach ($element as $page=>$url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><a href="javascript:;" wire:click="gotoPage({{$page}})" class="page-link"><span>{{ $page }}</span></a></li>
                    @else
                    <li class="page-item"><a href="javascript:;" wire:click="gotoPage({{$page}})" class="page-link">{{$page}}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a href="javascript:;" wire:click="nextPage" class="page-link">»</a></li>
        @else
          <li class="page-item disabled"><a href="javascript:;" class="page-link">»</a></li>
        @endif
    </ul>
@endif
