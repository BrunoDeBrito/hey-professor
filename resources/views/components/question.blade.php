@props(['item'])

<div
    class="
    rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3
    dark:gray-400 flex justify-between items-center">
    <span>
        {{ $item->question }}
    </span>

    <div>

        <x-form :action="route('question.like', $item)">
            <button class="flex items-start space-x-1 text-green-500 hover:text-green-300 cursor-pointer">
                <x-icons.thumbs-up class=" w-5 h-5" id="thumb-up" />
                <span>{{ $item->votes_sum_like ?: 0 }}</span>
            </button>
        </x-form>

        <x-form :action="route('question.unlike', $item)">
            <button class="flex items-start space-x-1 text-red-500 hover:text-red-300 cursor-pointer">
                <x-icons.thumbs-down class="w-5 h-5" id="thumb-down" />
                <span>{{ $item->votes_sum_unlike ?: 0 }}</span>
            </button>
        </x-form>

    </div>

</div>
