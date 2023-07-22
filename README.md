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

## Lesson 13: Collection Sorting and Caching
Caching: 
```php
cache()->put( $key, $value );
cache([ $key, $value ] );
cache([ $key, $value ], $expiration );
cache()->remember( $key, $ttl, $value|$callback);
cache()->rememberForever($key, $value);
cache()->forget( $key );
$value = cache()->get( $key );
$value = cache($key);
```

Sorting:
```php
$collection->sortBy($field);
$collection->sortByDesc($field);
```

## Lesson 14: Blade: The Absolute Bassics
```php
<?= $placeholder ?>   // Standard PHP
{{ $placeholder }}    // shorthand for above; escapes HTML
{!! $placeholder !!}  // Does not escape HTML
```
```php
@foreach ($items as $item)
...
@endforach
@if ($condition)
...
@endif
```
* Laravel compiles Blade templates down to PHP files in storage/framework/views directory


## Lesson 15: Blade Layouts Two Ways
### Sections  
@yield('sectionName')  
@extends('base')  
@section('sectionName')..@endsection  

### Components  
* Component templates stored in resources/views/components

**Component Template**  
  _views/components/layout.blade.php_  
  `{{ $content }}`

* Tag name matches component filename: eg, `<x-layout>` loads `components/layout.blade.php`


**Main Template**


Runtime content provided as attribute in component tag:
_view.blade.php_

`<x-layout content="...">...</x-layout>`
* Attribute name in component tag matches placeholder name in component file

Runtime content provided in x-slot tag:
```php
<x-layout>
	<x-slot name="content">...</x-slot>
</x-layout>
```

Runtime content provided as default slot:

`<x-layout>.....</x-layout>` w/o `<x-slot>` element replaces `{{ $slot }}` in component template

## Lesson 16: A few Tweaks and Considerations
Add Post::findOrFail() to complement Post::find()


## Lesson 17: Environment Files and Database Connections
Store config info (especially secret info!) in `.env`.  Never commit this file to github.

Run migrations:
`$> php artisan migrate`


## Lesson 18: Migrations: The Absolute Basics
Migrations described


## Lesson 19: Eloquent and the Active Record Pattern
* Every database table can have a corresponding Eloquent model
* tables are plural, models are singluar
* model object tied to single row in table

