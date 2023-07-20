<x-app-layout>
    <div class="mx-auto px-4 md:px-8">
        <x-partials.card>
            <x-slot name="title">{{ __('Hello!') }}</x-slot>
            <div class="flex-auto p-6">
                <form method="POST">
                    @csrf
                    <div class="mb-4 flex flex-wrap">
                        <label for="password" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('Insert your link') }}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <x-inputs.text name="link" required/>
                        </div>
                    </div>
                    <div class="mb-4 flex flex-wrap ">
                        <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                            <button type="submit" class="button button-primary">
                                {{ __('Get it!') }}
                            </button>
                        </div>
                    </div>
                </form>
                <div style="display:flex; justify-content:space-around; text-decoration:underline; margin-top:20px;">
                    <a href={{$link}} target="_blank">{{$link}}</a>
                    <a href={{$uri}} target="_blank">{{$uri}}</a>
                </div>
            </div>
        </x-partials.card>
    </div>
</x-app-layout>