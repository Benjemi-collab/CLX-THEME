# CLX Theme Pro

CLX Theme Pro is a premium WordPress theme crafted for the CLX content agency. It delivers a cinematic hero, glass-and-pill aesthetics, modular Gutenberg patterns, and custom sliders that spotlight offers and team members.

## Installation
1. Clone the repository or copy the `clx-theme` directory into your WordPress installation under `wp-content/themes/`.
2. Activate **CLX Theme Pro** from the WordPress admin (`Apparence → Thèmes`).
3. Assign the **Primary** menu location to your preferred navigation (`Apparence → Menus`).
4. Create a static front page and assign the **Accueil** page to use the “Page d’accueil” template if desired (`Réglages → Lecture`).

## Customizer options
Navigate to `Apparence → Personnaliser → CLX` to configure the following:
- **Hero**
  - *Vidéo Hero* (`clx_hero_video_id`): 16:9 landscape video attachment.
  - *Poster Hero* (`clx_hero_poster_id`): fallback image displayed before playback.
  - *Titre Hero* (`clx_hero_title`) and *Sous-titre* (`clx_hero_sub`).
- **Showreel**
  - *Vidéo Showreel* (`clx_showreel_video_id`): showcase video embedded in the showreel section.
- **Apparence**
  - Optional accent color override.
  - *Activer les avatars holographiques* (`clx_holo_enabled`) for future visual variations.

## Custom Post Types & meta
Two custom post types are provided for marketing content blocks:

| Post type | Purpose | Supports | Meta keys |
|-----------|---------|----------|-----------|
| `clx_logo` | Client logos displayed in the logos carousel | Title, featured image | `logo_url` (URL visited on click) |
| `clx_team` | Team members shown in the horizontal slider | Title, excerpt, featured image | `team_role` (text), `team_hover_id` (image ID for hover state) |

The team meta box loads a media modal (`assets/js/admin-meta.js`) that allows selecting or clearing the hover image.

## Gutenberg block patterns
Patterns are registered under the **CLX** category and sourced from `patterns/*.html`:
- Hero vidéo CLX (`clx/hero`)
- Approche orchestrée (`clx/approach`)
- Slider formules 3D (`clx/pricing`)
- Showreel Customizer (`clx/showreel`)
- Logos clients (`clx/logos`)
- Slider équipe CLX (`clx/team`)
- Contact premium (`clx/contact`)

Each pattern is tab-indented to comply with block editor linting expectations.

## Front-end behaviour
- **Theme toggle** (`#recToggle`): persists `clxTheme` in `localStorage` and flips between dark and light palettes without page reload.
- **Pricing slider**: keyboard-friendly carousel with 3D transforms, pointer drag, and reduced-motion fallbacks.
- **Team slider**: horizontal scroll slider with previous/next controls, hover-image swap (`data-hover-src`), and scroll-snap support.
- **Drawer navigation**: burger menu opens `#clx-drawer` with identical navigation links for small viewports.
- **Back to top**: floating button (`#backTop`) returns users to the page content anchor.

## Development commands
Recommended quick checks during development:

```bash
# PHP syntax checks
find clx-theme -name '*.php' -print0 | xargs -0 -n1 php -l

# JavaScript lint (optional)
node_modules/.bin/eslint assets/js/main.js
```

*(Adjust paths if run outside the theme directory.)*

## QA checklist
- [ ] Assign a primary menu and verify hero navigation pills focus styles.
- [ ] Configure the hero video + poster and confirm preload link is output in `<head>`.
- [ ] Add at least one `clx_logo` post with featured image & optional URL; ensure logos render and links open in a new tab.
- [ ] Add `clx_team` entries (role + hover image) and confirm slider keyboard and hover behaviour.
- [ ] Test pricing slider with keyboard arrows, pointer drag, and with `prefers-reduced-motion` enabled.
- [ ] Toggle between dark and light modes; refresh to ensure the persisted theme loads immediately.
- [ ] Disable JavaScript (or emulate) to verify the noscript banner, static layout, and absence of errors.
- [ ] Run `find clx-theme -name '*.php' -print0 | xargs -0 -n1 php -l` before shipping.

---

For additional implementation details, review the inline documentation within `functions.php`, `inc/*.php`, and the section partials located in `parts/`.
