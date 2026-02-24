# Phase 0: Research & Technical Decisions

## Tailwind CSS Integration for Plain HTML

- **Decision**: Use Tailwind CSS v3 via Tailwind CLI for the static HTML phase.
- **Rationale**: The user has encountered issues with Tailwind CLI v4 globbing/scanning in previous projects (noted in past conversations). Using the stable v3 CLI with a properly configured `tailwind.config.js` ensures reliable compilation of utility classes. Furthermore, taking a utility-first approach with custom theme tokens guarantees adherence to the "Design System: No hardcoded hex/px values" global rule. This setup easily migrates to Laravel Mix or Vite when the backend is integrated later.
- **Alternatives considered**: Tailwind CLI v4 (rejected due to past globbing issues), CDN (rejected for production performance).

## Custom Interactive SVG Map

- **Decision**: Embed an inline SVG map of Sweden with a custom marker and CSS-driven hover effects.
- **Rationale**: The spec requires a muted olive tone (#5E6B59), orange marker pulse (#E58A4A), and an interactive glass card overlay. An inline SVG allows direct CSS styling (e.g., `fill: var(--color-muted-olive)`) without the overhead or styling limitations of an iframe/third-party map service. The hover effects can be handled entirely with CSS pseudo-classes (`:hover`) and basic vanilla JavaScript for the glass card positioning if needed.
- **Alternatives considered**: Google Maps API with custom JSON styling (rejected per explicit requirement avoiding third-party dependencies), Mapbox (rejected for same reason).

## Backend Transition Architecture

- **Decision**: Build the HTML semantic structure so it can drop directly into Laravel Blade templates later.
- **Rationale**: The user specified that the future state involves Laravel and Filament PHP v4. By using standard HTML5 layout tags and maintaining a clear separation of components, the HTML files can be easily converted to Blade components (`<x-layout>`, etc.) in the future.
- **Alternatives considered**: Building a headless decoupled frontend (rejected strictly by the "Plain HTML" rule and unnecessary complexity for an informational site).
