@if(isset($attributes['href']))
    <a href="{{ $attributes['href'] }}" {{ $attributes->merge(['class' => 'px-4 py-2 bg-white-100 border text-gray-700 rounded-md hover:bg-gray-400']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'px-4 py-2 bg-white-100 border text-gray-700 rounded-md hover:bg-gray-400','type'=>'submit']) }}>
        {{ $slot }}
    </button>
@endif
