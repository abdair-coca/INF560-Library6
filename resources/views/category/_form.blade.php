<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">
        🏷️ Título <span class="text-brand-pink">*</span>
    </label>
    <input type="text" name="name"
        value="{{ old('name', $category->name ?? '') }}"
        class="w-full border-[2.5px] @error('name') border-brand-pink bg-pink-50 @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
    @error('name')
    <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
    @enderror
</div>
{{-- Campo: Descripción --}}
<div>
    <label for="description" class="block font-fredoka text-sm text-brand-purple mb-1.5">📝 Descripción</label>
    <textarea name="description" id="description" rows="4"
        class="w-full border-[2.5px] border-brand-dark rounded-2xl px-4 py-3 font-nunito font-semibold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all resize-none">{{ old('description', $category->description ?? '') }}</textarea>
</div>
{{-- Campo color --}}
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🎨 Color</label>
    <div class="flex items-center gap-3">
        <input type="text" name="color"
            value="{{ old('color', $category->color ?? '#3B82F6') }}"
            class="flex-1 h-11 border-[2.5px] rounded-full px-4 py-1 font-mono font-bold text-sm shadow-neo-sm
            @error('color') border-brand-pink bg-pink-50 @else border-brand-dark @enderror
                      focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all"
            maxLength="7">
        <div class="w-11 h-11 rounded-full border-[2.5px] border-brand-dark shadow-neo-sm shrink-0"
            style="background-color: {{ old('color', $category->color ?? '#3B82F6') }}"></div>
    </div>
    @error('color')
    <p class="mt-1.5 text-xs font-extrabold text-brand-pink flex items-center gap-1">⚠️ {{ $message }}</p>
    @enderror
</div>
