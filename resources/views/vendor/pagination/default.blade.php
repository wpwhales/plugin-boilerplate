<?php if (!defined('ABSPATH')) die();?>

@if ($paginator->hasPages())

    <nav class="tw-flex tw-justify-center tw-mt-4" aria-label="Pagination">
        <ul class="pagination tw-list-none tw-mt-4 tw-flex tw-space-x-2 tw-text-gray-600">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item tw-flex tw-items-center tw-py-0.5 tw-px-3 tw-rounded-full tw-bg-gray-200 tw-opacity-50" aria-disabled="true" aria-label="Previous">
                    <span>&lsaquo;</span>
                </li>
            @else
                <li class="pagination-item tw-flex tw-items-center tw-py-0.5 tw-px-3 tw-rounded-full tw-bg-gray-200 hover:tw-bg-gray-300">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item tw-flex tw-items-center tw-py-0.5 tw-px-3 tw-text-sm tw-rounded-full tw-bg-gray-200 tw-opacity-50" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item tw-flex tw-items-center tw-py-0.5 tw-text-[14px] tw-px-3 tw-rounded-full tw-bg-[#31966e] tw-text-white" aria-current="page">{{ $page }}</li>
                        @else
                            <li class="pagination-item tw-flex tw-items-center tw-py-0.5 tw-text-[12px] tw-px-3 tw-rounded-full tw-bg-gray-200 hover:tw-bg-gray-300">
                                <a href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item tw-py-0.5 tw-flex tw-items-center tw-px-3 tw-rounded-full tw-bg-gray-200 hover:tw-bg-gray-300">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">&rsaquo;</a>
                </li>
            @else
                <li class="pagination-item tw-py-0.5 tw-flex tw-items-center tw-px-3 tw-rounded-full tw-bg-gray-200 tw-opacity-50" aria-disabled="true" aria-label="Next">
                    <span>&rsaquo;</span>
                </li>
            @endif

        </ul>
    </nav>
@endif
