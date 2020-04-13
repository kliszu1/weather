
import '../../css/weather/weather.css';

$( document ).ready(function() {
    $('.weatherContner').on( "click",".checkWeather", function() {
        getWeather();
    }); 
});

function getWeather(){
    $('.weatherContnerErrorMessage').text();
    
    var serviceType = $('.serviceType').val();
    var weatherContnerCity = $('.cityWeather').val();
    
    if(serviceType.length <= 0 || weatherContnerCity.length <= 0){
        $('.weatherContnerErrorMessage').text('Pola nie mogą być puste');
        return false;
    }
    
    $.ajax({ 
        url: '/public/index.php/ajax/',
        type: 'post', 
        data: {
            serviceType: serviceType,
            city: weatherContnerCity,
        }, 
        dataType : 'json',
        success: function(response){ 
            switch(response.status){
                case 'error':
                    $('.weatherContnerErrorMessage').text();
                    $('.weatherContnerErrorMessage').text(response.message);
                break;
                case 'ok':
                    $('.weatherContnerBody').html();
                    $('.weatherContnerBody').html(response.html);
                break;
            }
        }, 
    });
}