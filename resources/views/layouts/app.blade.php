<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>vemto-links</title>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
        
        <!-- Icons -->
        <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
        
        <!-- Scripts -->
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
        <script src="/vendor/laravel-filemanager/js/lfm.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    
    <body class="min-h-screen bg-gray-50">
        <div id="app">
            @include('layouts.nav')
        
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        
        @livewireScripts
        
        @stack('scripts')
        
        
        @if (session()->has('success')) 
        <script>
            var notyf = new Notyf({dismissible: true})
            notyf.success('{{ session('success') }}')
        </script> 
        @endif
        
        <script>
            /* Simple Alpine Image Viewer */
            document.addEventListener('alpine:init', () => {
                Alpine.data('imageViewer', (src = '') => {
                    return {
                        imageUrl: src,
        
                        refreshUrl() {
                            this.imageUrl = this.$el.getAttribute("image-url")
                        },
        
                        fileChosen(event) {
                            this.fileToDataUrl(event, src => this.imageUrl = src)
                        },
        
                        fileToDataUrl(event, callback) {
                            if (! event.target.files.length) return
        
                            let file = event.target.files[0],
                                reader = new FileReader()
        
                            reader.readAsDataURL(file)
                            reader.onload = e => callback(e.target.result)
                        },
                    }
                })
            })
        </script>
        <script src="/filemanager.js"></script>
    </body>
    

</html>
