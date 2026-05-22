{{-- resources/views/books/_form.blade.php --}}
{{-- Variables esperadas: $categories, $authors, $book (puede ser null en create) --}}
{{-- Campo: Título --}}
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">
        📖 Título <span class="text-brand-pink">*</span>
    </label>

    <input type="text"
        name="title"
        value="{{ old('title', $book->title ?? '') }}"
        placeholder="Ej. Cien años de soledad"
        maxlength="255"
        class="w-full rounded-full px-4 py-2 border-[2.5px] font-nunito font-bold text-sm shadow-neo-sm
                  @error('title') border-brand-pink bg-pink-50 @else border-brand-dark @enderror
                  focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">

    @error('title')
    <p class="mt-1.5 text-xs font-extrabold text-brand-pink flex items-center gap-1">
        ⚠️ {{ $message }}
    </p>
    @enderror
</div>

{{-- Campos: ISBN y Año --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🔢 ISBN-13</label>

        <input type="text"
            name="isbn"
            value="{{ old('isbn', $book->isbn ?? '') }}"
            placeholder="Ej. 9780306406157"
            maxlength="13"
            class="w-full rounded-full px-4 py-2 font-mono font-bold text-sm border-[2.5px] shadow-neo-sm
                  @error('isbn') border-brand-pink bg-pink-50 @else border-brand-dark @enderror
                  focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">

        <p class="text-xs font-bold text-gray-500 mt-1.5 ml-2">
            ✨ 13 dígitos sin guiones. Déjalo vacío si el libro no tiene ISBN.
        </p>

        @error('isbn')
        <p class="mt-1.5 text-xs font-extrabold text-brand-pink flex items-center gap-1">⚠️ {{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-fredoka text-sm text-brand-purple mb-1.5">📅 Año de publicación</label>
        <input type="number" name="publish_year"
            value="{{ old('publish_year', $book->publish_year ?? '') }}"
            class="w-full rounded-full px-4 py-2 font-nunito font-bold text-sm border-[2.5px] shadow-neo-sm
             @error('publish_year') border-brand-pink bg-pink-50 @else border-brand-dark @enderror
                  focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
        @error('publish_year')
        <p class="mt-1.5 text-xs font-extrabold text-brand-pink flex items-center gap-1">⚠️ {{ $message }}</p>
        @enderror
    </div>
</div>
{{-- Campos: Editorial, Páginas, Idioma --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🏢 Editorial</label>
        <input type="text" name="publisher"
            value="{{ old('publisher', $book->publisher ?? '') }}"
            class="w-full border-[2.5px] border-brand-dark rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
    </div>
    <div>
        <label class="block font-fredoka text-sm text-brand-purple mb-1.5">📄 Páginas</label>
        <input type="number" name="pages"
            value="{{ old('pages', $book->pages ?? '') }}"
            class="w-full border-[2.5px] border-brand-dark rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
    </div>
    <div>
        <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🌐 Idioma</label>
        <select name="language"
            class="w-full border-[2.5px] @error('language') border-brand-pink bg-pink-50 @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
            <option value="">Selecciona un idioma...</option>
            @php
            $languages = ['Español', 'Inglés', 'Francés', 'Alemán', 'Italiano', 'Portugués', 'Ruso', 'Chino', 'Japonés', 'Árabe'];
            @endphp
            @foreach($languages as $lang)
            <option value="{{ $lang }}"
                {{ old('language', $book->language ?? '') == $lang ? 'selected' : '' }}>
                {{ $lang }}
            </option>
            @endforeach
        </select>
    </div>
</div>
{{-- Campo: Categoría --}}
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">
        🏷️ Categoría <span class="text-brand-pink">*</span>
    </label>
    <select name="category_id"
        class="w-full border-[2.5px] @error('category_id') border-brand-pink bg-pink-50 @else border-brand-dark @enderror rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
        <option value="">Selecciona una categoría...</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}"
            {{ old('category_id', $book->category_id ?? '') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
        </option>
        @endforeach
    </select>
    @error('category_id') <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
    @enderror
</div>
{{-- Campo: Autores (multiple) --}}
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">
        ✏️ Autores <span class="text-brand-pink">*</span>
    </label>
    @php
    $selectedIds = old('authors', $selectedAuthors ?? []);
    @endphp
    <div class="bg-brand-bg border-[2.5px] border-brand-dark rounded-2xl p-4 shadow-neo-sm grid grid-cols-1 sm:grid-cols-2 gap-2">
        @foreach($authors as $author)
        <label class="flex items-center gap-2 px-3 py-1.5 rounded-full border-2 border-brand-dark bg-white shadow-neo-sm font-extrabold text-sm cursor-pointer hover:bg-brand-yellow transition-colors">
            <input
                type="checkbox"
                name="authors[]"
                value="{{ $author->id }}"
                class="w-4 h-4 accent-brand-orange"
                {{ is_array($selectedIds) && in_array($author->id, $selectedIds) ? 'checked' : '' }}>
            <span>{{ $author->full_name }}</span>
        </label>
        @endforeach
    </div>
    @error('authors') <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p> @enderror
</div>
{{-- Campo: Total de copias --}}
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">
        📦 Total de copias <span class="text-brand-pink">*</span>
    </label>
    <input type="number" name="total_copies" min="1"
        value="{{ old('total_copies', $book->total_copies ?? 1) }}"
        class="w-full border-[2.5px] border-brand-dark rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all md:w-40">
    @error('total_copies') <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
    @enderror
</div>
{{-- Campo: URL de portada --}}
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">🖼️ URL de portada</label>
    <input type="url" name="cover_url"
        value="{{ old('cover_url', $book->cover_url ?? '') }}"
        placeholder="https://..."
        class="w-full border-[2.5px] rounded-full px-4 py-2 font-nunito font-bold text-sm shadow-neo-sm
        @error('cover_url') border-brand-pink bg-pink-50 @else border-brand-dark @enderror
                  focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all">
    @error('cover_url') <p class="text-brand-pink font-extrabold text-xs mt-1.5 flex items-center gap-1">⚠️ {{ $message }}</p>
    @enderror
</div>
{{-- Campo: Descripción --}}
<div>
    <label class="block font-fredoka text-sm text-brand-purple mb-1.5">📝 Descripción</label>
    <textarea name="description" rows="4"
        class="w-full border-[2.5px] border-brand-dark rounded-2xl px-4 py-3 font-nunito font-semibold text-sm shadow-neo-sm focus:outline-none focus:-translate-x-0.5 focus:-translate-y-0.5 focus:shadow-neo transition-all resize-none">{{ old('description', $book->description ?? '') }}</textarea>
</div>