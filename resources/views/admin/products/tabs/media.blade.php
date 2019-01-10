@push('styles')
    <link rel="stylesheet" href="{{ asset('/design/admin/plugins/dropzone/js/dist/min/dropzone.min.css') }}">
    <style>
        .dropzone {
            border: 3px dashed rgb(60, 141, 188);
        }
        .dropzone .dz-preview .dz-image img {
            width: 160%;
            margin-right: -30%;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('/design/admin/plugins/dropzone/js/dist/min/dropzone.min.js') }}"></script>
    <script>
        // Prevent Dropzone from auto discovering this element:
        Dropzone.options.myAwesomeDropzone = false;
        Dropzone.autoDiscover = false;
        $("#dropzone").dropzone({
            url: "{!! route('products.upload', $product->id) !!}",
            paramName: 'file',
            uploadMultiple: true,
            maxFilesize: 10, // MB
            acceptedFiles: 'image/*',
            removedfile: function(file) {
                $.ajax({
                    url: '{!! aurl('products/upload/') !!}' + file.id,
                    method: 'post',
                    data: {
                        _token: '{!! csrf_token() !!}',
                        _method: 'delete',
                    },
                });

                file.previewElement.remove();
            },
            addRemoveLinks: true,
            params:{
                _token: '{!! csrf_token() !!}'
            },
            init: function() {

                var thisDropzone = this;

                @foreach($product->files as $file)
                    var mockFile = {
                        name: '{!! $file->name !!}',
                        size: '{!! $file->size !!}',
                        id: {!! $file->id !!},
                    }; // here we get the file name and size as response
                    thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                    thisDropzone.options.thumbnail.call(thisDropzone, mockFile, '{!! \Storage::url($file->full_file) !!}');//uploadsfolder is the folder where you have all those uploaded files
                thisDropzone.emit("complete", mockFile);
                @endforeach

                thisDropzone.on('sending', function (file, xhr, formData) {
                    formData.append('id', '');
                    file.id = '';
                });

                thisDropzone.on('successmultiple', function (file, response) {
                    for(let i = 0; i < response.length; i++) {
                        file[i]['id'] = response[i];
                    }

                });

            }
        });
    </script>
@endpush
<div id="media" class="tab-pane fade">
    <h3>@lang('admin.form.media')</h3>
    <div class="dropzone" id="dropzone">
        <div class="fallback">
            {!! Form::file('file', ['multiple' => 'multiple']) !!}
        </div>
    </div>
</div>