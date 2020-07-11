const APIKEY = 'da960b9d9f121f9179a6ea6827e93b82';

// Appel à l'API Openweather avec ville en paramètre de fonction
let apiCall = function(city){
    let url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${APIKEY}&units=metric&lang=fr`;

    fetch(url).then((response) =>
        response.json().then((data) => {
            console.log(data);
            document.querySelector('#city').innerHTML = "" + data.name;
            document.querySelector('#temp').innerHTML = "<i class='fas fa-thermometer-half'></i>" + Math.round(data.main.temp) + '°';
            document.querySelector('#humidity').innerHTML = "<i class='fas fa-tint'></i>" + data.main.humidity + '%';
            document.querySelector('#wind').innerHTML = "<i class='fas fa-wind'></i>" +  data.wind.speed + 'km/h';
            document.querySelector('#description').innerHTML = data.weather[0].description;
        })
    ).catch(err => console.log('Erreur : '+ err));
}

// Ecouteur d'évènement sur la soummission du formulaire
document.querySelector('form').addEventListener('submit', function(e){
    e.preventDefault();
    let ville = document.querySelector('#inputCity').value;

    apiCall(ville);
});

//Appel par défault au chargement de la page
apiCall('Paris');
