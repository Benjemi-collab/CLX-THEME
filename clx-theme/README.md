# CLX Theme Pro

CLX Theme Pro est un thème WordPress premium orienté contenu cinématique pour l’agence CLX. Il propose une direction artistique glass/pills sombre avec bascule REC (dark/light), un hero vidéo 16:9, des sections modulaires et des patterns Gutenberg tabulés prêts à l’emploi.

## Prérequis

- WordPress 6.6 ou supérieur
- PHP 8.1 ou supérieur
- Navigateur moderne compatible `color-mix()` pour l’accent dynamique

## Installation

1. Copier le dossier `clx-theme/` dans `wp-content/themes/`.
2. Activer le thème dans l’administration WordPress.
3. Attribuer une page statique à la page d’accueil et lui appliquer le template **Front Page** si nécessaire.

## Fonctionnalités clés

- Palette sombre par défaut (mode ciné) avec bascule REC persistée (`localStorage` clé `clxTheme`).
- Hero vidéo 16:9 avec préchargement automatique via `wp_head` quand une vidéo est définie.
- Sections modulaires : approche, pricing slider 3D, showreel, logos, crew, contact.
- CPT dédiés (`Logos CLX`, `Crew CLX`) pour alimenter les boucles front.
- Patterns Gutenberg (`patterns/*.html`) entièrement tabulés pour reproduire les sections dans l’éditeur.
- Accessibilité : focus visibles, roles ARIA, skip link, slider clavier, team carousel pilotable aux flèches.
- Performance : scripts en pied de page, cache-busting `filemtime()`, désactivation des emojis, `prefers-reduced-motion` et fallback JS (`.clx-reduced-motion`).

## Personnalisation (Customizer)

Panel **CLX** :

- **Hero ciné**
  - Vidéo hero (MP4) – fond vidéo 16:9.
  - Poster hero – fallback image.
  - Titre & sous-titre hero.
- **Showreel**
  - Vidéo showreel – vidéo utilisée dans la section showreel.
- **Apparence**
  - Mode holo (checkbox, réserve future).
  - Couleur d’accent – surcharges de `--accent` et `--accent-soft`.

Toutes les valeurs sont nettoyées (`absint`, `sanitize_text_field`, `sanitize_hex_color`).

## CPT & métadonnées

### Logos CLX (`clx_logo`)
- Supports : titre, image à la une.
- Métadonnée `logo_url` (URL partenaire) gérée via metabox + `register_post_meta`.

### Crew CLX (`clx_team`)
- Supports : titre, image à la une, contenu (bio libre).
- Métadonnées : `team_role` (texte) et `team_hover_id` (ID image alternative pour le hover).
- Les valeurs sont exposées au REST API pour utilisation éventuelle en éditeur.

## Patterns Gutenberg

Les patterns sont enregistrés dans `inc/patterns.php` et leurs contenus HTML se trouvent dans `patterns/*.html`. Chaque ligne est indentée via tabulation conformément aux exigences. Catégorie `clx` disponible dans l’éditeur.

Patterns fournis : hero, approach, pricing, showreel, logos, team, contact.

## JavaScript

`assets/js/main.js` initialise :
- Bascule REC (`#recToggle`) → mise à jour de `data-theme` sur `<html>` + `localStorage`.
- Slider pricing (`#clx-pricing-track`) : navigation clavier (flèches, Enter/Espace), focus automatique et classes (`is-left`, `is-center`, `is-right`, `is-far`).
- Carousel team : scroll horizontal, hover image alternative (data attributes), support clavier.
- Détection `prefers-reduced-motion` → classe `clx-reduced-motion` pour neutraliser transitions.

## Styles & classes utilitaires

- `--accent`, `--accent-soft` définies dans `:root` (mode dark) et surchargées en light via `[data-theme="light"]`.
- `clx-wrap` : conteneur max 1200 px.
- `clx-header` : sticky, fond translucide, écart 1px avec hero (`.hero-fixed` margin-top: 1px).
- `btn-cam`, `btn-dot`, `rec-switch` : boutons pills & interrupteur REC.
- Sections modulaires `.approach-section`, `.pricing-section`, `.showreel-section`, `.logos-section`, `.team-section`, `.contact-section`.
- Media queries principales : 1024 px, 860 px, 640 px.

## Checklist de déploiement

- [ ] Définir la page d’accueil en tant que page statique.
- [ ] Importer vos vidéos et images (hero, showreel, posters).
- [ ] Créer vos CPT logos et talents (miniature obligatoire, metas remplis).
- [ ] Ajuster titre/sous-titre hero et accent via le Customizer.
- [ ] Vérifier l’accessibilité (focus, navigation clavier) et lancer un audit Lighthouse (objectif ≥ 90).

## Développement

- Aucune dépendance front tierce (pas de build step).
- Scripts chargés en footer (`wp_enqueue_script`, versionnés via `filemtime`).
- Pas de fichiers binaires dans le dépôt (images à ajouter depuis la médiathèque WP).
- Respect du format PHP-CS (espaces, `esc_html`, `esc_url`).

Bon tournage !
