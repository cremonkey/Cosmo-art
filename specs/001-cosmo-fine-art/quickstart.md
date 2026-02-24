# Quickstart: Cosmo Fine Art Frontend

This repository currently contains the static HTML and Tailwind CSS frontend prototype for Cosmo Fine Art.

## Requirements

- [Node.js](https://nodejs.org/) (for Tailwind CLI)
- A local web server (e.g., VS Code Live Server extension, `npx serve`, or Python's `http.server`)

## Setup Instructions

1. **Install Dependencies**:
   Install Tailwind CSS and related dependencies to handle the utility classes.

   ```bash
   npm install
   ```

2. **Run the Tailwind Watcher**:
   Start the Tailwind CLI build process to watch your HTML files for changes and recompile the CSS.

   ```bash
   npx tailwindcss -i ./src/css/input.css -o ./dist/css/style.css --watch
   ```

3. **Serve the HTML**:
   Open a new terminal window and run a local server in the project root to view the site (and avoid CORS issues with local fonts/assets if any):
   ```bash
   npx serve .
   ```
   Alternatively, open `index.html` directly in your browser, or use the "Go Live" button if using the VS Code Live Server extension.

## Backend Transition Note

This HTML template is designed to be directly ported into Laravel Blade (`.blade.php`) components. No heavy JavaScript frameworks (React/Vue) have been utilized, ensuring a seamless transition to the Laravel/Filament PHP stack in the next phase.
