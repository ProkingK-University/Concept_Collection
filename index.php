<?php

echo
(
    "<!DOCTYPE html>
    <html lang='en'>

    <head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <link rel='stylesheet' href='css/cars.css'>
    <link rel='shortcut icon' href='img/favicon.png' type='image/png'>

    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Tilt+Warp&display=swap' rel='stylesheet'>

    <script src='https://kit.fontawesome.com/c8a9f34c0a.js' crossorigin='anonymous'></script>
    <script src='https://code.jquery.com/jquery-3.6.4.js' integrity='sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E='
        crossorigin='anonymous'></script>

    <title>Concept Collection</title>
    </head>

    <body>                                                                                                 

    <svg id='loading' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'
        style='margin: auto; background: rgb(15, 25, 78); shape-rendering: auto;' width='200px' height='200px'
        viewBox='0 0 100 100' preserveAspectRatio='xMidYMid'>
        <path fill='none' stroke='#47b5ff' stroke-width='8' stroke-dasharray='42.76482137044271 42.76482137044271'
        d='M24.3 30C11.4 30 5 43.3 5 50s6.4 20 19.3 20c19.3 0 32.1-40 51.4-40 C88.6 30 95 43.3 95 50s-6.4 20-19.3 20C56.4 70 43.6 30 24.3 30z'
        stroke-linecap='round' style='transform:scale(0.8);transform-origin:50px 50px'>
        <animate attributeName='stroke-dashoffset' repeatCount='indefinite' dur='1s' keyTimes='0;1'
            values='0;256.58892822265625'></animate>
        </path>
        <!-- [ldio] generated by https://loading.io/ -->
    </svg>"
);

require_once "header.php";

echo
(
    "<main class='main-section'>

        <div class='function-bar'>

        <div class='filter'>
            <button class='filterbtn'>Filter</button>
            <div class='filter-content'>
            <label class='filter-type'>Transmition</label>
            <label><input id='t_auto' type='radio' name='transmition' value='Automatic'> Automatic</label>
            <label><input id='t_man' type='radio' name='transmition' value='Manual'> Manual</label>
            <label class='filter-type'>Brands</label>
            <label><input id='b_bmw' type='radio' name='brand' value='BMW'> BMW</label>
            <label><input id='b_audi' type='radio' name='brand' value='Audi'> Audi</label>
            </div>
        </div>

        <div class='sort-by'>
            <label for='sort' class='sort'>Sort by:</label>
            <select id='sort'>
            <option value='make'>Name</option>
            <option value='max_speed_km_per_h'>Speed</option>
            </select>
        </div>

        <div class='search-container'>
            <form>
            <input id='search' type='text' placeholder='Search...'>
            <button type='submit'><i class='fas fa-search'></i></button>
            </form>
        </div>

        </div>

        <section class='cars'>


        <div id='not-found'>
            <svg id='glass' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'
            style='margin: auto; background: rgb(15, 25, 78); display: block; shape-rendering: auto;' width='200px'
            height='200px' viewBox='0 0 100 100' preserveAspectRatio='xMidYMid'>
            <g transform='translate(50 50)'>
                <g transform='scale(0.8)'>
                <g transform='translate(-50 -50)'>
                    <g>
                    <animateTransform attributeName='transform' type='translate' repeatCount='indefinite'
                        dur='1.923076923076923s' values='-20 -20;20 -20;0 20;-20 -20' keyTimes='0;0.33;0.66;1'>
                    </animateTransform>
                    <path fill='#ffffff'
                        d='M44.19 26.158c-4.817 0-9.345 1.876-12.751 5.282c-3.406 3.406-5.282 7.934-5.282 12.751 c0 4.817 1.876 9.345 5.282 12.751c3.406 3.406 7.934 5.282 12.751 5.282s9.345-1.876 12.751-5.282 c3.406-3.406 5.282-7.934 5.282-12.751c0-4.817-1.876-9.345-5.282-12.751C53.536 28.033 49.007 26.158 44.19 26.158z'>
                    </path>
                    <path fill='#47b5ff'
                        d='M78.712 72.492L67.593 61.373l-3.475-3.475c1.621-2.352 2.779-4.926 3.475-7.596c1.044-4.008 1.044-8.23 0-12.238 c-1.048-4.022-3.146-7.827-6.297-10.979C56.572 22.362 50.381 20 44.19 20C38 20 31.809 22.362 27.085 27.085 c-9.447 9.447-9.447 24.763 0 34.21C31.809 66.019 38 68.381 44.19 68.381c4.798 0 9.593-1.425 13.708-4.262l9.695 9.695 l4.899 4.899C73.351 79.571 74.476 80 75.602 80s2.251-0.429 3.11-1.288C80.429 76.994 80.429 74.209 78.712 72.492z M56.942 56.942 c-3.406 3.406-7.934 5.282-12.751 5.282s-9.345-1.876-12.751-5.282c-3.406-3.406-5.282-7.934-5.282-12.751 c0-4.817 1.876-9.345 5.282-12.751c3.406-3.406 7.934-5.282 12.751-5.282c4.817 0 9.345 1.876 12.751 5.282 c3.406 3.406 5.282 7.934 5.282 12.751C62.223 49.007 60.347 53.536 56.942 56.942z'>
                    </path>
                    </g>
                </g>
                </g>
            </g>
            </svg>

            <h1>Sorry, No Results Found...</h1>
        </div>

        </section>

    </main>"
);

require_once "footer.php";

echo
(
    "<script src='js/cars.js'></script>

    </body>

    </html>"
);

?>