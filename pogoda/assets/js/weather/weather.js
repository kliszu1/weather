
import '../../css/weather/weather.css';
defaultStart();


$( document ).ready(function() {
    $('body').on( "click",".checkWeather", function() {
        getWeather($('.serviceType').val(),$('.cityWeather').val());
    }); 
});

function defaultStart(){
    $('.serviceType').val('1');
    $('.cityWeather').val('warszawa');
    getWeather('1','warszawa');
}
function getWeather(serviceType,weatherContnerCity){
    
    $('.weatherContnerErrorMessage').text('');
    
    if(serviceType.length <= 0 || weatherContnerCity.length <= 0){
        $('.weatherContnerErrorMessage').text('Pola nie mogą być puste');
        return false;
    }

    Swal.showLoading();
    
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
                    $('.weatherContnerErrorMessage').text('');
                    $('.weatherContnerErrorMessage').text(response.message);
                break;
                case 'ok':
                    $('.weatherContnerBody').html();
                    $('.weatherContnerBody').html(response.html);
                break;
            }
            Swal.close();
        }, 
    });
}