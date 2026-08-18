# STEP Tailwind Design System Foundation

Sub-project 1 of the Bootstrap → Tailwind conversion. Establishes the shared
build pipeline and design tokens that every later conversion phase (public
pages, auth flows, member dashboard, admin CMS) builds on. This phase does
not touch any currently-live page.

## Context

- `step` (this app) is a mostly-static Bootstrap + jQuery marketing/CMS site.
  Its live pages load legacy CSS directly (`asset('frontend/css/style.css')`,
  `default.css`, `custom.css`, `responsive.css`) and are unrelated to the
  build pipeline — no page currently references `mix(...)` at all.
- `exam` (merged in under `Route::domain('exams.step.technology')`, see
  `routes/exam.php`) already runs on Tailwind + Vite, added when the two
  Laravel apps were merged into one codebase.
- Laravel Mix (`webpack.mix.js`, `resources/css/app.css`, `resources/js/app.js`)
  is configured but **dead**: `resources/css/app.css` is empty,
  `resources/js/app.js` only imports `./bootstrap`, and neither is referenced
  by any Blade view. `public/css/` and `public/js/` (Mix's output
  directories) don't exist — Mix has never actually been built in this repo.
  It is safe to retire outright rather than work around.
- Bottom line from the user: step and exam should end up sharing the same
  `app.css` / `app.js` Vite entry, with Vite as the only build tool — no
  separate `exam-app.*` bundle, no Mix.

## Goals

1. One shared Vite entry (`resources/css/app.css`, `resources/js/app.js`)
   used by both the exam domain and every future Tailwind-converted step
   page. Retire Mix.
2. Tailwind design tokens (colors, fonts) sourced from the current site's
   actual CSS, since there's no separate brand guide.
3. Alpine.js wired in as the interactivity layer for future component work
   (nav toggles, dropdowns, tabs) — replacing Bootstrap's JS.
4. A working, isolated proof of the above — a converted header/nav/footer
   and a token/type showcase — reachable only via an unlinked internal
   route, so nothing on the live site changes yet.

## Non-goals

- Converting any real page's body content (sub-project 2+).
- Removing the legacy `public/frontend/css/*` files — they keep serving
  every not-yet-converted page and are untouched by this phase.
- A visual refresh beyond what "faithful rebuild, polish included" requires
  (per prior discussion): same recognizable structure, real typography and
  consistent spacing finally applied.

## Design

### 1. Build pipeline

Rename the exam-specific Vite entry files to the shared, generic names:

| Current | New |
|---|---|
| `resources/css/exam-app.css` | `resources/css/app.css` (overwrites the dead Mix file) |
| `resources/js/exam-app.js` | `resources/js/app.js` (overwrites the dead Mix file) |
| `resources/js/exam-bootstrap.js` | `resources/js/bootstrap.js` (overwrites the dead Mix file) |

Update the 3 exam layout headers (`resources/views/exam/{frontend,dashboard,backend}/layouts/header.blade.php`) to `@vite(['resources/css/app.css','resources/js/app.js'])`.

`vite.config.mjs` — collapse to a single input pair:

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
```

`resources/js/bootstrap.js` gains Alpine.js initialization alongside the
existing axios/CSRF setup:

```js
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
```

`resources/css/app.css` becomes the Tailwind entry (`@tailwind base;
@tailwind components; @tailwind utilities;`), replacing exam's old
`exam-app.css` content (its custom `.btn`/`.nav`/etc. component classes
carry over unchanged, just in the renamed file).

**Retire Mix**: delete `webpack.mix.js`; remove `laravel-mix` from
`package.json` devDependencies and the `dev`/`development`/`watch`/
`watch-poll`/`hot`/`prod`/`production` scripts; remove the now-redundant
`dev:exam`/`build:exam` scripts (superseded by plain `dev`/`build` since
there's only one bundle now). New `package.json` scripts:

```json
"dev": "vite",
"build": "vite build"
```

`serve.sh` keeps calling `npm run dev` unchanged — it now starts the Vite
dev server instead of Mix watch, which is what "everything vite" means in
practice for the daily workflow.

### 2. Design tokens (`tailwind.config.js`)

Extracted from `public/frontend/css/{style,imp,custom}.css` (the highest-
frequency, most load-bearing values — see prior message in this
conversation for the audit):

```js
theme: {
  extend: {
    colors: {
      primary: '#001f66',   // dominant brand navy, 158 occurrences in style.css
      accent: '#48c7ec',    // secondary sky blue
      alert: '#ff2b58',     // sparingly-used coral, alerts/CTAs
    },
    fontFamily: {
      sans: ['Hind', 'sans-serif'],       // body — declared in style.css but never loaded; fixed here
      heading: ['Poppins', 'sans-serif'], // headings — same bug, same fix
    },
  },
},
```

Keep exam's existing `secondary`/`text*`/`dark_green`/etc. palette entries
as-is alongside the new step tokens — both domains share one config, and
exam's own converted views still depend on its color names.

Add the Google Fonts `<link>` for Hind + Poppins to the new preview
route's `<head>` (and to every real page's layout as each gets converted
in later phases) — this is the fix for the current silent fallback-to-
system-font bug.

`content` array must be updated in lockstep with the file rename in
section 1 — `./resources/js/exam-app.js` and
`./resources/js/exam-bootstrap.js` become `./resources/js/app.js` and
`./resources/js/bootstrap.js`, plus the new
`./resources/views/dev/style-guide.blade.php` path. Missing this update
wouldn't break the build (Tailwind just scans fewer files), but would
silently drop coverage of the JS entry files and the new preview view.

### 3. Alpine.js

Added as an npm dependency (`alpinejs`). Initialized once in the shared
`bootstrap.js` (above). No component code yet in this phase — later phases
use `x-data`/`x-show`/`x-transition` directly in converted Blade markup for
nav toggles, dropdowns, etc.

### 4. Deliverable: isolated preview route

A new controller action + view, not linked from any navigation and not
using any existing route name, e.g. `GET /dev/style-guide` →
`Exam`-analogous new `App\Http\Controllers\DevPreviewController@styleGuide`
(no auth middleware needed — it's dev-only scaffolding, but not
route-cached-hidden either; fine to leave reachable since it exposes no
data, just markup). Renders `resources/views/dev/style-guide.blade.php`
showing:

- Color swatches for `primary`/`accent`/`alert`
- Type scale (h1–h6 in Poppins, body copy in Hind)
- The converted header/nav (with an Alpine-driven mobile menu toggle) and
  footer, using real STEP branding/copy pulled from the current
  `frontend/layouts/{header,nav,footer}.blade.php`

This view is the only step content added to Tailwind's `content` scan
path in this phase.

### 5. Verification

No visual-regression tooling exists in this repo. Verification is manual:

1. `npm install`, `npm run build` (or `npm run dev` for the Vite dev
   server) — confirm `public/build/manifest.json` generates with one
   bundle covering both domains.
2. Visit the exam login page (`exams.step.technology:8065`) — confirm it
   still renders correctly after the entry-file rename (regression check
   on the merge work from the prior session).
3. Visit `/dev/style-guide` on step — confirm tokens, fonts, and the
   converted header/nav/footer render and the Alpine mobile-menu toggle
   works.
4. Spot-check 2–3 untouched Bootstrap pages (e.g. `/`, `/about`) — confirm
   they're pixel-identical to before, since nothing about their asset
   loading changed.

## Risks

- **File rename collisions**: `resources/css/app.css`, `resources/js/app.js`,
  and `resources/js/bootstrap.js` already exist as dead Mix files. The
  rename in section 1 overwrites them — confirmed safe (see Context), but
  worth a final `grep` for `mix(` across all Blade views immediately before
  making the change, in case something was added since this audit.
- **Exam regression**: renaming exam's live entry files is the one change
  in this phase that touches already-shipped behavior (the exam login page
  verified working in the prior session). Mitigated by verification step 2.
