<textarea id="summernote" name="{{ $name }}">
    {!! $value !!}
</textarea>

@error($name)
<span class="invalid-feedback" style="display: block;" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror

@push('js')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 200,
                callbacks: {
                    onImageUpload: function(images) {
                        sendFile(images[0]);
                    }
                }
            });

            function sendFile(image) {
                data = new FormData();
                data.append("file", image);
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "{{ route('admin.image_upload') }}",
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(url) {
                        var image = $('<img>').attr('src', url);
                        $('#summernote').summernote("insertNode", image[0]);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        });
    </script>
@endpush