<x-app-layout>
    <div class="mx-auto px-4 md:px-8">
        <x-partials.card>
            <x-slot name="title">
                {{ ('Create news') }}
                </br>
                {{ Breadcrumbs::render('news.create') }}
            </x-slot>
            <div class="flex-auto p-6">
                <form method="POST"  enctype="multipart/form-data">
                    @csrf    
                    <div class="mb-4 flex flex-wrap ">
                        <label for="topic" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ ('Topic') }}</label>
                        <div class="md:w-1/2 pr-4 pl-4">
                            <x-inputs.text name="topic" autofocus/>
                        </div>
                    </div>
                    <div class="mb-4 flex flex-wrap ">
                        <label for="text" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ ('Text') }}</label>
                        <div class="md:w-1/2 pr-4 pl-4">
                            <textarea class="form-control" name="content" id="description-textarea" rows="8"></textarea>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.5/tinymce.min.js"></script>
                            <script>
                                var editor_config = {
                                    selector: '#description-textarea',
                                    directionality: document.dir,
                                    path_absolute: "/",
                                    menubar: 'edit insert view format table',
                                    plugins: [
                                        "advlist autolink lists link image charmap preview hr anchor pagebreak",
                                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                                        "insertdatetime media save table contextmenu directionality",
                                        "paste textcolor colorpicker textpattern"
                                    ],
                                    toolbar: "insertfile undo redo | formatselect styleselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | fullscreen code",
                                    relative_urls: false,
                                    language: document.documentElement.lang,
                                    height: 300,
                                    file_browser_callback : function (field_name, url, type, win) {
                                        var x = window.innerWidth || document.documentElement.clientWidth || document.querySelector('body').clientWidth;
                                        var y = window.innerHeight || document.documentElement.clientHeight || document.querySelector('body').clientHeight;

                                        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                                        if (type == 'image') {
                                          cmsURL = cmsURL + "&type=Images";
                                        } else {
                                          cmsURL = cmsURL + "&type=Files";
                                        }
                                    
                                        tinyMCE.activeEditor.windowManager.open({
                                          file: cmsURL,
                                          title: 'Filemanager',
                                          width: x * 0.8,
                                          height: y * 0.8,
                                          resizable: "yes",
                                          close_previous: "no"
                                        });
                                    },
                                }
                                tinymce.init(editor_config);
                            </script>
                        </div>    
                    </div>
                    <div class="mb-4 flex flex-wrap ">
                        <label for="text" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">Main picture</label>
                        <div class="md:w-1/2 pr-4 pl-4">
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i>
                                    <button type="submit" class="button" style="margin-bottom: 5px;">
                                        Choose
                                    </button>
                                  </a>
                                </span>
                                <input id="thumbnail" type="text" name="image" class="block appearance-none w-full py-1 px-2 text-base leading-normal text-gray-800 border border-gray-200 rounded">
                            </div>
                            <img id="holder" style="margin-top:15px;max-height:100px;">
                        </div>
                    </div>
                    <a href="/news" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        Back
                    </a>  
                    <button type="submit" class="button button-primary">
                        {{ ('Post') }}
                    </button>
                </form>
            </div>
        </x-partials.card>
    </div>
</x-app-layout>
 