const API_URL = "https://wheatley.cs.up.ac.za/api/";

const API_PARAMS =
{
    limit: 105,
    type: "GetAllMakes",
    studentnum: "",
    apikey: ""
};

const brands = $(".brands");

$(window).on("load", () => {
    loadData();

    const theme = getCookie("theme");

    if (theme == "lightmode") {
        updateTheme("Light Mode");
    }
});

async function loadData(){
    showLoading();

    try {
        const response = await $.ajax({
            url: API_URL,
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(API_PARAMS),
            complete: function () {
                hideLoading();
            }
        });

        createData(response);
    }
    catch (error) {
        console.error(error);
    }
}

function createData(response) {
    for (let i = 0; i < 105; i += 5) {
        const brandCard = $("<div>").addClass("brands-card");
        const brandImage = $("<img>").attr("alt", "brand image");

        setImage(brandImage, response.data[i]);

        const brandTitle = $("<h2>").text(response.data[i]);
        const learnMore = $("<button>").addClass("learn").text("Learn More");

        brandCard.append(brandImage, brandTitle, learnMore);
        brands.append(brandCard);
    }
}

function setImage(image, brand) {
    $.ajax({
        url: API_URL + "getimage?brand=" + brand,
        success: function(url) {
            image.attr("src", url);
        },
        error: function() {
            console.error("Error loading image.");
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

function showLoading() {
    $("svg").css("display", "block");
}

function hideLoading() {
    $("svg").hide(1000);
}