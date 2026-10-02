import { useEffect, useMemo, useState } from "react";
import {
  Heart,
  Search,
  ShoppingBag,
  SlidersHorizontal,
  Sparkles,
  Star,
  X,
} from "lucide-react";
import "./styles.css";

const products = [
  { id: 1, name: "Everyday Headphones", category: "Audio", price: 79, rating: 4.7, reviews: 312, tag: "Best match", emoji: "🎧", tone: "violet", score: 96 },
  { id: 2, name: "Minimal Desk Lamp", category: "Home", price: 48, rating: 4.6, reviews: 184, tag: "Popular", emoji: "💡", tone: "gold", score: 91 },
  { id: 3, name: "Travel Daypack", category: "Travel", price: 64, rating: 4.8, reviews: 529, tag: "Top rated", emoji: "🎒", tone: "blue", score: 94 },
  { id: 4, name: "Smart Water Bottle", category: "Wellness", price: 42, rating: 4.5, reviews: 146, tag: "New", emoji: "🥤", tone: "mint", score: 87 },
  { id: 5, name: "Compact Mechanical Keyboard", category: "Tech", price: 98, rating: 4.9, reviews: 688, tag: "Customer favorite", emoji: "⌨️", tone: "peach", score: 95 },
  { id: 6, name: "Weekend Sneakers", category: "Lifestyle", price: 88, rating: 4.7, reviews: 402, tag: "Trending", emoji: "👟", tone: "rose", score: 90 },
  { id: 7, name: "Portable Speaker", category: "Audio", price: 69, rating: 4.6, reviews: 271, tag: "Great value", emoji: "🔊", tone: "indigo", score: 89 },
  { id: 8, name: "Ceramic Pour-Over Set", category: "Home", price: 54, rating: 4.8, reviews: 233, tag: "Staff pick", emoji: "☕", tone: "sand", score: 92 },
];

const STORAGE_KEY = "smart-commerce.cart";

function App() {
  const [query, setQuery] = useState("");
  const [category, setCategory] = useState("All");
  const [sort, setSort] = useState("Recommended");
  const [cart, setCart] = useState(() => {
    try {
      return JSON.parse(localStorage.getItem(STORAGE_KEY)) || [];
    } catch {
      return [];
    }
  });
  const [wishlist, setWishlist] = useState([]);
  const [cartOpen, setCartOpen] = useState(false);

  useEffect(() => {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));
  }, [cart]);

  const categories = ["All", ...new Set(products.map((product) => product.category))];

  const filtered = useMemo(() => {
    let result = products.filter((product) => {
      const matchesQuery = product.name.toLowerCase().includes(query.toLowerCase());
      const matchesCategory = category === "All" || product.category === category;
      return matchesQuery && matchesCategory;
    });

    if (sort === "Price: low to high") result = [...result].sort((a, b) => a.price - b.price);
    if (sort === "Price: high to low") result = [...result].sort((a, b) => b.price - a.price);
    if (sort === "Top rated") result = [...result].sort((a, b) => b.rating - a.rating);
    if (sort === "Recommended") result = [...result].sort((a, b) => b.score - a.score);

    return result;
  }, [query, category, sort]);

  const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
  const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

  const addToCart = (product) => {
    setCart((current) => {
      const existing = current.find((item) => item.id === product.id);
      if (existing) {
        return current.map((item) =>
          item.id === product.id ? { ...item, quantity: item.quantity + 1 } : item
        );
      }
      return [...current, { ...product, quantity: 1 }];
    });
  };

  const updateQuantity = (id, delta) => {
    setCart((current) =>
      current
        .map((item) =>
          item.id === id ? { ...item, quantity: Math.max(0, item.quantity + delta) } : item
        )
        .filter((item) => item.quantity > 0)
    );
  };

  const toggleWishlist = (id) => {
    setWishlist((current) =>
      current.includes(id) ? current.filter((item) => item !== id) : [...current, id]
    );
  };

  return (
    <main>
      <header className="topbar">
        <div className="brand">
          <div className="brand-mark">S</div>
          <div>
            <strong>ShopSense</strong>
            <span>Smart commerce experience</span>
          </div>
        </div>

        <nav>
          <a href="#discover">Discover</a>
          <a href="#why">Why ShopSense</a>
        </nav>

        <button className="cart-button" onClick={() => setCartOpen(true)}>
          <ShoppingBag size={17} />
          Cart
          {cartCount > 0 && <span>{cartCount}</span>}
        </button>
      </header>

      <section className="hero" id="discover">
        <div className="hero-copy">
          <span className="eyebrow"><Sparkles size={14} /> PERSONALIZED DISCOVERY</span>
          <h1>Find products that fit <em>how you live.</em></h1>
          <p>
            Search, compare, and shop through a curated storefront designed around relevance,
            value, and a cleaner path from discovery to checkout.
          </p>

          <div className="search-bar">
            <Search size={19} />
            <input
              value={query}
              onChange={(event) => setQuery(event.target.value)}
              placeholder="Search products"
            />
          </div>
        </div>

        <div className="recommendation-card">
          <span className="section-label">SMART MATCHING</span>
          <h2>Recommended for you</h2>
          <p>
            Products are ranked using a lightweight relevance score combining rating,
            popularity, value, and discovery signals.
          </p>
          <div className="score-row">
            <span>Relevance</span>
            <strong>96%</strong>
          </div>
          <div className="score-track"><span /></div>
        </div>
      </section>

      <section className="storefront">
        <aside className="filters">
          <div className="filter-title">
            <SlidersHorizontal size={17} />
            <strong>Browse</strong>
          </div>

          <div className="filter-group">
            <span>Category</span>
            {categories.map((item) => (
              <button
                className={category === item ? "active" : ""}
                key={item}
                onClick={() => setCategory(item)}
              >
                {item}
              </button>
            ))}
          </div>

          <div className="filter-insight">
            <Sparkles size={16} />
            <div>
              <strong>Smarter discovery</strong>
              <p>Recommendations adapt to the category and products you explore.</p>
            </div>
          </div>
        </aside>

        <section className="catalog">
          <div className="catalog-header">
            <div>
              <span className="section-label">CURATED CATALOG</span>
              <h2>{filtered.length} products</h2>
            </div>

            <select value={sort} onChange={(event) => setSort(event.target.value)}>
              {["Recommended", "Top rated", "Price: low to high", "Price: high to low"].map((item) => (
                <option key={item}>{item}</option>
              ))}
            </select>
          </div>

          <div className="product-grid">
            {filtered.map((product) => (
              <article className="product-card" key={product.id}>
                <div className={`product-visual tone-${product.tone}`}>
                  <span className="product-tag">{product.tag}</span>
                  <button
                    className={wishlist.includes(product.id) ? "wish active" : "wish"}
                    onClick={() => toggleWishlist(product.id)}
                    aria-label="Save product"
                  >
                    <Heart size={16} fill={wishlist.includes(product.id) ? "currentColor" : "none"} />
                  </button>
                  <div className="emoji">{product.emoji}</div>
                </div>

                <div className="product-body">
                  <span className="category">{product.category}</span>
                  <h3>{product.name}</h3>
                  <div className="rating">
                    <Star size={13} fill="currentColor" />
                    <strong>{product.rating}</strong>
                    <span>({product.reviews})</span>
                  </div>

                  <div className="product-footer">
                    <strong>${product.price}</strong>
                    <button onClick={() => addToCart(product)}>Add to cart</button>
                  </div>
                </div>
              </article>
            ))}
          </div>
        </section>
      </section>

      <section className="value-section" id="why">
        <div>
          <span className="section-label">COMMERCE EXPERIENCE</span>
          <h2>Designed around decisions, not clutter.</h2>
        </div>
        <div className="value-grid">
          <article>
            <strong>01</strong>
            <h3>Relevant discovery</h3>
            <p>Ranking and filtering make it easier to get from a broad catalog to a useful shortlist.</p>
          </article>
          <article>
            <strong>02</strong>
            <h3>Fast comparison</h3>
            <p>Ratings, categories, pricing, and product signals stay visible where decisions happen.</p>
          </article>
          <article>
            <strong>03</strong>
            <h3>Low-friction cart</h3>
            <p>Cart state persists locally so users can continue shopping without losing progress.</p>
          </article>
        </div>
      </section>

      {cartOpen && (
        <div className="cart-backdrop" onMouseDown={() => setCartOpen(false)}>
          <aside className="cart-drawer" onMouseDown={(event) => event.stopPropagation()}>
            <div className="cart-header">
              <div>
                <span className="section-label">YOUR CART</span>
                <h2>{cartCount} item{cartCount === 1 ? "" : "s"}</h2>
              </div>
              <button onClick={() => setCartOpen(false)}><X size={20} /></button>
            </div>

            <div className="cart-items">
              {cart.length === 0 ? (
                <div className="empty-cart">
                  <ShoppingBag size={28} />
                  <h3>Your cart is empty</h3>
                  <p>Add a few products to see the checkout experience.</p>
                </div>
              ) : (
                cart.map((item) => (
                  <div className="cart-item" key={item.id}>
                    <div className={`cart-thumb tone-${item.tone}`}>{item.emoji}</div>
                    <div className="cart-item-main">
                      <strong>{item.name}</strong>
                      <span>${item.price}</span>
                    </div>
                    <div className="quantity">
                      <button onClick={() => updateQuantity(item.id, -1)}>−</button>
                      <span>{item.quantity}</span>
                      <button onClick={() => updateQuantity(item.id, 1)}>+</button>
                    </div>
                  </div>
                ))
              )}
            </div>

            <div className="cart-summary">
              <div><span>Subtotal</span><strong>${subtotal.toFixed(2)}</strong></div>
              <div><span>Estimated shipping</span><strong>{subtotal >= 100 ? "Free" : "$8.00"}</strong></div>
              <button disabled={!cart.length}>Continue to checkout</button>
              <small>Demo checkout only. No payment is processed.</small>
            </div>
          </aside>
        </div>
      )}
    </main>
  );
}

export default App;
