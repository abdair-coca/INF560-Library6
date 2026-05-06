{{-- resources/views/books/_form.blade.php --}}
{{-- Variables esperadas: $categories, $authors, $book (puede ser null en create) --}}
{{-- Campo: Título --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">
        Título <span class="text-red-500">*</span>
    </label>
    <input type="text" name="title"
        value="{{ old('title', $book->title ?? '') }}"
        class="w-full border @error('title') border-red-400 @else border-slate-300
@enderror
 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
    @error('title')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
{{-- Campos: ISBN y Año --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">ISBN</label>
        <input type="text" name="isbn"
            value="{{ old('isbn', $book->isbn ?? '') }}"
            class="w-full border border-slate-300 rounded px-3 py-2">
        @error('isbn') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Año de
            publicación</label>
        <input type="number" name="publication_year"
            value="{{ old('publication_year', $book->publication_year ?? '') }}"
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
            {{ old('category_id', $book->category_id ?? '') == $cat->id ? 'selected'
: '' }}>
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
    <select name="authors[]" multiple
        class="w-full border @error('authors') border-red-400 @else border-slate-300
@enderror
 rounded px-3 py-2 h-36">
        @foreach($authors as $author)
        @php
        $selectedIds = old('authors', $selectedAuthors ?? []);
        @endphp
        <option value="{{ $author->id }}"
            {{ in_array($author->id, $selectedIds) ? 'selected' : '' }}>
            {{ $author->full_name }}
        </option>
        @endforeach
    </select>
    <p class="text-xs text-slate-500 mt-1">Mantén Ctrl (o Cmd en Mac) para seleccionar
        varios.</p>
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