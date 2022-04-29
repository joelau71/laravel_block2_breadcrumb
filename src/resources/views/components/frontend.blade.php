<section class="breadcrumb">
    <ul>
        @foreach ($collection as $item)
            <li>
                @if($item->elementLinkPage()->exists())
                    <a href="{{ route("frontend.page", $item->elementLinkPage->page->slug) }}">
                        {{ $item->title }}
                    </a>
                @else
                    {{ $item->title }}
                @endif
            </li>
        @endforeach
    </ul>

    @once
        @push('css')
            <style>
                .breadcrumb{
                    max-width: 1562px;
                    font-size: 0.875rem;
                    text-transform: uppercase;
                    padding: 1.25rem;
                    margin: auto;
                }

                .breadcrumb ul li{
                    display: inline-block;
                }

                .breadcrumb ul li::after {
                    content: ">>";
                    margin: 0 10px;
                }
                .breadcrumb ul li:nth-last-of-type(1):after {
                    content: "";
                    margin: 0;
                }
                .breadcrumb ul li a {
                    color: #898989;
                }
                @media (min-width: 768px) {
                    .breadcrumb{
                        font-size: 1rem;
                        padding: 2rem;
                    }
                }
            </style>
        @endpush
    @endonce
</section>