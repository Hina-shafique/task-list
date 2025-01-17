<x-layout>
    <section>
       <h1 class="text-bold text-3xl mb-4 ">Books</h1>
    </section>
    <section class="mt-12"> 
        <form method="GET" action="/books" class="mb-4 flex items-center space-x-2">
        <input 
        type="text" 
        name="title" 
        placeholder="Search by title"
        value="{{ request('title') }}" class="border rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        <input 
        type="hidden" 
        name="filter" 
        value="{{ request('filter') }}" />
        <x-button> Search </x-button>
        <x-button href="/books"> Claer </x-button>
  </form>
    </section>
    <section>
    <div class="flex space-x-4 bg-gray-100 p-4 text-center">
    @php
      $filters = [
          'Latest' => 'Latest',
          'popular_last_month' => 'Popular Last Month',
          'popular_last_6months' => 'Popular Last 6 Months',
          'highest_rated_last_month' => 'Highest Rated Last Month',
          'highest_rated_last_6months' => 'Highest Rated Last 6 Months',
      ];
    @endphp

    @foreach ($filters as $key => $label)
    <a href="/books?{{ http_build_query([...request()->except('filter'), 'filter' => $key]) }}"
        class="px-4 py-2 border rounded-md {{ request('filter') === $key ? 'bg-white text-black' : '' }}">
        {{ $label }}
    </a>
    @endforeach
        </div>
    </section>
    <section class="mt-2 space-y-4 shadow">
        <x-section-wide :$books />
    </section>
</x-layout>