<script>

    function showCKEditor() {
        setTimeout(() => {

            CKEDITOR.replace('{{$formId}}', {
                filebrowserBrowseUrl: '/elfinder/ckeditor'
            });

            CKEDITOR.instances['{{$formId}}'].on('change', function (e) {
                @this.
                set('{{$nameForm}}', e.editor.getData());

                @if(!($canselSaveButton ?? false))

                @this.
                emit('changesStart');

                @endif
            });

        }, 300);

        setTimeout(() => {
            $(".textareEditor").attr('wire:ignore');

        }, 400);
    }

    window.addEventListener('reloadCKEditor', () => {
        showCKEditor();
    });

    document.addEventListener('DOMContentLoaded', function () {
        showCKEditor();
    });
    showCKEditor();

</script>


