# Tasks: Cosmo Fine Art Website

**Input**: Design documents from `specs/001-cosmo-fine-art/`
**Prerequisites**: plan.md (required), spec.md (required for user stories), research.md, data-model.md, quickstart.md

**Organization**: Tasks are grouped by user story to enable independent implementation and testing of each story.

## Phase 1: Setup (Shared Infrastructure)

**Purpose**: Project initialization and basic structure

- [ ] T001 Initialize npm project and install Tailwind CSS v3
- [ ] T002 Create project directory structure (`src/css`, `src/js`, `dist`)
- [ ] T003 Configure `tailwind.config.js` with brand color palette (Sage Green, Warm Beige, Soft Cream, Muted Olive, Medical Orange, Deep Forest) and modern sans-serif/serif fonts
- [ ] T004 Create base CSS file in `src/css/input.css` with Tailwind directives

---

## Phase 2: Foundational (Blocking Prerequisites)

**Purpose**: Core infrastructure that MUST be complete before ANY user story can be implemented

**⚠️ CRITICAL**: No user story work can begin until this phase is complete

- [ ] T005 Create base HTML structure with SEO meta tags, Google Fonts links, and mobile viewport settings in `index.html`
- [ ] T006 [P] Create shared navigation header structure in `index.html` (to be reused)
- [ ] T007 Initialize empty `src/js/animations.js` file for global animations

**Checkpoint**: Foundation ready - HTML/CSS basics are in place.

---

## Phase 3: User Story 1 - Brand Discovery & Landing (Priority: P1) 🎯 MVP

**Goal**: Establish the premium Swedish clinical luxury positioning with a luxury homepage layout and animations.

**Independent Test**: Load `index.html` in a browser. The hero section must display the tagline, slow-moving organic background shapes, and a soft fade-in without any e-commerce elements. CTA should glow Medical Orange on hover.

### Implementation for User Story 1

- [ ] T008 [US1] Build full-screen Hero section in `index.html`
- [ ] T009 [P] [US1] Implement slow-moving organic abstract shapes background using CSS/SVG in `index.html`
- [ ] T010 [US1] Style Hero text, tagline ("Innovazione Flow Like The Sea"), and CTA button
- [ ] T011 [US1] Add soft Medical Orange hover glow to the CTA button in `src/css/input.css`
- [ ] T012 [P] [US1] Implement soft fade-up animations (0.8s ease-out) on page load via `src/js/animations.js` or CSS

**Checkpoint**: The landing page feels premium and sets the aesthetic tone.

---

## Phase 4: User Story 2 - Product Exploration without E-commerce (Priority: P1)

**Goal**: Allow users to browse products and therapies via an informational grid and detail page, strictly without any e-commerce functionality.

**Independent Test**: Navigate to `products.html` and `product-detail.html`. Ensure there are no prices, cart buttons, or checkout flows. Product cards must zoom 1.03x on hover with an orange border glow.

### Implementation for User Story 2

- [ ] T013 [US2] Create `products.html` with the shared base HTML template
- [ ] T014 [US2] Build a 3-column responsive product grid in `products.html`
- [ ] T015 [US2] Design product cards (image, name, short description, "View Details" button) mimicking the Data Model
- [ ] T016 [P] [US2] Add card hover effects (lift, bright orange border glow, 1.03 scale image zoom) in `src/css/input.css`
- [ ] T017 [US2] Create `product-detail.html` with the shared base HTML template
- [ ] T018 [US2] Build the hero product image section with soft floating parallax in `product-detail.html`
- [ ] T019 [P] [US2] Implement the clean tab system for product details (benefits, ingredients, protocol) with animated underlines using Vanilla JS in `src/js/animations.js`

**Checkpoint**: Product showcase works entirely as an informational catalog.

---

## Phase 5: User Story 3 - Scientific Education (Priority: P2)

**Goal**: Educate the user on the science of NAD+ and the clinic's nutrition philosophy to build credibility.

**Independent Test**: View the `about.html` page (or corresponding sections) to see the science infographics with subtle molecular line animations and the philosophy manifesto.

### Implementation for User Story 3

- [ ] T020 [US3] Create `about.html` with the shared base HTML template
- [ ] T021 [US3] Build the "Swedish Innovation" split layout (Left: Clinic imagery with organic shape masks, Right: Text content) in `about.html`
- [ ] T022 [US3] Build the "Science of NAD+" dark sage background section with infographic blocks
- [ ] T023 [US3] Build the "Philosophy" section with large serif manifesto headline
- [ ] T024 [P] [US3] Add staggered text slide-ins and molecular line/icon bounce animations to the Science and Philosophy sections in `src/js/animations.js`

**Checkpoint**: Educational and philosophical content is presented with a scientific yet artistic feel.

---

## Phase 6: User Story 4 - Location & Contact Discovery (Priority: P2)

**Goal**: Help users find the clinic location via a custom map and access contact information.

**Independent Test**: Verify the location section displays a muted olive interactive SVG map. The map should darken and the marker should glow orange on hover.

### Implementation for User Story 4

- [ ] T025 [US4] Add Location section to `index.html` (or shared footer)
- [ ] T026 [P] [US4] Embed custom inline SVG map of Sweden in the Location section
- [ ] T027 [US4] Style the SVG map (muted olive fill, orange marker pulse) in `src/css/input.css`
- [ ] T028 [US4] Implement the hover effect logic (map darkens, glass card overlay shows address, marker glows) using CSS
- [ ] T029 [US4] Build the Dark Sage Footer (Navigation links, social icons, contact info) across all HTML files

**Checkpoint**: Clinic physical location and contact methods are clear and stylish.

---

## Phase 7: Polish & Cross-Cutting Concerns

**Purpose**: Improvements that affect multiple user stories

- [ ] T030 Validate mobile-first scaling and responsiveness across all pages (`index.html`, `products.html`, `product-detail.html`, `about.html`)
- [ ] T031 Optimize all custom scroll and hover animations to ensure smooth 60fps performance
- [ ] T032 [P] Verify semantic HTML5 elements are used for accessibility
- [ ] T033 Ensure all buttons and touch targets are >= 44px for mobile users (per global rules)

---

## Dependencies & Execution Order

### Phase Dependencies

- **Setup (Phase 1)**: No dependencies - can start immediately
- **Foundational (Phase 2)**: Depends on Setup completion - BLOCKS all user stories
- **User Stories (Phase 3+)**: All depend on Foundational phase completion
- **Polish (Final Phase)**: Depends on all user stories being complete

### Parallel Opportunities

- Tailwind configuration (T003, T004) can be done alongside basic file creation.
- US1, US2, US3, and US4 can all run in parallel once the base HTML structure (T005) is complete, as they focus on distinct portions of the site or separate HTML files.
- CSS styling for specialized components (like hover effects and CSS animations) can be tackled in parallel with the HTML DOM structure.

## Implementation Strategy

### MVP First (User Story 1 & 2 Only)

1. Complete Phase 1 & 2 (Setup & Foundational)
2. Complete Phase 3 (US1 - Homepage Hero)
3. Complete Phase 4 (US2 - Product Informational Pages)
4. Validate these two core pages. This provides enough to showcase the brand aesthetic and the treatments offered.
5. Follow up with Phase 5 & 6 (Science, Philosophy, Location) to complete the experience.
