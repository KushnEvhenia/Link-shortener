
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            News
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    {{ __('Info') }}
                    </br>
                    {{Breadcrumbs::render('news')}}
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
                    </div>
                </div>
                <table class="w-full max-w-full mb-4 bg-transparent">
                    @foreach($news as $arr)
                        <tr>
                            <th class="px-4 py-3 text-left">
                                <div style="display:flex;">
                                    @if($arr['path_to_image'] == '')
                                        <img src="images/no_image.jpg" style="width: 30%">
                                        @else
                                        <img src={{$arr['path_to_image']}} style="width:30%">
                                    @endif
                                    <div style="display: inline-block;">
                                        <div style="margin-left:15px;"><a href="/info/{{$arr['id']}}">{{$arr['title']}}</a></div>
                                            @if(strlen(strip_tags($arr['text'])) < 70)
                                                <div style="margin-left:15px; color:grey;"><a href="/info/{{$arr['id']}}">{{$desc}}</a></div>
                                                @else
                                                <div style="margin-left:15px; color:grey;"><a href="/info/{{$arr['id']}}">{{strip_tags(substr($arr['text'], 0, -50)) . '...'}}</a></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    @endforeach
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
            </x-partials.card>
        </div>
    </div>
</x-app-layout>