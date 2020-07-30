<form method="post" action="{{ $action }}" id="form">
    @csrf
    @method($method)
    <div class="form-group">
        <label for="metadata">Metadata:</label>
        <textarea class="form-control" @if($disabled) disabled @endif name="metadata">{{ $phrase->metadata ?? '' }}</textarea>
    </div>

    <div class="form-group">
        <label for="content">Content:</label>
        <textarea class="form-control" name="content">{{ $phrase->content ?? '' }}</textarea>
    </div>


    <button type="submit" class="btn btn-outline-primary">Save</button>
</form>


@push('styles')
    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
@endpush

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>

    {{-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#content', {
            theme: 'snow'
        });

        quill.setContents({!! $phrase->content ?? '' !!})

        @if($disabled)
            quill.disable()
        @endif

        const form = document.querySelector('#form');

        form.onsubmit = function() {
            var content = document.querySelector('input[name=content]');
            content.value = JSON.stringify(quill.getContents());
        };
    </script> --}}
@endpush
