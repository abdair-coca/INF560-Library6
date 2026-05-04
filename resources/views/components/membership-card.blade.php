@props(['member'])

<div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col h-full border border-gray-200 hover:shadow-lg transition">
    <div class="p-4 flex-grow">
        <p class="text-blue-600 text-xl font-bold hover:underline">{{$member->user->name}}</p>
        <x-membership-badge :member="$member"/>
    </div>
</div>