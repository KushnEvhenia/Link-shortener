<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.users.show_title')
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('news') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                    Release
                    </br>
                    {{Breadcrumbs::render('info', $id)}}
                </x-slot>
                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <span><b>{{ $title }}</b></span>
                    </div>
                    <div class="mb-4">
                        <span>
                            @if(!is_null($path))
                                <img src={{$path}} style="width:50%">
                                @else
                                <span></span>
                            @endif
                        </span>
                    </div>
                    <div class="mb-4">
                        <span>
                            {!! $text !!}
                        </span>
                    </div>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>