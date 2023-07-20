<x-app-layout>
    <div class="mx-auto px-4 md:px-8">
        <x-partials.card>
            <x-slot name="title">{{ __('Edit Link') }}</x-slot>
            <div class="flex-auto p-6">
                <form method="POST">
                    @csrf
                    <div class="mb-4 flex flex-wrap ">
                        <label for="link" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('Link') }}</label>
                        <div class="md:w-1/2 pr-4 pl-4">
                            <x-inputs.text name="link" value={{$link}} required autofocus/>
                        </div>
                    </div>
                    <div class="mb-4 flex flex-wrap ">
                        <label for="link_id" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('Link ID') }}</label>
                        <div class="md:w-1/2 pr-4 pl-4">
                            <x-inputs.text name="link_id" value={{$link_id}} required autofocus/>
                        </div>
                    </div>   
                    <button type="submit" class="button button-primary">
                        {{ __('Save') }}
                    </button>
                </form>
            </div>
        </x-partials.card>
    </div>
</x-app-layout>