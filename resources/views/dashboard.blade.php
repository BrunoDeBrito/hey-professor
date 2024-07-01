<x-app-layout>

    <x-slot name="header">
        <x-header>{{ __('Vote for a question') }}</x-header>
    </x-slot>

    <x-container>

        <form class="flex items-center space-x2" action="{{ route('dashboard') }}" method="GET">

            @csrf

            <x-text-input type="text" name="search" value="{{ request()->search }}" class="w-full mr-1" />
            <x-btn.alternative>Search</x-btn.alternative>

        </form>

        @if ($questions->isEmpty())

            <div class="dark:text-gray-300 text-center flex justify-center mt-10">
                <x-draw.search width="300"></x-draw.sear>
            </div>

            <div
                class="dark:text-red-300 hover:dark:text-red-500
                text-center flex justify-center mt-4 font-bold text-2xl">
                Question Not Found
            </div>
        @else
            {{-- Listagem de Perguntas --}}
            <div class="dark:text-gray-400 space-y-4 mt-4">

                @foreach ($questions as $item)
                    <x-question :item="$item" />
                @endforeach

            </div>

        @endif

        <div class="mt-4">
            {{ $questions->withQueryString()->links() }}
        </div>


    </x-container>

</x-app-layout>
