1. How to use your website.

My website is pretty simple you just need to enter the URL and you will be sent to the home page.
The Login/Register is at the top right of screen.
Once you click that you will be taken to the sign up page.
There you can enter your details and if valid you will registered.

2. Default Login Details.

Login is to be done in Practical 4.
But the API KEy for my API is "ashleyistheGOAT69".

3.Any functionality not impleamented.
No everything is complete.

4.Explanations for the password requirements, choice of hashing algorithm and generation of API keys

Password need to have different characters,symbols, numbers and a ceratin lenght to make them more secure.
Bcrypt was used to hash the password since it adds its own salt and is the best hasing algorithm natively on PHP 7.3.
"random_bytes" function was used to generate random bytes then it was converted to base 64 with the length of 20.