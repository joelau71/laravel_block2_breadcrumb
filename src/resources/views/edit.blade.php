<x-admin.layout.app>
    @php
    $breadcrumbs = [
        ['name' => 'Element', 'link' => route("admin.element.index")],
        ['name' => $element->title],
        ['name' => "Breadcrumb", "link" => route('LaravelBlock2Breadcrumb.index', $element->id)],
        ['name' => "Edit"]
    ];
    @endphp
    <x-admin.atoms.breadcrumb :breadcrumbs="$breadcrumbs" />

    <form
        class="relative mt-7"
        method="POST"
        action="{{ route("LaravelBlock2Breadcrumb.update", ["element_id" => $element->id, "id" => $collection->id]) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method("patch")
        <x-admin.atoms.required />

        @foreach (config('translatable.locales') as $locale)
            <x-admin.atoms.row>
                <x-admin.atoms.label for="title_{{ $locale }}" class="required">
                    Title ({{ $locale }})
                </x-admin.atoms.label>
                <x-admin.atoms.text name="title[{{$locale}}]" id="title_{{$locale}}" value="{{ $collection->getTranslation('title', $locale) }}" />
            </x-admin.atoms.row>
            @error("title.*")
                <x-admin.atoms.error>
                    {{ $message }}
                </x-admin.atoms.error>
            @enderror
        @endforeach

        <x-admin.atoms.row>
            <label class="inline-block mb-2 cursor-pointer">
                Link to Page
            </label>
            <div class="mt-2">
                <select name="page_id" id="page_id" class="select2">
                    <option value="">--</option>
                    <?php
                        $link_page_id = "";
                        if($collection->elementLinkPage()->exists()){
                            $link_page_id = $collection->elementLinkPage->page_id;
                        }
                    ?>
                    @foreach ($pages as $item)
                        <option value="{{ $item->id }}" @if ($link_page_id == $item->id)
                            selected
                        @endif>
                            {{ $item->title }} ({{ $item->slug}})
                        </option>
                    @endforeach
                </select>
            </div>
        </x-admin.atoms.row>

        <hr class="my-10">
        
        <div class="text-right">
            <x-admin.atoms.link
                href="{{ route('LaravelBlock2Breadcrumb.index', $element->id) }}"
            >
                Back
            </x-admin.atoms.link>
            <x-admin.atoms.button id="save">
                Save
            </x-admin.atoms.button>
        </div>
    </form>

    @once
        @push('css')
            <link rel="stylesheet" href="{{ asset("css/select2.min.css") }}">
        @endpush
        @push('js')
            <script src="{{ asset("js/jquery-3.6.0.min.js") }}"></script>
            <script src="{{ asset("js/select2.min.js") }}"></script>
            <script>
                $(".select2").select2();
            </script>
        @endpush
    @endonce
</x-admin.layout.app>
