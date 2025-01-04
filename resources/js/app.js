import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var channel =Eche.private(`App.Models.User.${userID}`);
channel.notification(function(data){
    console.log(data);
    alert(data.body);
  
})
