# design.md — LibraryApp Design System
> Estilo: **Divertido & Colorido** | Framework: **Tailwind CSS** | Fuentes: Google Fonts

---

## Fuentes

```html
<!-- En <head> de app.blade.php -->
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
```

| Rol | Familia | Tailwind class |
|-----|---------|----------------|
| Títulos / logos / números grandes | `Fredoka One` | `font-fredoka` |
| Cuerpo / labels / botones | `Nunito` | `font-nunito` |

```js
// tailwind.config.js
theme: {
  extend: {
    fontFamily: {
      fredoka: ['"Fredoka One"', 'cursive'],
      nunito: ['Nunito', 'sans-serif'],
    },
  },
},
```

---

## Paleta de colores

```js
// tailwind.config.js
theme: {
  extend: {
    colors: {
      brand: {
        yellow:  '#FFD93D',
        orange:  '#FF6B35',
        pink:    '#FF6B9D',
        blue:    '#4ECDC4',
        purple:  '#A855F7',
        green:   '#6BCB77',
        bg:      '#FFF8F0',
        dark:    '#2D2D2D',
      },
    },
  },
},
```

| Token | Hex | Uso principal |
|-------|-----|---------------|
| `brand-yellow` | `#FFD93D` | Navbar, stat-card |
| `brand-orange` | `#FF6B35` | Acción primaria, headers de sección |
| `brand-pink` | `#FF6B9D` | Stat-card, portadas, badges |
| `brand-blue` | `#4ECDC4` | Welcome banner, portadas |
| `brand-purple` | `#A855F7` | Headers secundarios, autor chip |
| `brand-green` | `#6BCB77` | Stat-card, badge "Disponible" |
| `brand-bg` | `#FFF8F0` | Fondo global del body |
| `brand-dark` | `#2D2D2D` | Bordes, texto, sombras |

---

## Sombra neo-brutalist

```js
// tailwind.config.js
theme: {
  extend: {
    boxShadow: {
      neo:    '4px 4px 0px #2D2D2D',
      'neo-hover': '7px 7px 0px #2D2D2D',
      'neo-sm': '2px 2px 0px #2D2D2D',
      'neo-btn': '3px 3px 0px #2D2D2D',
    },
  },
},
```

Clases de uso rápido:
- Cards normales → `shadow-neo`
- Cards en hover → `hover:shadow-neo-hover hover:-translate-x-1 hover:-translate-y-1`
- Botones → `shadow-neo-btn`
- Chips/badges → `shadow-neo-sm`

Todos los elementos con sombra también llevan `border-2 border-brand-dark` o `border-[2.5px] border-brand-dark`.

---

## Border radius

| Elemento | Clase Tailwind |
|----------|----------------|
| Cards grandes | `rounded-[20px]` |
| Botones | `rounded-full` |
| Chips / badges | `rounded-full` |
| Portada de libro mini | `rounded-md` |
| Portada de libro grande | `rounded-2xl` |
| Avatar | `rounded-full` |

---

## Componentes

### Navbar

```html
<nav class="bg-brand-yellow border-b-[3px] border-brand-dark h-16 px-8 flex items-center justify-between sticky top-0 z-50">

  <!-- Logo -->
  <div class="font-fredoka text-2xl text-brand-dark flex items-center gap-2">
    📚 LibraryApp
  </div>

  <!-- Links -->
  <div class="flex gap-1.5">
    <a href="#" class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-white shadow-neo-btn text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
      🏠 Inicio
    </a>
    <!-- Link activo -->
    <a href="#" class="font-nunito font-extrabold text-sm px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark bg-brand-orange shadow-neo-btn text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
      📖 Libros
    </a>
  </div>

  <!-- Avatar -->
  <div class="w-10 h-10 rounded-full border-[2.5px] border-brand-dark bg-brand-pink flex items-center justify-center text-lg shadow-neo-btn cursor-pointer">
    😊
  </div>

</nav>
```

---

### Welcome Banner

```html
<div class="bg-brand-blue border-[3px] border-brand-dark rounded-[20px] p-7 my-6 flex items-center justify-between shadow-neo relative overflow-hidden">
  <div class="absolute -right-5 -bottom-5 w-28 h-28 bg-white/15 rounded-full"></div>
  <div>
    <h1 class="font-fredoka text-3xl text-white [text-shadow:2px_2px_0_rgba(0,0,0,0.15)]">¡Hola, Usuario! 👋</h1>
    <p class="text-white/90 font-bold text-sm mt-1">Tienes 3 préstamos activos hoy. ¡A leer se ha dicho!</p>
  </div>
  <span class="text-7xl">🦉</span>
</div>
```

---

### Stat Cards (grid)

```html
<div class="grid grid-cols-4 gap-4 mb-7">

  <!-- card-1: pink -->
  <div class="bg-brand-pink border-[3px] border-brand-dark rounded-[20px] p-5 shadow-neo flex flex-col gap-1.5 transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover">
    <span class="text-3xl">📚</span>
    <span class="font-fredoka text-4xl leading-none">128</span>
    <span class="font-extrabold text-xs opacity-80">Libros registrados</span>
  </div>

  <!-- card-2: green -->
  <div class="bg-brand-green border-[3px] border-brand-dark rounded-[20px] p-5 shadow-neo flex flex-col gap-1.5 transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover">
    <span class="text-3xl">✅</span>
    <span class="font-fredoka text-4xl leading-none">94</span>
    <span class="font-extrabold text-xs opacity-80">Disponibles</span>
  </div>

  <!-- card-3: purple (texto blanco) -->
  <div class="bg-brand-purple border-[3px] border-brand-dark rounded-[20px] p-5 shadow-neo flex flex-col gap-1.5 text-white transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover">
    <span class="text-3xl">📤</span>
    <span class="font-fredoka text-4xl leading-none">34</span>
    <span class="font-extrabold text-xs opacity-80">Prestados</span>
  </div>

  <!-- card-4: yellow -->
  <div class="bg-brand-yellow border-[3px] border-brand-dark rounded-[20px] p-5 shadow-neo flex flex-col gap-1.5 transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover">
    <span class="text-3xl">🏷️</span>
    <span class="font-fredoka text-4xl leading-none">8</span>
    <span class="font-extrabold text-xs opacity-80">Categorías</span>
  </div>

</div>
```

---

### Section Card (contenedor con header coloreado)

```html
<div class="bg-white border-[3px] border-brand-dark rounded-[20px] shadow-neo overflow-hidden">

  <!-- header orange -->
  <div class="bg-brand-orange px-5 py-4 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
    📖 Últimos libros agregados
  </div>

  <!-- header purple -->
  <div class="bg-brand-purple px-5 py-4 border-b-[2.5px] border-brand-dark font-fredoka text-lg text-white flex items-center gap-2">
    🏷️ Categorías populares
  </div>

  <!-- contenido -->
  <div>...</div>
</div>
```

---

### Fila de libro reciente

```html
<div class="flex items-center gap-3 px-5 py-3 border-b border-dashed border-gray-200 font-bold text-sm hover:bg-orange-50 transition-colors cursor-pointer">

  <!-- portada mini -->
  <div class="w-9 h-12 rounded-md border-2 border-brand-dark bg-brand-pink flex items-center justify-center text-lg shrink-0">
    📗
  </div>

  <div class="flex-1">
    <div class="text-brand-dark">El Principito</div>
    <div class="text-xs font-semibold text-gray-400">Antoine de Saint-Exupéry</div>
  </div>

  <!-- badge disponible -->
  <span class="text-xs font-extrabold px-3 py-0.5 rounded-full border-2 border-brand-dark bg-brand-green">✓ Libre</span>
  <!-- badge prestado -->
  <span class="text-xs font-extrabold px-3 py-0.5 rounded-full border-2 border-brand-dark bg-brand-orange text-white">📤 Prestado</span>

</div>
```

---

### Category Pill (sidebar/lista)

```html
<div class="flex items-center gap-2.5 px-5 py-2.5 border-b border-dashed border-gray-200 font-bold text-sm">
  <div class="w-3.5 h-3.5 rounded-full border-2 border-brand-dark bg-brand-pink shrink-0"></div>
  Novela
  <span class="ml-auto font-fredoka text-base text-brand-orange">42</span>
</div>
```

---

### Category Card (grid de categorías)

```html
<div class="bg-brand-yellow border-[3px] border-brand-dark rounded-[20px] shadow-neo p-7 cursor-pointer transition-all hover:-translate-x-1 hover:-translate-y-1 hover:shadow-neo-hover flex flex-col gap-2.5 relative overflow-hidden">

  <!-- emoji de fondo decorativo -->
  <span class="absolute right-3 bottom-2 text-6xl opacity-20 leading-none pointer-events-none">📖</span>

  <span class="text-4xl">📖</span>
  <span class="font-fredoka text-xl">Novela</span>
  <span class="font-extrabold text-xs opacity-75">42 libros</span>

  <!-- barra de progreso -->
  <div class="w-full h-2 bg-black/10 rounded-full overflow-hidden mt-1">
    <div class="h-full bg-black/30 rounded-full" style="width: 80%"></div>
  </div>

</div>
```

Colores de fondo por categoría (rotar con `nth-child` o asignar clase dinámica en Blade):

```
1 → bg-brand-yellow
2 → bg-brand-pink
3 → bg-brand-blue
4 → bg-brand-purple  text-white
5 → bg-brand-orange  text-white
6 → bg-brand-green
```

---

### Detalle de libro

```html
<div class="grid grid-cols-[260px_1fr] gap-7 mt-6">

  <!-- Portada grande -->
  <div class="aspect-[2/3] rounded-2xl border-[3px] border-brand-dark shadow-neo bg-brand-pink flex items-center justify-center text-8xl relative overflow-hidden">
    📗
    <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent pointer-events-none"></div>
  </div>

  <!-- Info -->
  <div class="flex flex-col gap-4">

    <div>
      <h1 class="font-fredoka text-4xl leading-tight text-brand-dark">El Principito</h1>
      <p class="font-extrabold text-brand-orange flex items-center gap-1.5 mt-1">✏️ Antoine de Saint-Exupéry</p>
    </div>

    <!-- Chips de metadata -->
    <div class="flex flex-wrap gap-3">
      <span class="bg-brand-blue px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm">ISBN: 978-2-07-040850-4</span>
      <span class="bg-brand-yellow px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm">📅 1943</span>
      <span class="bg-brand-green px-4 py-1.5 rounded-full border-[2.5px] border-brand-dark font-extrabold text-sm shadow-neo-sm">📄 96 páginas</span>
      <span class="bg-brand-green text-xs font-extrabold px-4 py-1.5 rounded-full border-2 border-brand-dark">✓ Disponible</span>
    </div>

    <!-- Descripción -->
    <div class="bg-white border-[2.5px] border-brand-dark rounded-2xl p-5 shadow-neo-sm">
      <p class="font-fredoka text-base text-brand-purple mb-2">📝 Descripción</p>
      <p class="text-sm font-semibold leading-relaxed text-gray-500">
        Un joven príncipe viaja de planeta en planeta explorando la extraña lógica de los adultos...
      </p>
    </div>

    <!-- Autor chip -->
    <div class="bg-brand-purple text-white border-[2.5px] border-brand-dark rounded-2xl p-4 shadow-neo-sm flex items-center gap-3.5">
      <div class="w-14 h-14 rounded-full border-[2.5px] border-white bg-brand-yellow flex items-center justify-center text-2xl shrink-0">✏️</div>
      <div>
        <p class="font-fredoka text-lg">Antoine de Saint-Exupéry</p>
        <p class="text-xs font-bold opacity-80">🇫🇷 Francia · 1900 – 1944</p>
      </div>
    </div>

    <!-- Acciones -->
    <div class="flex gap-3">
      <button class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-orange text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
        📤 Registrar préstamo
      </button>
      <button class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-white text-brand-dark transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
        ✏️ Editar
      </button>
      <button class="font-fredoka text-base px-7 py-3 rounded-full border-[2.5px] border-brand-dark shadow-neo-btn bg-brand-pink text-white transition-all hover:-translate-x-0.5 hover:-translate-y-0.5 hover:shadow-neo">
        🗑️ Eliminar
      </button>
    </div>

  </div>
</div>
```

---

## tailwind.config.js completo

```js
import defaultTheme from 'tailwindcss/defaultTheme'

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  theme: {
    extend: {
      fontFamily: {
        fredoka: ['"Fredoka One"', 'cursive'],
        nunito:  ['Nunito', 'sans-serif'],
      },
      colors: {
        brand: {
          yellow: '#FFD93D',
          orange: '#FF6B35',
          pink:   '#FF6B9D',
          blue:   '#4ECDC4',
          purple: '#A855F7',
          green:  '#6BCB77',
          bg:     '#FFF8F0',
          dark:   '#2D2D2D',
        },
      },
      boxShadow: {
        neo:         '4px 4px 0px #2D2D2D',
        'neo-hover': '7px 7px 0px #2D2D2D',
        'neo-sm':    '2px 2px 0px #2D2D2D',
        'neo-btn':   '3px 3px 0px #2D2D2D',
      },
    },
  },
  plugins: [],
}
```

---

## Body base (app.blade.php)

```html
<body class="bg-brand-bg font-nunito text-brand-dark min-h-screen">
```