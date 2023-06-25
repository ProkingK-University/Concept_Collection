// I chose asynchronous calls because it does not cause blocking and executes in parallel
var apiParameters;
const cars = $(".cars")[0];
const notFoundScreen = $("#not-found");

$(window).on("load", () => {
    loadData(false);

    const theme = getCookie("theme");

    if (theme == "lightmode") {
        updateTheme("Light Mode");
    }
});

$(window).on('beforeunload', () => {
    saveState();
});

function saveState() {
    const apiState = apiParameters;

    sessionStorage.setItem('currentAPIState', JSON.stringify(apiState));
}

function loadData(wasCalled) {
    showLoading();

    const savedState = sessionStorage.getItem('currentAPIState');

    if (savedState == null && wasCalled == false) {
        var apiKey = getCookie("apikey");

        if (apiKey == "") {
            apiKey = "user";
        }

        var defaultParameters = {
            limit: 20,
            fuzzy: true,
            return: ["id_trim", "make", "model", "year_to", "body_type", "engine_type", "drive_wheels", "transmission", "max_speed_km_per_h", "image"],
            search: {
                transmission: "Automatic"
            },
            order: "DESC",
            type: "GetAllCars",
            sort: "max_speed_km_per_h",
            apikey: apiKey
        }

        let userParameters = getCookie("preferences");

        if (userParameters != "") {
            apiParameters = JSON.parse(userParameters);
            apiParameters.type = "GetAllCars";
            console.log(apiParameters);
        }
        else {
            apiParameters = defaultParameters;
        }
    }
    else if (savedState && wasCalled == false) {
        let userParameters = getCookie("preferences");

        if (userParameters != "") {
            apiParameters = JSON.parse(userParameters);
            apiParameters.type = "GetAllCars";
            console.log(apiParameters);
        }
        else {
            const state = JSON.parse(savedState);
            apiParameters = state;
        }
    }

    $.ajax({
        type: "POST",
        url: "http://localhost/api.php",
        data: JSON.stringify(apiParameters),
        success: function (response) {
            createData(response);
        },
        complete: function () {
            hideLoading();
        }
    });
}

function createData(response) {
    if (response.data.length === 0) {
        $("#not-found").show();
        return;
    }

    $("#not-found").hide();

    $.each(response.data, function (i, car) {
        const carCard = $("<div>").addClass("car-card");
        carCard.attr("id", car.id_trim);
        const carImage = $("<img>").attr("alt", "car image");
        
        carImage.attr("src", car.image);

        const carTitle = $("<h2>").html(car.make + " " + car.model);
        const carInfo = $("<div>").addClass("info");
        const yearInfo = $("<p>").append($("<i>").addClass("fa-solid fa-calendar-days")).append(" " + car.year_to);
        const typeInfo = $("<p>").append($("<i>").addClass("fa-solid fa-car")).append(" " + car.body_type);
        const engineInfo = $("<p>").append($("<i>").addClass("fa-solid fa-gas-pump")).append(" " + car.engine_type);
        const transInfo = $("<p>").append($("<i>").addClass("fa-solid fa-gear")).append(" " + car.transmission);
        const speedInfo = $("<p>").append($("<i>").addClass("fa-solid fa-gauge")).append(" " + car.max_speed_km_per_h);
        const rate = $("<button>").addClass("rate").html("Rate");
        rate.on("click", rateCar);

        carInfo.append(speedInfo, yearInfo, typeInfo, engineInfo, transInfo);
        carCard.append(carImage, carTitle, carInfo, rate);
        $(".cars").append(carCard);
    });
}

const input = $('#search');
const form = $('form').eq(0);

form.on('submit', search);

function search(event) {
    event.preventDefault();

    while ($('.cars').children().last().attr('id') !== 'not-found') {
        $('.cars').children().last().remove();
    }

    const query = input.val().split(' ', 2);

    apiParameters.search = {
        'make': query[0],
        'model': query[1]
    }

    loadData(true);
}

const sortSelector = $('#sort');
sortSelector.on('change', sort);

function sort(event) {
    event.preventDefault();

    while ($('.cars').children().last().attr('id') !== 'not-found') {
        $('.cars').children().last().remove();
    }

    const selection = sortSelector.val();

    apiParameters.sort = selection;

    if (selection === 'make') {
        apiParameters.order = 'ASC';
    } else {
        apiParameters.order = 'DESC';
    }

    loadData(true);
}

var prevMakeData;
var prevTransData;

$("#b_bmw, #b_audi, #t_man, #t_auto").on("change", filter);

function filter(event) {
    event.preventDefault();

    while ($('.cars').children().last().attr('id') !== 'not-found') {
        $('.cars').children().last().remove();
    }

    if ($(this).prop("checked")) {
        if (this.name[0] == "t") {
            prevTransData = apiParameters.search.transmission;
            apiParameters.search.transmission = this.value;
        }
        else {
            prevMakeData = apiParameters.search.make;
            apiParameters.search.make = this.value;
        }
    }
    else {
        if (this.name[0] == "t") {
            apiParameters.search.transmission = prevTransData;
        }
        else {
            apiParameters.search.make = prevMakeData;
        }
    }

    loadData(true);
}

const login_button = $(".login");
login_button.on("click", login);

function login() {
    if (login_button.html().indexOf("Logout") !== -1) {
        if (confirm("Are you sure you want to logout?")) {
            $(location).attr("href", "logout.php");
        }
    } else {
        $(location).attr("href", "login.php");
    }
}

const theme = $(".theme");
theme.on("click", changeTheme);

function changeTheme()
{
    if (theme.text() == "Light Mode")
    {
        console.log(document.cookie);
        document.cookie = "theme=lightmode; SameSite=Lax";
        updateTheme(theme.text());
    }
    else
    {
        document.cookie = "theme=darkmode; SameSite=Lax";
        console.log(document.cookie);
        updateTheme(theme.text());
    }
}

const save = $(".preferences");
save.on("click", savePreferences);

function savePreferences()
{
    showLoading();

    apiParameters.type = "Update";

    $.ajax({
        type: "POST",
        url: "http://localhost/api.php",
        data: JSON.stringify(apiParameters),
        complete: function () {
            hideLoading();
        }
    });
}

function rateCar()
{
    let rating = prompt("Rate the car from 1 to 5:");

    if (rating < 1 || rating > 5) {
        alert("Incorrect rating entered");
        return;
    }

    const api_params =
    {
        return: "*",
        type: "Rate",
        rating: parseInt(rating),
        apikey: getCookie("apikey"),
        id: $(this).parent().attr("id")
    }
    
    $.ajax({
        type: "POST",
        url: "http://localhost/api.php",
        data: JSON.stringify(api_params),
        complete: function () {
            hideLoading();
        }
    });
}

function updateTheme(mode)
{
    if (mode == "Light Mode")
    {        
        theme.text("Dark Mode");

        $('html *').each(function() {
            var elementStyle = window.getComputedStyle(this);
          
            if (elementStyle.color === 'rgb(255, 255, 255)') {
              $(this).css('color', 'black');
            }
          
            if (elementStyle.backgroundColor === 'rgb(15, 25, 78)') {
              $(this).css('background-color', '#47B5FF');
            } else if (elementStyle.backgroundColor === 'rgb(71, 181, 255)') {
              $(this).css('background-color', '#0f194e');
            }
        });
    }
    else
    {
        theme.text("Light Mode");

        $('html *').each(function() {
            var elementStyle = window.getComputedStyle(this);
          
            if (elementStyle.color === 'rgb(0, 0, 0)') {
              $(this).css('color', 'white');
            }
          
            if (elementStyle.backgroundColor === 'rgb(71, 181, 255)') {
                $(this).css('background-color', '#0f194e');
            } else if (elementStyle.backgroundColor === 'rgb(15, 25, 78)') {
                $(this).css('background-color', '#47B5FF');
            }
        });
    }
}

function getCookie(name) {
    var cookieString = document.cookie;
    var cookies = cookieString.split("; ");

    console.log(cookies);

    for (var i = 0; i < cookies.length; i++) {
      var cookie = cookies[i].split("=");

      if (cookie[0] === name) {
        return decodeURIComponent(cookie[1]);
      }
    }

    return "";
}

function showLoading() {
    $("svg").eq(0).css("display", "block");
}

function hideLoading() {
    $("#loading").hide(1000);
}