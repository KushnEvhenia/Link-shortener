<x-app-layout>
    <div class="mx-auto px-4 md:px-8">
        <x-partials.card>
            <x-slot name="title">
                {{ __('Edit news') }}
                </br>
                {{ Breadcrumbs::render('news.edit', $id) }}
            </x-slot>
            <div class="flex-auto p-6">
                <form method="POST">
                    @csrf
                    <div class="mb-4 flex flex-wrap ">
                        <label for="title" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('Topic') }}</label>
                        <div class="md:w-1/2 pr-4 pl-4">
                            <x-inputs.text name="title" required autofocus value={{$title}}/>
                        </div>
                    </div>
                    <div class="mb-4 flex flex-wrap ">
                        <label for="text" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('Text') }}</label>
                        <div class="md:w-1/2 pr-4 pl-4">
                            <textarea name="text" required autofocus style="width:100%;">{{ $text }}</textarea>
                        </div>
                    </div>  
                    <a href="/news" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        Back
                    </a>  
                    <button type="submit" class="button button-primary float-right">
                        <i class="mr-1 icon ion-md-save"></i>
                        Update
                    </button>
                </form>
            </div>
        </x-partials.card>
    </div>
</x-app-layout>