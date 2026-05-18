@props(['id', 'title', 'message'])

<div id="{{ $id }}"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-brand-dark/60 backdrop-blur-sm p-4 flex">
    <div
        class="w-full max-w-md bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">

        {{-- Header --}}
        <div
            class="bg-brand-pink px-5 py-3 border-b-[2.5px] border-brand-dark flex items-center gap-2">
            <span class="text-2xl">⚠️</span>
            <h2 class="font-fredoka text-lg text-white">{{ $title }}</h2>
        </div>

        {{-- Body --}}
        <div class="p-5">
            <p class="text-sm font-semibold text-brand-dark leading-relaxed">{{ $message }}</p>

            <div class="mt-6 flex justify-end gap-3 flex-wrap">
                <button type="button"
                    onclick="closeModal('{{ $id }}')"
                    class="font-fredoka text-sm px-5 py-2 rounded-full border-[2.5px] border-brand-dark bg-white text-brand-dark shadow-neo-btn transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
                    Cancelar
                </button>

                {{ $slot }}
            </div>
        </div>
    </div>
</div>
