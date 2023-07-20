<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="/users" class="mr-4">
                        <i class="mr-1 icon ion-md-arrow-back"></i>
                    </a>
                    {{$user}}
                    </br>
                </x-slot>
                <table class="w-full max-w-full mb-4 bg-transparent">
                    <thead class="text-gray-700">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                Link
                            </th>
                            <th class="px-4 py-3 text-left">
                                Link ID
                            </th>
                            <th class="px-4 py-3 text-left">
                                Link follows
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        @foreach($links as $link)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    <a target="_blank" href={{$link['link']}}>{{$link['link']}}</a>
                                </td>
                                <td class="px-4 py-3 text-left">
                                    <a target="_blank" href=/{{$link['link_id']}}>{{$link['link_id']}}</a>
                                </td>
                                <td class="px-4 py-3 text-left">
                                    @if($link['link_follows'] == null)
                                        0
                                        @else
                                        {{$link['link_follows']}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>

