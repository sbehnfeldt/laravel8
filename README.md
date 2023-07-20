# Laracast's "Laravel 8 from Scratch"
ref: https://laracasts.com/series/laravel-8-from-scratch

## Lesson 5: How a Route Loads a View
`$> php artisan serve`

`routes/web.php`  
`resources/views`


## Lesson 6: Include CSS and JavaScript
Resource source files in `resources/css` will compile down to `public` folder.
For now, write directly to files in `public` folder.


## Lesson 7: Make a Route and Link to It
Make a new route in `routes/web.php`

## Lesson 8: Store Blog Posts as HTML files
* Variables in Blade templates
* passing values for the variables to Blade at runtime
* wildcards in routes

## Lesson 9: Route Wildcard Constraints
Route::get( '{placeholder})
Route::where('placeholder', regex)
Route::whereAlpha('placeholder')
Route::whereAlphaNumeric('placeholder')
Route::whereAlphaNumber('placeholder')

## Lesson 10: Use Caching for Expensive Operations
cache()->remember($key, $ttl, $callback)  
$ttl can be time in seconds, or DateTimeInterval; for example:
* now()->addMinutes(20)
* now()->addHour()
* now()->addDay()
* now()->addDays(5)
* now()->addWeeks(2)


## Lesson 11: Use the Filesystem Class to Read a Directory
File::files($directory)  
**Laravel Helper Functions:**
* base_path()
* app_path()
* resource_path()  

ModelNotFoundException()  

Moving functionality to static functions of Model classes; eg:
* Post::all()
* Post::find($slug)


## Lesson 12: Find a Composer Package for Post Metadata
**yaml front matter**    
`$> composer require spatie/yaml-front-matter`
```php
$doc = \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile(
    resource_path('posts/my-fourth-post.html');
);
$doc->body();
$doc->matter();
$doc->matter($attrib);
$doc->$attrib;

```
**Laravel collections**  
Laravel helper functions:  
```php
collect($array)
 ->map(function($item) {
    return ... 
 });

```
