<x-layout>
    <section>
        <h1 class="text-2xl font-semibold">{{ $book->title }}</h1>
        <p class="text-xl text-gray-500">by : {{ $book->author }}</p>
        <div>
            <div class="font-bold text-xl text-gray-600">
                {{ str_repeat('★', floor($averageRating)) }}
                {{ str_repeat('☆', 5 - floor($averageRating)) }}
            </div>
            <div class="text-sm text-gray-600">
                <p>out of {{ $totalReviews }} Reviews. </p>
            </div>
            <div>
                <a href="/books/{{ $book->id }}/create" class="underline text-gray-500">Add a review</a>
            </div>
        </div>
    </section>
    <section class="mt-4">
        <h1 class="text-2xl font-semibold">Reviews</h1>
        @foreach ($reviews as $review)
            <div class="mt-3 gap-x-6 border hover:border-gray-600 p-5 rounded-xl">
                <p class="text-gray-500">{{ $review->review }}</p>
                <div class="font-bold text-xl text-gray-600">
                    {{ str_repeat('★', floor($review->rating)) }}
                    {{ str_repeat('☆', 5 - floor($review->rating)) }}
                </div>
            </div>
        @endforeach
    </section>
</x-layout>
