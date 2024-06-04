<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100  flex flex-col">

                    <h2 class="text-3xl font-bold  mb-4">Tus reviews...</h2>
                    <div class="flex flex-col">
                        @if (count($reviews) > 0)
                        @foreach ($reviews as $review)
                        <!-- Mostrar los datos de la reseña -->
                        <a href="{{ route('track.show', $review->track->json['id']) }}" class="">
                            <div class="p-2 m-3 dark:bg-slate-700 rounded-lg flex items-center">
                                <img src="{{ $review->track->json['album']['images'][2]['url'] }}">
                                <div class="flex self-start ml-4">
                                    <span class="text-xs ">
                                        <span>
                                            <span class="font-extrabold">{{ $review->track->name }}</span>
                                            <ul>
                                                @foreach ($review->track->json['artists'] as $artist)
                                                    <li class="italic">{{ $artist['name'] }}</li>
                                                @endforeach
                                            </ul>
                                        </span>
                                    </span>
                                    <div class="rating rating-sm rating-half">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <input type="radio" name="rating-{{ $review->id }}"
                                                class="bg-green-500 mask mask-star-2 {{ $i % 2 == 0 ? 'mask-half-2' : 'mask-half-1' }}"
                                                {{ $i <= $review->calification * 2 ? 'checked' : '' }} disabled />
                                        @endfor
                                    </div>
                                </div>
                                <div class="ml-auto flex items-center">

                                </div>
                                <form action="{{ route('review.delete', $review) }}" method="POST" class="p-6">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-circle btn-outline btn-md mr-4" onclick="confirmAction(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </a>
                    @endforeach
                    @else
                    <h2 class="text-xl font-bold  mb-4">¡No se han econtrado!</h2>
                        @endif
                    </div>
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmAction(button) {
            var confirmation = confirm("¿Estás seguro de que deseas eliminar la reseña?");

            if (confirmation) {
                var form = button.closest("form");
                form.submit();
            } else {

            }
        }
    </script>
</x-app-layout>
