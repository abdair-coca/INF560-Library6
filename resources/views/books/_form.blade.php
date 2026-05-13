{{-- resources/views/books/_form.blade.php --}}
{{-- Variables esperadas: $categories, $authors, $book (puede ser null en create) --}}
{{-- Campo: Título --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">
        Título <span class="text-red-500">*</span>
    </label>

    <input type="text"
        name="title"
        value="{{ old('title', $book->title ?? '') }}"
        placeholder="Ej. Cien años de soledad"
        maxlength="255"
        class="w-full rounded px-3 py-2 border
                  @error('title') border-red-400 bg-red-50 @else border-slate-300 @enderror
                  focus:outline-none focus:ring-2
                  @error('title') focus:ring-red-400 @else focus:ring-amber-500 @enderror">

    @error('title')
    <p class="mt-1 text-xs text-red-600 flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        {{ $message }}
    </p>
    @enderror
</div>

{{-- Campos: ISBN y Año --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">ISBN-13</label>

        <input type="text"
            name="isbn"
            value="{{ old('isbn', $book->isbn ?? '') }}"
            placeholder="Ej. 9780306406157"
            maxlength="13"
            class="w-full rounded px-3 py-2 font-mono border
                  @error('isbn') border-red-400 bg-red-50 @else border-slate-300 @enderror
                  focus:outline-none focus:ring-2 focus:ring-amber-500">

        <p class="text-xs text-slate-500 mt-1">
            13 dígitos sin guiones. Déjalo vacío si el libro no tiene ISBN.
        </p>

        @error('isbn')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Año de
            publicación</label>
        <input type="number" name="publish_year"
            value="{{ old('publish_year', $book->publish_year ?? '') }}"
            class="w-full border border-slate-300 rounded px-3 py-2">
    </div>
</div>
{{-- Campos: Editorial, Páginas, Idioma --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Editorial</label>
        <input type="text" name="publisher"
            value="{{ old('publisher', $book->publisher ?? '') }}"
            class="w-full border border-slate-300 rounded px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Páginas</label>
        <input type="number" name="pages"
            value="{{ old('pages', $book->pages ?? '') }}"
            class="w-full border border-slate-300 rounded px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Idioma</label>
        <input type="text" name="language"
            value="{{ old('language', $book->language ?? 'Español') }}"
            class="w-full border border-slate-300 rounded px-3 py-2">
    </div>
</div>
{{-- Campo: Categoría --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">
        Categoría <span class="text-red-500">*</span>
    </label>
    <select name="category_id"
        class="w-full border @error('category_id') border-red-400 @else border-slate-300
@enderror
 rounded px-3 py-2">
        <option value="">Selecciona una categoría...</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}"
            {{ old('category_id', $book->category_id ?? '') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
        </option>
        @endforeach
    </select>
    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
{{-- Campo: Autores (multiple) --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">
        Autores <span class="text-red-500">*</span>
    </label>
    @php
    $selectedIds = old('authors', $selectedAuthors ?? []);
    @endphp
    @foreach($authors as $author)
    <label class="flex items-center gap-2">
        <input
            type="checkbox"
            name="authors[]"
            value="{{ $author->id }}"
            {{ is_array($selectedIds) && in_array($author->id, $selectedIds) ? 'checked' : '' }}>
        <span>{{ $author->full_name }}</span>
    </label>
    @endforeach
    @error('authors') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>
{{-- Campo: Total de copias --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">
        Total de copias <span class="text-red-500">*</span>
    </label>
    <input type="number" name="total_copies" min="1"
        value="{{ old('total_copies', $book->total_copies ?? 1) }}"
        class="w-full border border-slate-300 rounded px-3 py-2 md:w-32">
    @error('total_copies') <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
{{-- Campo: URL de portada --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">URL de portada</label>
    <input type="url" name="cover_url"
        value="{{ old('cover_url', $book->cover_url ?? '') }}"
        placeholder="https://..."
        class="w-full border border-slate-300 rounded px-3 py-2">
    @error('cover_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
{{-- Campo: Descripción --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Descripción</label>
    <textarea name="description" rows="4"
        class="w-full border border-slate-300 rounded px-3 py-2">
    {{ old('description', $book->description ?? '') }}
    </textarea>
</div>