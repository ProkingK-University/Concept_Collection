<?php

echo
(
    "<!DOCTYPE html>
    <html lang='en'>
    
    <head>
      <meta charset='UTF-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    
      <link rel='stylesheet' href='css/findcar.css'>
      <link rel='shortcut icon' href='img/favicon.png' type='image/png'>
    
      <script src='https://kit.fontawesome.com/c8a9f34c0a.js' crossorigin='anonymous'></script>
      <script src='https://code.jquery.com/jquery-3.6.4.js' integrity='sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=' crossorigin='anonymous'></script>
    
      <title>Concept Collection</title>
    </head>
    
    <body>"
);

require_once "header.php";

echo
(
    "<main class='main-section'>
    
    <h1>Want to find your perfect car ?</h1>

    <form>

      <div class='question'>
        <label for='type'>1. What type of car do you prefer?*</label>
        <br>
        <select id='type' name='type' required>
          <option value='Coupe'>Coupe</option>
          <option value='Roadster'>Roadster</option>
          <option value='Sedan'>Sedan</option>
          <option value='Hatchback'>Hatchback</option>
        </select>
      </div>

      <div class='question'>
        <label>2. Do you prefer automatic or manual transmission?*</label>
        <br>
        <input id='auto' type='radio' name='transmission' value='Automatic' required>
        <label for='auto'>Automatic</label>
        <input id='man' type='radio' name='transmission' value='Manual' required>
        <label for='manual'>Manual</label>
      </div>

      <div class='question'>
        <label>3. Do you require all-wheel drive?*</label>
        <br>
        <input id='rear' type='radio' name='drivewheel' value='rear' required>
        <label for='drivewheel'>Rear-Wheel</label>
        <input id='all' type='radio' name='drivewheel' value='all' required>
        <label for='drivewheel'>All-Wheel</label>
      </div>

      <div class='question'>
        <label for='type'>4. What type of engine do you prefer?*</label>
        <br>
        <select id='engine' name='type' required>
          <option value='Gasoline'>Gasoline</option>
          <option value='Diesel'>Diesel</option>
          <option value='Hybrid'>Hybrid</option>
          <option value='Electric'>Electric</option>
        </select>
      </div>

      <div class='question'>
        <label>5. What make do you want?</label>
        <br>
        <input id='make' type='text' name='make' placeholder='eg. BMW'>
      </div>

      <div class='question'>
        <label>6. What number of cyclinders do you want?</label>
        <br>
        <input id='cyclinders' type='text' name='cyclinders' placeholder='eg. 8'>
      </div>

      <input type='submit' value='Submit' class='submitbtn'>

    </form>

    <section class='suggestions'>

      <h1>Suggestions</h1>

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

      <section class='cars'>
      </section>

    </section>

  </main>"
);

require_once "footer.php";

echo
(
  "<script src='js/findcar.js'></script>
  
  </body>
  
  </html>"
);

?>