
import '../../css/weather/weather.css';

$( document ).ready(function() {
    $('.weatherContner').on( "click",".checkWeather", function() {
        getWeather();
    }); 
});

function getWeather(){
    
    var serviceType = $('.serviceType').val();
    var weatherContnerCity = $('.cityWeather').val();
    
    console.log(serviceType);
    console.log(weatherContnerCity);
    if(serviceType.length <= 0 || weatherContnerCity.length <= 0){
        $('.weatherContnerErrorMessage').text('Pola nie mogą być puste');
        return false;
    }
    
    $.ajax({ 
        url: '/public/ajax/weather/',
        type: 'post', 
        data: {
            serviceType: serviceType,
            city: weatherContnerCity,
        }, 
        dataType : 'json',
        success: function(response){ 

        }, 
    });
}