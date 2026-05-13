<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">
        Título <span class="text-red-500">*</span>
    </label>
    <input type="text" name="name"
        value="{{ old('name', $category->name ?? '') }}"
        class="w-full border @error('name') border-red-400 @else border-slate-300
@enderror
 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
    @error('name')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
{{-- Campo: Descripción --}}
<div>
    <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Descripción</label>
    <textarea name="description" id="description" rows="4"
        class="w-full border border-slate-300 rounded px-3 py-2">
    {{ old('description', $category->description ?? '') }}
    </textarea>
</div>
{{-- Campo color --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Color</label>
    <input type="text" name="color"
        value="{{ old('color', $category->color ?? '#3B82F6') }}"
        class="w-full h-10 border border-slate-300 rounded px-1 py-1
        @error('color') border-red-400 bg-red-50 @else border-slate-300 @enderror
                  focus:outline-none focus:ring-2 focus:ring-amber-500"
        maxLength="7">
    @error('color')
    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>