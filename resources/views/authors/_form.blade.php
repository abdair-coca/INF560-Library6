{{-- resources/views/authors/_form.blade.php --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">
        Nombre <span class="text-red-500">*</span>
    </label>
    <input type="text" name="first_name"
        value="{{ old('first_name', $author->first_name ?? '') }}"
        class="w-full border @error('first_name') border-red-400 @else border-slate-300
@enderror
 rounded px-3 py-2">
    @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">
        Apellido <span class="text-red-500">*</span>
    </label>
    <input type="text" name="last_name"
        value="{{ old('last_name', $author->last_name ?? '') }}"
        class="w-full border @error('last_name') border-red-400 @else border-slate-300
@enderror 
rounded px-3 py-2">
    @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Nacionalidad</label>
        <input type="text" name="nationality"
            value="{{ old('nationality', $author->nationality ?? '') }}"
            class="w-full border border-slate-300 rounded px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Fecha de
            nacimiento</label>
        <input type="date" name="birth_date"
            value="{{ old('birth_date', $author?->birth_date?->format('Y-m-d') ?? '') }}"
            class="w-full border border-slate-300 rounded px-3 py-2">
        @error('birth_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Biografía</label>
    <textarea name="biography" rows="5"
        class="w-full border border-slate-300 rounded px-3 py-2">{{ old('biography', $author->biography ?? '') }}</textarea>
</div>