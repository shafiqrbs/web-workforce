
@if ($paginator->hasPages())
    <ul class="pager">

        @if ($paginator->onFirstPage())
            <li class="disabled" style="border: 1px solid;padding: 5px 10px;font-size: 15px;font-weight: bold;background: #e41e2f;color: #fff;"><span>Previous</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" style="border: 1px solid;padding: 5px 10px;font-size: 15px;font-weight: bold;background: #e41e2f;color: #fff;">Previous</a></li>
        @endif



        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif



            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active my-active pagination_custom_style"><span>{{ $page }}</span></li>
                    @else
                        <a href="{{ $url }}"><li class="pagination_custom_style">{{ $page }}</li></a>
                    @endif
                @endforeach
            @endif
        @endforeach



        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" style="border: 1px solid;padding: 5px 10px;font-size: 15px;font-weight: bold;background: #e41e2f;color: #fff;" rel="next">Next</a></li>
        @else
            <li class="disabled" style="border: 1px solid;padding: 5px 10px;font-size: 15px;font-weight: bold;background: #e41e2f;color: #fff;"><span>Next</span></li>
        @endif
    </ul>
@endif
