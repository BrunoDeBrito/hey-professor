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

                        @foreach($questions->where('draft', true) as $item)

                            <x-table.tr>

                                <x-table.td>{{ $item->question }}</x-table.td>

                                <x-table.td>

                                    <x-form :action="route('question.publish', $item)" put>
                                        <button type="submit" class="hover:underline text-blue-500">Publish</button>
                                    </x-form>

                                    <x-form :action="route('question.destroy', $item)" delete>
                                        <button type="submit" class="hover:underline text-red-500">Delete</button>
                                    </x-form>
                                    {{-- <x-btn.danger> Delete </x-btn.danger> --}}
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

                        @foreach($questions->where('draft', false) as $item)

                            <x-table.tr>

                                <x-table.td>{{ $item->question }}</x-table.td>

                                <x-table.td>
                                    <x-form :action="route('question.destroy', $item)" delete>
                                        <button type="submit" class="hover:underline text-red-500">Delete</button>
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
