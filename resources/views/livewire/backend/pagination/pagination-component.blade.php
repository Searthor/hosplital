@if ($paginator->hasPages())
    <ul class="pagination pagination-rounded justify-content-right mt-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><a href="javascript:void(0);" wire:click="previousPage" class="page-link"><i class="fa fa-chevron-left" style="font-size:8px;" aria-hidden="true"></i></a></li>
        @else
        <li class="page-item"><a href="javascript:void(0);" wire:click="previousPage" rel="prev" class="page-link"><i class="fa fa-chevron-left" style="font-size:8px;" aria-hidden="true"></i></a></li>
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
                        <li class="page-item active" aria-current="page"><a href="javascript:void(0);" wire:click="gotoPage({{$page}})" class="page-link"><span>{{ $page }}</span></a></li>
                    @else
                    <li class="page-item"><a href="javascript:void(0);" wire:click="gotoPage({{$page}})" class="page-link">{{$page}}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a href="javascript:;" wire:click="nextPage" class="page-link"><i class="fa fa-chevron-right" style="font-size:8px;" aria-hidden="true"></i></a></li>
        @else
          <li class="page-item disabled"><a href="javascript:;" class="page-link"><i class="fa fa-chevron-right" style="font-size:8px;" aria-hidden="true"></i></a></li>
        @endif
    </ul>
@endif