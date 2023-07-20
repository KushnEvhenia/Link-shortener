<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.links.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    News
                    </br>
                    {{ Breadcrumbs::render('news.index') }}
                </x-slot>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            <a
                                href="/news/create"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                Create
                            </a>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    Title
                                </th>
                                <th class="px-4 py-3 text-left">
                                   Text
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @foreach($news as $arr)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        {{$arr['title']}}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {!! $arr['text'] !!}
                                    </td>
                                    <td class="px-4 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row" class="relative inline-flex align-middle">
                                            <a href="/news/{{$arr['id']}}/edit" class="mr-1">
                                                <button type="button" class="button">
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                            </a>
                                            <a href="/news/{{$arr['id']}}" class="mr-1">
                                                <button type="button" class="button" >
                                                    <i class="icon ion-md-eye"></i>
                                                </button>
                                            </a>
                                            <a href="/news/{{$arr['id']}}/delete" class="mr-1">
                                                <button type="submit" class="button">
                                                    <i class="icon ion-md-trash text-red-600"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <div class="mt-10 px-4">
                                        {!! $news->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>