$(window).on("load", () => {
    const theme = getCookie("theme");

    if (theme == "lightmode") {
        updateTheme("Light Mode");
    }
});

const leftForm = $("#left-search");
const rightForm = $("#right-search");

const leftSearch = $("#l-search");
const rightSearch = $("#r-search");

leftForm.submit((event) => {
    search(event, leftSearch);
});

rightForm.submit((event) => {
    search(event, rightSearch);
});

function search(event, input) {
    event.preventDefault();

    const query = input.val().split(" ", 2);

    const API_PARAMS =
    {
        studentnum: "",
        apikey: "",
        type: "GetAllCars",
        return: "*",
        limit: 1,
        search:
        {
            make: query[0],
            model: query[1]
        }
    }

    $.ajax({
        type: "POST",
        url: "https://wheatley.cs.up.ac.za/api/",
        data: JSON.stringify(API_PARAMS),
        success: (response) => {
            setData(response, input.attr("id")[0]);
        }
    });
}

function setData(response, side) {
    const brand = response.data[0].make;
    const model = response.data[0].model

    setImage($("#" + side + "-img"), brand, model);

    $("#" + side + "-title").html(response.data[0].make + " " + response.data[0].model);
    $("#" + side + "-speed").html(response.data[0].max_speed_km_per_h);
    $("#" + side + "-year").html(response.data[0].year_to);
    $("#" + side + "-body").html(response.data[0].body_type);
    $("#" + side + "-fuel").html(response.data[0].engine_type);
    $("#" + side + "-trans").html(response.data[0].transmission);
}

function setImage(image, brand, model) {
    $.ajax({
        type: "GET",
        url: "https://wheatley.cs.up.ac.za/api/getimage",
        data: {
        brand: brand,
        model: model
        },
        success: (result) => {
            image.attr("src", result);
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
    } else {
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