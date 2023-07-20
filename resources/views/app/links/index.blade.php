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
                    @lang('crud.links.index_title')
                    </br> 
                    {{ Breadcrumbs::render('links.index') }}
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
                            @can('create', App\Models\Link::class)
                            <a
                                href="{{ route('links.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div> 
                        <div class="md:w-1/2">
                            <form style="margin-top: 5px;">
                                <div class="flex items-center w-full">
                                    <x-inputs.select id="" name="user">
                                        @foreach($users as $user)
                                        <option value="{{$user['id']}}">{{$user['name']}}</option> 
                                        @endforeach
                                    </x-inputs.select>
                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary">
                                            Get
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.links.inputs.link')
                                </th>
                                <th class="px-4 py-3 text-left">
                                   @lang('crud.links.inputs.link_id')
                                </th>
                               <th class="px-4 py-3 text-left">
                                    @lang('crud.links.inputs.link_follows')   
                                </th>
                                <th class="px-4 py-3 text-left">
                                    User Name
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($links as $link)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    <a href={{$link->link}}>{{ $link->link ?? '-' }}</a>
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <a href={{$link->link_id}}>{{ $link->link_id ?? '-' }}</a>
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $link->link_follows ?? '0' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <a href="/users/list/{{$link->user_id}}">{{ $link->user_name ?? '-' }}</a>
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $link)
                                        <a
                                            href="{{ route('links.edit', $link) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $link)
                                        <a
                                            href="{{ route('links.show', $link) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $link)
                                        <form
                                            action="{{ route('links.destroy', $link) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                        @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <div class="mt-10 px-4">
                                        {!! $links->render() !!}
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
