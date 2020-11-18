# Dogger
### Log api request & response by using Database
This package may help you to log api request,response,duration,method,ip,http status and retireved classes (controller,model,etc...) in database. 
### Installation
1. Install the package via composer
```
composer require cracki/dogger
```
2. Publish the config file 
```
php artisan vendor:publish --tag=config --provider="Cracki\Dogger\DoggerServiceProvider"
```
3. Migrate Table
```
php artisan migrate
```
### Usage
```php
//in api.php or web.php
Route::group([
    'middleware'=> 'dogger'
], function () {
    ...
    //Your routes is here.
    ...
});
```
### Custom Error
```php
//response json as follow
{
    'result' : 'error', // (or 'success' accepted only 2 enum)
    ...
}
```
### Logs View
![screenshot](screenshot.png)
### Routes List
|route    |method   |description
|:----|:----|:----|
|/dogger| get     |view logs
|/dogger/delete|post  |clear logs
|/dogger/api/get-all| get    |get logs with json
|/dogger/api/delete-all| post     |delete all

## License
 
The MIT License (MIT)

Copyright (c) 2020 Nay Lin Aung

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
