 Coding challenge
 
 Tutorial for installation
 
 1. git clone https://github.com/userco/challenge.git
 2. composer install
 3. In file .env change database settings
 4. In file config/database.php change database settings
 5. php artisan migrate
 6. php artisan key:generate
 
 7  php artisan cache:clear
 
 8. php artisan config:clear
 9. php artisan serve
 
 Go to localhost:8000.
 There is a menu with two options:
 1. "Generate QR and key codes" for the first part of the challenge
 2. "Verify code and the username" for the second part of the challenge
 
 
 
