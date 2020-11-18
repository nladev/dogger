# Dogger - Log http request & response by using Database
This package may help you to log api request,response,duration,method,ip,http status and retireved classes (controller,model,etc...) in database. 
### Installation
```
composer require cracki/dogger
```
```
php artisan vendor:publish --tag=config --provider="Cracki\Dogger\DoggerServiceProvider"
```
```
php artisan migrate
```
