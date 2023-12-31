@props([ 'name'])

<x-form.field>
    <x-form.label name="{{$name}}"></x-form.label>
    <input class="border border-gray-200 p-2 w-full rounded"
           name="{{$name}}"
           id="{{$name}}"
           required
            {{$attributes(['name' => old( $name )])}}
    >
    <x-form.error name="$name"/>
</x-form.field>
