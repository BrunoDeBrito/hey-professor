<x-app-layout>

    <x-slot name="header">
        <x-header>{{ __('Vote for a question') }}</x-header>
    </x-slot>

    <x-container>

        {{-- Listagem de Perguntas --}}
        <div class="dark:text-gray-400 space-y-4">

            @foreach ($questions as $item)
                <x-question :item="$item" />
            @endforeach

        </div>

        {{ $questions->links() }}

    </x-container>

</x-app-layout>
