import React from 'react';
import ReactDOM from 'react-dom';


    ReactDOM.render(
        <div>
            alert('Work');
        </div>,
        document.getElementById('contacts_save')
    );


                                        //JS

    var LInH = document.getElementById('contacts_save');

    LInH.addEventListener('click', function () {
        alert('Ваше письмо было отправленно');
    });

