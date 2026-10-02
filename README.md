# ShopSense: Smart Commerce Experience

## Live Demo

[Open ShopSense](https://shopsense-commerce.vercel.app/)

## Overview

ShopSense is a modern ecommerce experience focused on product discovery, recommendation quality, shopping intent, and low-friction conversion.

The project began as a PHP + MySQL ecommerce website with login, cart, payment pages, and SQL-backed product data. It has since been redesigned as a standalone Vite + React application that is easier to deploy and better demonstrates product thinking around discovery, personalization, cart behavior, and shopping workflows.

## Current Features

- Product search across names, categories, tags, and product keywords
- Category filtering
- Recommendation-based sorting
- Price sorting
- Top-rated sorting
- Product ratings and review counts
- Expanded multi-category product catalog
- Paginated product browsing
- Visible wishlist with saved-item count
- Persistent wishlist using Local Storage
- Add-to-cart acknowledgement
- Cart count updates
- Automatic cart drawer opening after add-to-cart
- Quantity controls
- Persistent cart state
- Free-shipping threshold logic
- Demo checkout
- Persistent past-order history
- Visible Orders section in the header
- Behavior-based recommendation signals
- Natural-language product discovery through Ask ShopSense
- Budget-aware product matching
- Generic keyword-overlap matching
- Responsive desktop and mobile layouts

## Ask ShopSense

Users can describe what they want in natural language instead of knowing the exact product name.

Example:

```text
I need something for travel under $80 with strong reviews
```

ShopSense tokenizes the request and compares the keywords against each product's:

- name
- category
- product tags
- catalog keywords

Results are ranked first by actual keyword overlap, then refined using budget, ratings, and saved personalization signals.

The matcher uses generic keyword comparison instead of hardcoded product-specific search rules.

## Search and Matching

Search supports intent-oriented catalog discovery.

For example, a query such as:

```text
shoes
```

is matched against product metadata and keywords. Products without meaningful keyword overlap are excluded instead of appearing simply because they have a high general recommendation score.

Basic word normalization also helps handle simple plural variations.

## Personalization

Recommendations are personalized using activity stored locally in the browser.

Signals currently include:

- categories explored
- wishlist saves
- products added to cart
- completed demo purchases
- saved shopping activity

These signals influence recommendation ordering while keeping the experience account-free for the demo.

All personalization data stays in Local Storage on the current browser.

## Wishlist

Users can save products using the heart control on any product card.

The header includes a visible Wishlist action with a saved-item count. Saved products can be reviewed later and added directly to the cart.

## Cart Experience

When a user adds a product to the cart:

1. The cart count updates
2. A confirmation message appears
3. The cart drawer opens
4. The selected item's quantity is visible
5. Users can increase or decrease quantities

Cart state persists locally between browser sessions.

## Orders

The demo checkout creates a local order instead of processing a real payment.

Each completed demo order stores:

- order ID
- purchase date and time
- products
- quantities
- order total

Past purchases are available through the **Orders** action in the header and also contribute to personalization signals.

## Product Catalog

The catalog includes products across categories such as:

- Audio
- Home
- Travel
- Wellness
- Tech
- Lifestyle

The catalog uses pagination so additional products can be browsed without overloading the page.

## Tech Stack

- React
- Vite
- Lucide React
- CSS
- Browser Local Storage
- Vercel

## Run Locally

```bash
git clone https://github.com/DhritiGada/Ecommerce-Website.git
cd Ecommerce-Website
npm install
npm run dev
```

## Production Build

```bash
npm run build
```

Production files are generated in:

```text
dist/
```

## Deployment

ShopSense is deployed on Vercel.

[View the live application](https://shopsense-commerce.vercel.app/)

## Project Evolution

The original PHP/MySQL implementation remains inside the `ip/` directory as the historical version of the project.

The current root application reframes the original ecommerce site into a modern commerce product with stronger emphasis on:

- intent-based discovery
- personalization
- recommendation quality
- wishlist and cart persistence
- purchase history
- conversational shopping
- conversion-oriented UX
