<x-app-layout>
    <div class="mx-auto px-4 md:px-8">
        <x-partials.card>
            <x-slot name="title">
                {{ __('Edit profile') }}
                </br>
                {{Breadcrumbs::render('edit.profile', $user_id)}}
            </x-slot>

            <div class="flex-auto p-6">
                <form method="POST">
                    @csrf
                    <div class="mb-4 flex flex-wrap ">
                        <label for="name" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('Name') }}</label>
                        <div class="md:w-1/2 pr-4 pl-4">
                            <x-inputs.text name="name" value={{$name}} required autocomplete="name" autofocus/>
                        </div>
                    </div>
                    <div class="mb-4 flex flex-wrap ">
                        <label for="password" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('New password') }}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <x-inputs.text name="password" autocomplete="new-password"/>
                        </div>
                    </div>  
                    <div class="mb-4 flex flex-wrap ">
                        <label for="password" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('Retype password') }}</label>

                        <div class="md:w-1/2 pr-4 pl-4">
                            <x-inputs.text name="confirmed_password" autocomplete="new-password"/>
                        </div>
                    </div>    
                    <button type="submit" class="button button-primary">
                        {{ __('Save') }}
                    </button>
                    <div class="md:w-1/2 pr-4 pl-4">
                        {{$msg}}
                    </div>
                </form>
            </div>
        </x-partials.card>
    </div>
</x-app-layout>