<script src="{{ asset('admin_assets/global/plugins/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>

<script src="{{ asset('admin_assets/global/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>

<script>

tinymce.init({

    selector: '#description',
    height: 350,
    entity_encoding : "raw",
    forced_root_block: '',
    convert_urls: false,
    plugins: [
        'advlist','autolink','link','lists','image', 'searchreplace', 'visualblocks', 'code', 'fullscreen','media', 'table' ,'contextmenu' ,'paste' ,'code','preview'

    ],

    toolbar: 'insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image|print preview media ',

    menubar: 'favs file edit view insert format tools table help',

    relative_urls: true,
    images_upload_url: "{{ route('tinymce.image_upload.front') }}",
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', "{{ route('tinymce.image_upload.front') }}");
        xhr.onload = function () {
            var json;
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);

        };

        formData = new FormData();

        formData.append('image', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);

    },

});



tinymce.init({

    selector: '#benefits',

    height: 150,

    entity_encoding : "raw",

    forced_root_block: '',

    plugins: [

        'advlist autolink lists image',

        'searchreplace visualblocks code fullscreen',

        'media table contextmenu paste code'

    ],

    toolbar: 'insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image',

    relative_urls: true,

    images_upload_url: "{{ route('tinymce.image_upload.front') }}",

    images_upload_handler: function (blobInfo, success, failure) {

        var xhr, formData;

        xhr = new XMLHttpRequest();

        xhr.withCredentials = false;

        xhr.open('POST', "{{ route('tinymce.image_upload.front') }}");

        xhr.onload = function () {

            var json;

            if (xhr.status != 200) {

                failure('HTTP Error: ' + xhr.status);

                return;

            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {

                failure('Invalid JSON: ' + xhr.responseText);

                return;

            }

            success(json.location);

        };

        formData = new FormData();

        formData.append('image', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);

    },

});

</script>