# Data Model: Cosmo Fine Art Informational Site

## Core Entities

### Product (Therapy/Item)

The `Product` entity represents a specific treatment, medical-grade nutrition item, or NAD+ therapy offered by the clinic. Since this is a strictly informational and non-commercial site, this entity lacks any pricing, inventory, or cart-related attributes.

**Fields:**

- `id` (String/UUID): Unique identifier.
- `title` (String): The name of the product or therapy.
- `short_description` (String): A brief, 1-2 sentence overview for the product cards.
- `benefits` (Array of Strings): Key clinical or aesthetic benefits.
- `ingredients` (Array of Strings): Active compounds or primary materials used.
- `treatment_protocol` (Text): The procedure, duration, or method of application.
- `clinical_focus` (String): E.g., "Cellular Energy", "Skin Regeneration".
- `recommended_usage` (Text): How often the therapy or product should be utilized.
- `image_url` (String): Path to the primary visual asset for the product card and detail hero.

**Relationships:**

- Currently a flat structure. Future Laravel backend might introduce standard taxonomy (e.g., `Category` -> `Product` 1:N), but the initial HTML prototype requires no relational complexity beyond grouping products by `clinical_focus`.

**Validation Rules:**

- `title` and `image_url` are mandatory.
- `short_description` should not exceed 150 characters for UI consistency on beige surface cards.
