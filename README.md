# ShopSense: Smart Commerce Experience

A modern ecommerce storefront focused on product discovery, relevance, comparison, and a low-friction cart experience.

## Overview

This project began as a PHP + MySQL ecommerce website with login, shopping cart, payment pages, and SQL-backed product data.

It has been modernized into a standalone Vite + React storefront that is easier to deploy and better demonstrates product thinking around discovery, recommendation, conversion, and shopping UX.

## Features

- Product search
- Category filtering
- Recommendation-based sorting
- Rating and popularity signals
- Multiple sort options
- Product wishlist
- Add-to-cart workflow
- Quantity controls
- Persistent cart using Local Storage
- Free-shipping threshold logic
- Responsive storefront
- Demo checkout state
- Modern Vite production build

## Product Discovery

Products are ranked with a lightweight relevance score that represents signals such as:

- customer rating
- popularity
- value
- product discovery relevance

The interface keeps the most useful decision signals visible near the point of purchase.

## Shopping Flow

Users can:

1. Search or browse by category
2. Compare products using ratings, price, and recommendation signals
3. Save products to a wishlist
4. Add products to the cart
5. Adjust quantities
6. Review subtotal and estimated shipping

The checkout button is intentionally a demo flow and does not process real payments.

## Tech Stack

- React
- Vite
- Lucide React
- CSS
- Local Storage

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

## Project Evolution

The original PHP/MySQL implementation remains in the `ip/` directory as the historical version of the project.

The new root application reframes the project as a modern commerce product with a cleaner deployment model and stronger emphasis on user decision support, discovery, and conversion.
