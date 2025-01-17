<x-layout>
    <section>
        <h1 class="text-2xl font-semibold">Add a review for {{ $book->title }}</h1>
        <form method="POST" action="/books/{{$book->id}}" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="review" class="block text-sm font-medium text-gray-700">Review</label>
                <textarea name="review" 
                          id="review" 
                          class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>
            <div class="mb-4">
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <select name="rating" 
                        id="rating" 
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="mb-4">
                <x-button type="submit">Submit</x-button>
            </div>
        </form>
    </section>
</x-layout>