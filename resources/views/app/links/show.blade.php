<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.links.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('links.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                    @lang('crud.links.show_title')
                    </br>
                    {{Breadcrumbs::render('links.show', $link)}}
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.links.inputs.link')
                        </h5>
                        <span><a href={{$link->link}}>{{ $link->link ?? '-' }}</a></span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.links.inputs.link_id')
                        </h5>
                       <span><a href=/{{$link->link_id}}>{{ $link->link_id ?? '-' }}</a></span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.links.inputs.link_follows')
                        </h5>
                        <span>{{ $link->link_follows ?? '0' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.links.inputs.user_id')
                        </h5>
                        <span>{{ $link->user_id ?? '-' }}</span>
                    </div>   
                </div>
                    <a href="{{ route('links.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>
                    <a href=/links/{{$link->id}}/edit class="button">
                        Edit
                    </a>
                    <form style="margin-top:5px;" action="{{ route('links.destroy', $link) }}" method="POST" onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                        @csrf @method('DELETE')
                        <button type="submit" class="button">
                            Delete
                        </button>
                    </form>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
