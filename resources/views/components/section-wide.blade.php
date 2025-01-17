@props(['books'])
@foreach ($books as $book)
    <section class="gap-x-6 flex border hover:border-gray-600 p-5 rounded-xl">
        <div class="flex-1">
            <a href="/books/{{ $book->id }}">
            <h2 class="text-lg font-semibold">{{ $book->title }}</h2>
            <p class="text-sm text-gray-500">by : {{ $book->author }}</p>
            </a>
        </div>
        <div class="flex flex-col items-center">
            <div class="font-bold text-xl text-gray-600">
                {{ str_repeat('★', floor($book->reviews_avg_rating ?? 0)) }}
                {{ str_repeat('☆', 5 - floor($book->reviews_avg_rating ?? 0)) }}
            </div>
            <div class="text-sm text-gray-600">
                out of {{ $book->reviews_count ?? 0 }} reviews
            </div>
        </div>
    </section>
@endforeach