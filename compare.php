<?php

echo
(
    "<!DOCTYPE html>
    <html lang='en'>
    
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    
        <link rel='stylesheet' href='css/compare.css'>
        <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    
        <script src='https://kit.fontawesome.com/c8a9f34c0a.js' crossorigin='anonymous'></script>
        <script src='https://code.jquery.com/jquery-3.6.4.js' integrity='sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E='
        crossorigin='anonymous'></script>
    
        <title>Concept Collection</title>
    </head>
    
    <body>"
);

require_once "header.php";

echo
(
    "<main class='main-section'>
        <table>
            <thead>
                <tr>
                    <th class='header'>Search</th>
                    <td>
                        <div class='search-container'>
                            <form id='left-search'>
                                <input id='l-search' type='text' placeholder='Search...'>
                                <button type='submit'><i class='fas fa-search'></i></button>
                            </form>
                        </div>
                    </td>
                    <td>
                        <div class='search-container'>
                            <form id='right-search'>
                                <input id='r-search' type='text' placeholder='Search...'>
                                <button type='submit'><i class='fas fa-search'></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class='headerr'>Image</th>
                    <th>
                        <img src='' alt='car image' class='car-img' id='l-img'>
                    </th>
                    <th>
                        <img src='' alt='car image' class='car-img' id='r-img'>
                    </th>
                </tr>
                <tr>
                    <th class='header'>Title</th>
                    <th id='l-title'>-</th>
                    <th id='r-title'>-</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class='header'><i class='fa-solid fa-gauge'></i> Speed</td>
                    <td id='l-speed'>-</td>
                    <td id='r-speed'>-</td>
                </tr>
                <tr>
                    <td class='header'><i class='fa-solid fa-calendar-days'></i> Year</td>
                    <td id='l-year'>-</td>
                    <td id='r-year'>-</td>
                </tr>
                <tr>
                    <td class='header'><i class='fa-solid fa-car'></i> Body</td>
                    <td id='l-body'>-</td>
                    <td id='r-body'>-</td>
                </tr>
                <tr>
                    <td class='header'><i class='fa-solid fa-gas-pump'></i> Fuel</td>
                    <td id='l-fuel'>-</td>
                    <td id='r-fuel'>-</td>
                </tr>
                <tr>
                    <td class='header'><i class='fa-solid fa-gear'></i> Transmission</td>
                    <td id='l-trans'>-</td>
                    <td id='r-trans'>-</td>
                </tr>
            </tbody>
        </table>
    </main>"
);

require_once "footer.php";
    
echo
(
    "<script src='js/compare.js'></script>
    
    </body>
    
    </html>"
);

?>