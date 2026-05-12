@props(['id', 'title', 'message'])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="w-full max-w-md rounded-lg bg-white p-6 shadow-lg">
        <h2 class="text-lg font-semibold text-slate-900">{{ $title }}</h2>
        <p class="mt-2 text-sm text-slate-600">{{ $message }}</p>

        <div class="mt-6 flex justify-end gap-3">
            <button type="button"
                onclick="closeModal('{{ $id }}')"
                class="rounded border border-slate-300 px-4 py-2 text-slate-700 hover:bg-slate-100">
                Cancelar
            </button>

            {{ $slot }}
        </div>
    </div>
</div>