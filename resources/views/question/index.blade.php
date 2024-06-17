<x-app-layout>

    <x-slot name="header">
        <x-header>{{ __('My Questions') }}</x-header>
    </x-slot>

    <x-container>

        <x-form post :action="route('question.store')">

            <x-textarea label='Question' name='question' rows='5' />

            <x-btn.primary> Save </x-btn.primary>

            <x-btn.reset> Cancel </x-btn.reset>

        </x-form>

        <hr class="border-gray-700 border-dashed my-4">

        {{-- Listagem de Drafts --}}
        <div class="dark:text-gray-300 uppercase font-bold mb-1">
            Drafts
        </div>

        <div class="dark:text-gray-400 space-y-4">

            <x-table>

                <x-table.thead>

                    <tr>
                        <x-table.th> Question </x-table.th>
                        <x-table.th> Actions </x-table.th>
                    </tr>

                    <tbody>

                        @foreach ($questions->where('draft', true) as $item)
                            <x-table.tr>

                                <x-table.td>{{ $item->question }}</x-table.td>

                                <x-table.td>

                                    <x-form :action="route('question.publish', $item)" put>
                                        <button type="submit" title="Publish" class="hover:underline text-green-500">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-green-500 hover:dark:text-green-300" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                    </x-form>

                                    <x-form :action="route('question.update', $item)" put>
                                        <a href="{{ route('question.edit', $item) }}" title="Edit" class="hover:underline text-blue-500 ">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-blue-500 hover:dark:text-blue-300 mb-2"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z"
                                                    clip-rule="evenodd" />
                                                <path fill-rule="evenodd"
                                                    d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </x-form>

                                    <x-form :action="route('question.destroy', $item)" delete>
                                        <button type="submit" title="Delete"
                                            class="text-center inline-flex items-center me-2 hover:underline text-red-500">
                                            <svg class="w-5 h-5 text-gray-200 dark:text-red-500 hover:dark:text-red-300"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </x-form>

                                </x-table.td>

                            </x-table.tr>
                        @endforeach


                    </tbody>

                </x-table.thead>

            </x-table>

        </div>
        {{-- fim --}}

        <hr class="border-gray-700 border-dashed my-4">

        {{-- Listagem de Perguntas --}}
        <div class="dark:text-gray-300 uppercase font-bold mb-1">
            My Qestions
        </div>

        <div class="dark:text-gray-400 space-y-4">

            <x-table>

                <x-table.thead>

                    <tr>
                        <x-table.th> Question </x-table.th>
                        <x-table.th> Actions </x-table.th>
                    </tr>

                    <tbody>

                        @foreach ($questions->where('draft', false) as $item)
                            <x-table.tr>

                                <x-table.td>{{ $item->question }}</x-table.td>

                                <x-table.td>
                                    <x-form :action="route('question.destroy', $item)" delete>
                                        <button type="submit" title="Delete"
                                            class="text-center inline-flex items-center me-2 hover:underline text-red-500">
                                            <svg class="w-5 h-5 text-gray-200 dark:text-red-500 hover:dark:text-red-300"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </x-form>
                                </x-table.td>

                            </x-table.tr>
                        @endforeach


                    </tbody>

                </x-table.thead>

            </x-table>

        </div>
        {{-- fim --}}

    </x-container>

</x-app-layout>
