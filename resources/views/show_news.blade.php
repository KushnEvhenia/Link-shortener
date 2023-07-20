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
                    <a href="{{ route('users.index') }}" class="mr-4">
                        <i class="mr-1 icon ion-md-arrow-back"></i>
                    </a>
                    Show News
                    </br>
                    {{Breadcrumbs::render('news.show', $id)}}
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            Title
                        </h5>
                        <span>{{$title}}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            Text
                        </h5>
                        <span>{!! $text !!}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="/news" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        
                    </a>
                    <a href="/news/{{$id}}/edit" class="button">
                        Edit
                    </a>
                    <a href="/news/{{$id}}/delete" class="button">
                        Delete
                    </a>
                </div>
               
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
