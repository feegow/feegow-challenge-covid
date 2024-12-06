@props(['order', 'route'])

<div class="flex flex-{{$order}} {{$order == 'col' ? 'space-y-3' : 'space-x-3'}} justify-center items-center">
    <a href="{{$route}}">
        <img class="rounded-lg shadow-lg" src="{{ asset('imgs/logo.png') }}" alt="logo">
    </a>
    <span class="text-gray-900 dark:text-white uppercase text-lg">feegow clinic</span>
</div>

