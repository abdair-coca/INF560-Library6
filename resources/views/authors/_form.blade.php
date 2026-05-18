{{-- resources/views/authors/_form.blade.php --}}
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">
        😊 Nombre <span class="text-brand-pink">*</span>
    </label>
    <input type="text" name="first_name"
        value="{{ old('first_name', $author->first_name ?? '') }}"
        class="w-full border-[2.5px] @error('first_name') border-brand-pink @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
    @error('first_name') <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
    @enderror
</div>
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">
        📛 Apellido <span class="text-brand-pink">*</span>
    </label>
    <input type="text" name="last_name"
        value="{{ old('last_name', $author->last_name ?? '') }}"
        class="w-full border-[2.5px] @error('last_name') border-brand-pink @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
    @error('last_name') <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
    @enderror
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🌎 Nacionalidad</label>
        <input type="text" name="nationality"
            value="{{ old('nationality', $author->nationality ?? '') }}"
            class="w-full border-[2.5px] border-brand-dark rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
    </div>
    <div>
        <label class="block font-fredoka text-sm text-brand-purple mb-1.5">📅 Fecha de nacimiento</label>
        <input type="date" name="birth_date"
            value="{{ old('birth_date', $author?->birth_date?->format('Y-m-d') ?? '') }}"
            class="w-full border-[2.5px] border-brand-dark rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
        @error('birth_date') <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
        @enderror
    </div>
</div>
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">📝 Biografía</label>
    <textarea name="biography" rows="5"
        class="w-full border-[2.5px] border-brand-dark rounded-2xl px-4 py-3 font-nunito font-semibold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all resize-none">{{ old('biography', $author->biography ?? '') }}</textarea>
</div>
