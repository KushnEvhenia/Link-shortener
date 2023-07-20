<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My links
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">My links</x-slot>
                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    Original Link
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Shorten Link
                                </th>
                                <th class="px-4 py-3 text-left">
                                    Link Follows
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @foreach($links as $arr)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        <a href={{$arr['link']}} target="_blank">{{$arr['link']}}</a>
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        <a href={{$arr['link_id']}} target="_blank">{{$arr['link_id']}}</a>
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        @if($arr['link_follows'] == null)
                                            0
                                            @else
                                            {{$arr['link_follows']}}
                                        @endif
                                    </td>  
                                    <td class="px-4 py-3 text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions"
                                            class=" relative inline-flex align-middle">
                                            <a href=/edit/{{$arr['link_id']}}/{{$user_id}} target="_blank" class="mr-1">
                                                <button type="button" class="button">
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                            </a>
                                            <a href=/delete/{{$arr['id']}}/{{$user_id}}>
                                                <button type="submit" class="button">
                                                    <i class="icon ion-md-trash text-red-600 "></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
