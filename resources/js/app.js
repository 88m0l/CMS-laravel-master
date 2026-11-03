import.meta.glob(["../images/**", "../fonts/**"]);
import './bootstrap';

import { ClassicEditor, Essentials, Bold, Italic, Font, Paragraph } from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';
import coreTranslations from 'ckeditor5/translations/ar.js';


if(document.querySelector("#editor")){
    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        licenseKey: 'GPL', // Or 'GPL'.
        contentLanguageDirection: 'rtl',
        language: {
            ui: "ar",
            content: "ar"
        },
        plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
        toolbar: [
            'undo', 'redo', '|', 'bold', 'italic', '|',
            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
        ],
        translations: [
            coreTranslations,
        ]
    } )
    .then( /* ... */ )
    .catch( /* ... */ );
}

