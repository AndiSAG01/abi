
 <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>
 <!--
    Uncomment to load the Spanish translation
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/translations/es.js"></script>
-->
 <script>
     // This sample still does not showcase all CKEditor 5 features (!)
     // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
     CKEDITOR.ClassicEditor.create(document.querySelector('#information'), {
         // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
         toolbar: {
             items: [
                 'heading', '|',
                 'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                 'removeFormat', '|',
                 'bulletedList', 'numberedList', 'todoList', '|',
                 'outdent', 'indent', '|',
                 'undo', 'redo',
                 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                 'alignment',
                 'link', 'insertImage','horizontalLine','|'
             ],
             shouldNotGroupWhenFull: true
         },
         // Changing the language of the interface requires loading the language file using the <script> tag.
         // language: 'es',
         list: {
             properties: {
                 styles: true,
                 startIndex: true,
                 reversed: true
             }
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
         heading: {
             options: [{
                     model: 'paragraph',
                     title: 'Paragraph',
                     class: 'ck-heading_paragraph'
                 },
                 {
                     model: 'heading1',
                     view: 'h1',
                     title: 'Heading 1',
                     class: 'ck-heading_heading1'
                 },
                 {
                     model: 'heading2',
                     view: 'h2',
                     title: 'Heading 2',
                     class: 'ck-heading_heading2'
                 },
                 {
                     model: 'heading3',
                     view: 'h3',
                     title: 'Heading 3',
                     class: 'ck-heading_heading3'
                 },
                 {
                     model: 'heading4',
                     view: 'h4',
                     title: 'Heading 4',
                     class: 'ck-heading_heading4'
                 },
                 {
                     model: 'heading5',
                     view: 'h5',
                     title: 'Heading 5',
                     class: 'ck-heading_heading5'
                 },
                 {
                     model: 'heading6',
                     view: 'h6',
                     title: 'Heading 6',
                     class: 'ck-heading_heading6'
                 }
             ]
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
         placeholder: 'Welcome to CKEditor 5!',
         // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
         // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
         htmlSupport: {
             allow: [{
                 name: /.*/,
                 attributes: true,
                 classes: true,
                 styles: true
             }]
         },
         // Be careful with enabling previews
         // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
         link: {
             decorators: {
                 addTargetToExternalLinks: true,
                 defaultProtocol: 'https://',
                 toggleDownloadable: {
                     mode: 'manual',
                     label: 'Downloadable',
                     attributes: {
                         download: 'file'
                     }
                 }
             }
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
         mention: {
             feeds: [{
                 marker: '@',
                 feed: [
                     '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                     '@chocolate', '@cookie', '@cotton', '@cream',
                     '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                     '@gummi', '@ice', '@jelly-o',
                     '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                     '@sesame', '@snaps', '@soufflé',
                     '@sugar', '@sweet', '@topping', '@wafer'
                 ],
                 minimumCharacters: 1
             }]
         },
         // The "super-build" contains more premium features that require additional configuration, disable them below.
         // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
         removePlugins: [
             // These two are commercial, but you can try them out without registering to a trial.
             // 'ExportPdf',
             // 'ExportWord',
             'CKBox',
             'CKFinder',
             'EasyImage',
             // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
             // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
             // Storing images as Base64 is usually a very bad idea.
             // Replace it on production website with other solutions:
             // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
             // 'Base64UploadAdapter',
             'RealTimeCollaborativeComments',
             'RealTimeCollaborativeTrackChanges',
             'RealTimeCollaborativeRevisionHistory',
             'PresenceList',
             'Comments',
             'TrackChanges',
             'TrackChangesData',
             'RevisionHistory',
             'Pagination',
             'WProofreader',
             // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
             // from a local file system (file://) - load this site via HTTP server if you enable MathType.
             'MathType',
             // The following features are part of the Productivity Pack and require additional license.
             'SlashCommand',
             'Template',
             'DocumentOutline',
             'FormatPainter',
             'TableOfContents'
         ]
     });
 </script>
 <script>
     // This sample still does not showcase all CKEditor 5 features (!)
     // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
     CKEDITOR.ClassicEditor.create(document.querySelector('#information_detail'), {
         // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
         toolbar: {
             items: [
                 'heading', '|',
                 'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                 'removeFormat', '|',
                 'bulletedList', 'numberedList', 'todoList', '|',
                 'outdent', 'indent', '|',
                 'undo', 'redo',
                 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                 'alignment',
                 'link', 'insertImage','horizontalLine','|'
             ],
             shouldNotGroupWhenFull: true
         },
         // Changing the language of the interface requires loading the language file using the <script> tag.
         // language: 'es',
         list: {
             properties: {
                 styles: true,
                 startIndex: true,
                 reversed: true
             }
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
         heading: {
             options: [{
                     model: 'paragraph',
                     title: 'Paragraph',
                     class: 'ck-heading_paragraph'
                 },
                 {
                     model: 'heading1',
                     view: 'h1',
                     title: 'Heading 1',
                     class: 'ck-heading_heading1'
                 },
                 {
                     model: 'heading2',
                     view: 'h2',
                     title: 'Heading 2',
                     class: 'ck-heading_heading2'
                 },
                 {
                     model: 'heading3',
                     view: 'h3',
                     title: 'Heading 3',
                     class: 'ck-heading_heading3'
                 },
                 {
                     model: 'heading4',
                     view: 'h4',
                     title: 'Heading 4',
                     class: 'ck-heading_heading4'
                 },
                 {
                     model: 'heading5',
                     view: 'h5',
                     title: 'Heading 5',
                     class: 'ck-heading_heading5'
                 },
                 {
                     model: 'heading6',
                     view: 'h6',
                     title: 'Heading 6',
                     class: 'ck-heading_heading6'
                 }
             ]
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
         placeholder: 'Welcome to CKEditor 5!',
         // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
         // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
         htmlSupport: {
             allow: [{
                 name: /.*/,
                 attributes: true,
                 classes: true,
                 styles: true
             }]
         },
         // Be careful with enabling previews
         // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
         link: {
             decorators: {
                 addTargetToExternalLinks: true,
                 defaultProtocol: 'https://',
                 toggleDownloadable: {
                     mode: 'manual',
                     label: 'Downloadable',
                     attributes: {
                         download: 'file'
                     }
                 }
             }
         },
         // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
         mention: {
             feeds: [{
                 marker: '@',
                 feed: [
                     '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                     '@chocolate', '@cookie', '@cotton', '@cream',
                     '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                     '@gummi', '@ice', '@jelly-o',
                     '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                     '@sesame', '@snaps', '@soufflé',
                     '@sugar', '@sweet', '@topping', '@wafer'
                 ],
                 minimumCharacters: 1
             }]
         },
         // The "super-build" contains more premium features that require additional configuration, disable them below.
         // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
         removePlugins: [
             // These two are commercial, but you can try them out without registering to a trial.
             // 'ExportPdf',
             // 'ExportWord',
             'CKBox',
             'CKFinder',
             'EasyImage',
             // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
             // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
             // Storing images as Base64 is usually a very bad idea.
             // Replace it on production website with other solutions:
             // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
             // 'Base64UploadAdapter',
             'RealTimeCollaborativeComments',
             'RealTimeCollaborativeTrackChanges',
             'RealTimeCollaborativeRevisionHistory',
             'PresenceList',
             'Comments',
             'TrackChanges',
             'TrackChangesData',
             'RevisionHistory',
             'Pagination',
             'WProofreader',
             // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
             // from a local file system (file://) - load this site via HTTP server if you enable MathType.
             'MathType',
             // The following features are part of the Productivity Pack and require additional license.
             'SlashCommand',
             'Template',
             'DocumentOutline',
             'FormatPainter',
             'TableOfContents'
         ]
     });
 </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>