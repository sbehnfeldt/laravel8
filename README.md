# Laracast's "Laravel 8 from Scratch"
ref: https://laracasts.com/series/laravel-8-from-scratch

## Section 2: The Basics
#### Lesson 5: How a Route Loads a View
`$> php artisan serve`

`routes/web.php`  
`resources/views`


### Lesson 6: Include CSS and JavaScript
Resource source files in `resources/css` will compile down to `public` folder.
For now, write directly to files in `public` folder.


### Lesson 7: Make a Route and Link to It
Make a new route in `routes/web.php`

### Lesson 8: Store Blog Posts as HTML files
* Variables in Blade templates
* passing values for the variables to Blade at runtime
* wildcards in routes

### Lesson 9: Route Wildcard Constraints
Route::get( '{placeholder})
Route::where('placeholder', regex)
Route::whereAlpha('placeholder')
Route::whereAlphaNumeric('placeholder')
Route::whereAlphaNumber('placeholder')

### Lesson 10: Use Caching for Expensive Operations
cache()->remember($key, $ttl, $callback)  
$ttl can be time in seconds, or DateTimeInterval; for example:
* now()->addMinutes(20)
* now()->addHour()
* now()->addDay()
* now()->addDays(5)
* now()->addWeeks(2)


### Lesson 11: Use the Filesystem Class to Read a Directory
File::files($directory)  
**Laravel Helper Functions:**
* base_path()
* app_path()
* resource_path()  

ModelNotFoundException()  

Moving functionality to static functions of Model classes; eg:
* Post::all()
* Post::find($slug)


### Lesson 12: Find a Composer Package for Post Metadata
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

### Lesson 13: Collection Sorting and Caching
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

## Section 3: Blade
### Lesson 14: Blade: The Absolute Bassics
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


### Lesson 15: Blade Layouts Two Ways
#### Sections  
@yield('sectionName')  
@extends('base')  
@section('sectionName')..@endsection  

#### Components  
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

### Lesson 16: A few Tweaks and Considerations
Add Post::findOrFail() to complement Post::find()


## Section 4: Working With Database

### Lesson 17: Environment Files and Database Connections
Store config info (especially secret info!) in `.env`.  Never commit this file to github.

Run migrations:
`$> php artisan migrate`


### Lesson 18: Migrations: The Absolute Basics
Migrations described


### Lesson 19: Eloquent and the Active Record Pattern
* Every database table can have a corresponding Eloquent model
* tables are plural, models are singluar
* model object tied to single row in table


### Lesson 20: Make a Post Model and Migration
`$> php artisan help make:migration`
`$> php artisan make:migration create_posts_table`

```php
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string( 'title' );
            $table->string( 'slug' );
            $table->text( 'excerpt');
            $table->text( 'body' );
            $table->timestamp('published_at' )->nullable();
            $table->timestamps();
        });
    }
```
`$> php artisan help make:model`
`$> php artisan make:model Post`


### Lesson 21: Eloquent Updates and HTML Escaping

### Lesson 22: 3 Ways to Mitigate Mass Assignment Vulnerabilities
Mass Assignment in constructors requires "$fillable" property in Model; 
it specifies which properties can be mass-assigned.  All other properites
will have their default values assigned.

```php
protected $fillable = [$field1, ...]
$> Model::create([$field1 => $val1, ...])
```
`protected $guarded` specifies properies _not_ mass-assignable

1. be explicit in $fillable property; or
2. be explicit in $guarded property; or
3. don't use mass-assignments at all 


### Lesson 23: Route Model Binding
Binding a _route key_ to an underlying _Eloquent Model_:  
```php
Route::get('/posts/{post}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
});
```
Notes:
1. Wildcard name ({post}) must match variable name ($post)
2. variable name must be type-hinted (Post $post)
3. runtime-value of {post} is assumed to be primary key of a record in posts table => Post object

 
To find by some unique column _other_ than the primary key:
```php
Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);
});
```
Behind the scenes, Laravel executes something like the following to find the value to pass to the callback:  
`Post::where('slug', $post)->firstOrFail()`

### Lesson 24: Your First Eloquent Relationship
Using "belongsTo" relation in Model for record in child table

### Lesson 25: Show All Posts Associated with a Category
Using "hasMany" relation in Model for record in parent table

### Lesson 26: Clockwork, and the N+1 Problem
N+1 Problem: 1 main SQL call, plus 1 more call for each record returned in the main SQL call.
Solution: Use the static ::with() call to reduce the number of database calls

### Lesson 27: Database Seeding Saves Time
Useful for creating fake data early in development process, when running and re-running and re-re-running migrations 

$> php artisan db:seed
$> php artisan make::seeder
$> php artisan migrate:fresh --seed # seed the database according to DatabaseSeeder::run()
DatabaseSeeder::run()

### Lesson 28: Turbo Boost With Factories
Use factories to improve seeding

### Lesson 29: View All Posts by an Author

### Lesson 30: Eager Load Relationships on an Existing Model
* load() method
* $with property
* without() method to override the Model's $with property


## Section 5: Integrate the Design

### Lesson 31: Convert the HTML and CSS to Blade

### Lesson 32: Blade Components and CSS Grids
* Component props
* Timestamps are instances of Carbon objects
* @props() in Blade components

### Lesson 33: Convert the Blog Post Page

### Lesson 34: A Small JavaScript Dropdown Detour
Dynamic drop-down control for categories using ApineJS
Added snakify utility to convert titles into slugs

### Lesson 35: How to Extract a Dropdown Blade Component
Built a drop-down component with a default slot, a named slot and a prop
Also extracted the SVG down-arrow to a generic "icon" component

### Lesson 36: Quick Tweaks and Clean-Up


## Section 6: Search

### Lesson 37: Search (The Messy Way)
Search for items in query string with `request('')`   
Build up a query incrementally, triggering it finally with `"->get()"`

### Lesson 38: Search (The Cleaner Way)
Controller classes  
Query Scopes: 
* `public function scopeFoo(QueryBuilder $query)` in the Model class 
* call `$model->foo()`
* QueryBuilder automatically passed as 1st parameter  

QueryBuilder 'when()' method


## Section 7: Filtering

### Lesson 39: Advanced Eloquent Query Constraints
Add filtering by 'category' in the query string (2 ways)  
Increasingly advanced query-builder functionality: whereExists(), whereHas(), whereColumn()

### Lesson 40: Extract a Category Dropdown Blade Component
Build <x-category-dropdown> component that builds on our previous <x-dropdown> component and uses a corresponding CategoryDropdown class.
The component is rendered by calling the class's "render" function, which therefore must include all information the component requires.

Also refactored Post-related Blade templates into a "posts" directory.


### Lesson 41: Author Filtering
Converted "authors" page to use query string

### Lesson 42: Merge Category and Search Queries
When both a category AND a search string are selected, search for the string ONLY in those categories; 
AND make sure the result page has both the category drop-down and search field field in properly

### Lesson 43: Fix a Confusing Eloquent Query Bug
Adjust the QueryBuild for the 'search' term in the Post class' scopeFilter() method to fix the boolean condition of the where clause. 


## Section 8: Pagination
### Lesson 44: Laughably Simple Pagination
Return `paginate()` instead of `get()`.  Assumes TailWind styling.
`$> php artisan vendor:publish` to copy publisher files (such as pagination Blade views) to local repo

## Section 9: Forms and Authentication
### Lesson 45: Build a Register User Page
By convention, controller's "create()" method displays form, "store()" method validates/stores submitted form  
`request->validate() method`  

### Lesson 46: Automatic Password Hashing with Mutators
Mutators and also accessors

### Lesson 47: Failed Validation and Old Input Data
"@error" Blade directive and "old()" method to display inline validation-error messages on form page
"$errors" variable to display validation-error messages as a group: $errors->any(), $errors->all()

### Lesson 48: Show a Success Flash Message
session()->flash( 'success', 'Your account has been created');

@if(session()->has( 'success'))
  <div x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    class="fixed bottom-3 right-3 bg-blue-500 text-white py-2 px-4 rounded-xl text-sm">
      <p>{{session('success')}}</p>
  </div>
@endif

### Lesson 49: Login and Logout
auth() and guest() Laravel helpers: auth()->login(), auth()->check(), auth()->logout()
@guest and @auth Blade directives
middleware('auth') and middleware( 'guest') for routes


### Lesson 50: Build the Log In Page
Created login page and associated login validation

### Lesson 51: Laravel Breeze Quick Peek
Authentication starter kit
```shell
$> composer require laravel/breeze --dev
$> php artisan breeze:install
$> npm install
$> npm run dev
```

