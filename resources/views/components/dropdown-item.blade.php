@props(['active' => false])
@php
    $classes ="block text-left text-sm leading-6 px-3 hover:bg-blue-500 focus:bg-blue-500 hover:text-white";
    if ( $active ) {
        $classes .= " bg-blue-500 text-white";
    }
 @endphp
<a {{$attributes([ 'class' => $classes ])}}>{{ $slot  }}</a>

