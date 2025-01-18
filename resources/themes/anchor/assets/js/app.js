window.demoButtonClickMessage = function(event){
    event.preventDefault(); new FilamentNotification().title('Modify this button in your theme folder').icon('heroicon-o-pencil-square').iconColor('info').send()
}

require('./bootstrap');
import React from 'react';
import ReactDOM from 'react-dom';


if (document.getElementById('quiz-page')) {
  ReactDOM.render(<QuizPage />, document.getElementById('quiz-page'));
}
