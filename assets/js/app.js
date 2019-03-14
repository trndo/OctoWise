
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


    const $ = require('jquery');

    require('jquery-mask-plugin');

    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote','redo','undo']
        })
        .catch( error => {
            console.error( error );
        } );

    $(document).ready(function(){
        $('#telNumb').mask('+38(000)000-00-00', {placeholder: "+38(___)___-__-__"});
        $('form').submit(function () {
            $('body').css('overflow', 'hidden');
            $('#preloader').css('display','block');
        })
    });



    // var LInH = document.getElementById('contacts_save');
    //
    // LInH.addEventListener('click', function () {                            Simple alert for form
    //     alert('Ваше письмо было отправленно');
    // });



