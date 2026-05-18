@props(['member'])

<article class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden flex flex-col h-full transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover">

    <div class="bg-brand-blue px-4 py-3 border-b-[2.5px] border-brand-dark flex items-center justify-center relative overflow-hidden">
        <div class="absolute -right-2 -bottom-2 w-14 h-14 bg-white/15 rounded-full"></div>
        <div class="w-14 h-14 rounded-full border-[2.5px] border-brand-dark bg-brand-pink flex items-center justify-center text-2xl shadow-neo-sm relative z-10">
            😊
        </div>
    </div>

    <div class="p-4 flex-grow flex flex-col gap-2">
        <p class="font-fredoka text-lg text-brand-dark hover:text-brand-orange transition-colors leading-tight">
            {{$member->user->name}}
        </p>
        <div>
            <x-membership-badge :member="$member"/>
        </div>
    </div>
</article>
