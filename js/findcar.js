// I chose asynchronous calls because it does not cause blocking and executes in parallel

const API_PARAMS =
{
    search:
    {
        body_type: "",
        engine_type: "",
        transmission: "",
        drive_wheels: ""
    },
    limit: 8,
    return: "*",
    sort: "make",
    order: "ASC",
    type: "GetAllCars",
    studentnum: "",
    apikey: ""
};

$(window).on("load", () => {
    const theme = getCookie("theme");

    if (theme == "lightmode") {
        updateTheme("Light Mode");
    }
});

const cars = $(".cars");

function loadData() {
    $.ajax({
      url: "https://wheatley.cs.up.ac.za/api/",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify(API_PARAMS),
      success: (response) => {
        createData(response);
      }
    });
}

function createData(response) {
    if (response.data.length !== 0) {
        $("#not-found").hide();
    }
    else {
        $("#not-found").css("display", "contents");
    }

    $.each(response.data, (i, item) => {
        const carCard = $("<div>").addClass("car-card");
        const carImage = $("<img>").attr("alt", "car image");

        setImage(carImage, item.make, item.model);

        const carTitle = $("<h2>").html(item.make + " " + item.model);
        const carInfo = $("<div>").addClass("info");

        const yearInfo = $("<p><").html("<i class='fa-solid fa-calendar-days'></i> " + item.year_to);
        const typeInfo = $("<p>").html("<i class='fa-solid fa-car'></i> " + item.body_type);
        const engineInfo = $("<p>").html("<i class='fa-solid fa-gas-pump'></i> " + item.engine_type);
        const transInfo = $("<p>").html("<i class='fa-solid fa-gear'></i> " + item.transmission);
        const speedInfo = $("<p>").html("<i class='fa-solid fa-gauge'></i> " + item.max_speed_km_per_h);
        const learnMore = $("<button>").addClass("learn").html("Learn More");

        carInfo.append(speedInfo, yearInfo, typeInfo, engineInfo, transInfo);
        carCard.append(carImage, carTitle, carInfo, learnMore);
        cars.append(carCard);
    });
}

const make = $("#make");
const carType = $("#type");
const engine = $("#engine");
const cyclinders = $("#cyclinders");
const wheels = $("input[name='drivewheel']");
const trans = $("input[name='transmission']");

$("form").on("submit", (event) => {
    find(event);
});

function find(event)
{
    event.preventDefault();
    $(".cars").empty();

    transType = trans.filter(":checked").val();
    wheelsType = wheels.filter(":checked").val();

    API_PARAMS.search.body_type = carType.val();
    API_PARAMS.search.transmission = transType;
    API_PARAMS.search.drive_wheels = wheelsType;
    API_PARAMS.search.engine_type = engine.val();

    if (make.val()) {
        API_PARAMS.search.make = make.val();
    }

    if (cyclinders.val()) {
        API_PARAMS.search.number_of_cylinders = cyclinders.val();
    }

    loadData();
}

function setImage(image, brand, model) {
    $.ajax({
        url: "https://wheatley.cs.up.ac.za/api/getimage",
        type: "GET",
        data: { brand: brand, model: model },
        success: function(result) {
            image.attr("src", result);
        },
        error: function() {
            console.log("An error occurred while fetching the image");
        }
    });
}

const login_button = $(".login");
login_button.on("click", login);

function login() {
    if (login_button.html().indexOf("Logout") !== -1) {
        if (confirm("Are you sure you want to logout?")) {
            $(location).attr("href", "logout.php");
        }
    }
    else {
        $(location).attr("href", "signup.php");
    }
}

const theme = $(".theme");

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