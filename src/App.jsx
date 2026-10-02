import { useEffect, useMemo, useState } from "react";
import {
  Bot,
  Check,
  Heart,
  History,
  MessageCircle,
  Search,
  ShoppingBag,
  SlidersHorizontal,
  Sparkles,
  Star,
  X,
} from "lucide-react";
import "./styles.css";

const products = [
  { id: 1, name: "Everyday Headphones", category: "Audio", price: 79, rating: 4.7, reviews: 312, tag: "Best match", emoji: "🎧", tone: "violet", score: 96, keywords: ["music","commute","work","wireless","audio","travel"] },
  { id: 2, name: "Minimal Desk Lamp", category: "Home", price: 48, rating: 4.6, reviews: 184, tag: "Popular", emoji: "💡", tone: "gold", score: 91, keywords: ["desk","study","work","home","lighting","minimal"] },
  { id: 3, name: "Travel Daypack", category: "Travel", price: 64, rating: 4.8, reviews: 529, tag: "Top rated", emoji: "🎒", tone: "blue", score: 94, keywords: ["travel","trip","bag","backpack","flight","weekend"] },
  { id: 4, name: "Smart Water Bottle", category: "Wellness", price: 42, rating: 4.5, reviews: 146, tag: "New", emoji: "🥤", tone: "mint", score: 87, keywords: ["fitness","gym","wellness","hydration","health","travel"] },
  { id: 5, name: "Compact Mechanical Keyboard", category: "Tech", price: 98, rating: 4.9, reviews: 688, tag: "Customer favorite", emoji: "⌨️", tone: "peach", score: 95, keywords: ["keyboard","work","coding","desk","tech","productivity"] },
  { id: 6, name: "Weekend Sneakers", category: "Lifestyle", price: 88, rating: 4.7, reviews: 402, tag: "Trending", emoji: "👟", tone: "rose", score: 90, keywords: ["shoes","walking","weekend","casual","travel","lifestyle"] },
  { id: 7, name: "Portable Speaker", category: "Audio", price: 69, rating: 4.6, reviews: 271, tag: "Great value", emoji: "🔊", tone: "indigo", score: 89, keywords: ["speaker","music","party","portable","audio","outdoor","travel"] },
  { id: 8, name: "Ceramic Pour-Over Set", category: "Home", price: 54, rating: 4.8, reviews: 233, tag: "Staff pick", emoji: "☕", tone: "sand", score: 92, keywords: ["coffee","kitchen","home","gift","morning","ceramic"] },
  { id: 9, name: "City Running Shoes", category: "Lifestyle", price: 76, rating: 4.8, reviews: 611, tag: "Runner favorite", emoji: "👟", tone: "mint", score: 93, keywords: ["shoe","shoes","sneaker","sneakers","running","walking","fitness","footwear","gym"] },
  { id: 10, name: "Trail Hiking Shoes", category: "Travel", price: 92, rating: 4.7, reviews: 438, tag: "Outdoor pick", emoji: "🥾", tone: "sand", score: 90, keywords: ["shoe","shoes","boots","hiking","trail","outdoor","travel","walking","footwear"] },
  { id: 11, name: "Noise-Canceling Earbuds", category: "Audio", price: 89, rating: 4.8, reviews: 742, tag: "Commute pick", emoji: "🎶", tone: "blue", score: 95, keywords: ["music","earbuds","headphones","wireless","commute","audio","travel","noise"] },
  { id: 12, name: "Ergonomic Desk Stand", category: "Tech", price: 58, rating: 4.6, reviews: 267, tag: "Work setup", emoji: "💻", tone: "indigo", score: 87, keywords: ["desk","work","laptop","stand","office","ergonomic","productivity","tech"] },
  { id: 13, name: "Insulated Travel Mug", category: "Travel", price: 36, rating: 4.7, reviews: 519, tag: "Everyday value", emoji: "🥤", tone: "gold", score: 88, keywords: ["travel","coffee","mug","drink","commute","insulated","gift"] },
  { id: 14, name: "Yoga & Mobility Mat", category: "Wellness", price: 45, rating: 4.8, reviews: 326, tag: "Wellness pick", emoji: "🧘", tone: "rose", score: 89, keywords: ["yoga","fitness","gym","wellness","exercise","stretching","mat","health"] },
  { id: 15, name: "Compact Power Bank", category: "Tech", price: 39, rating: 4.7, reviews: 851, tag: "Travel essential", emoji: "🔋", tone: "peach", score: 94, keywords: ["charger","battery","power","phone","travel","tech","portable","flight"] },
  { id: 16, name: "Soft Cabin Throw", category: "Home", price: 44, rating: 4.6, reviews: 198, tag: "Cozy pick", emoji: "🧶", tone: "violet", score: 82, keywords: ["blanket","throw","home","cozy","gift","living","soft"] },
  { id: 17, name: "Everyday Crossbody Bag", category: "Lifestyle", price: 59, rating: 4.7, reviews: 355, tag: "Easy carry", emoji: "👜", tone: "rose", score: 86, keywords: ["bag","crossbody","travel","daily","carry","fashion","lifestyle"] },
  { id: 18, name: "Digital Kitchen Scale", category: "Home", price: 32, rating: 4.6, reviews: 420, tag: "Kitchen helper", emoji: "⚖️", tone: "mint", score: 84, keywords: ["kitchen","cooking","baking","scale","food","home"] },
];

const KEYS = {
  cart: "smart-commerce.cart",
  wishlist: "smart-commerce.wishlist",
  orders: "smart-commerce.orders",
  activity: "smart-commerce.activity",
};

const readStorage = (key, fallback) => {
  try {
    const value = JSON.parse(localStorage.getItem(key));
    return value ?? fallback;
  } catch {
    return fallback;
  }
};

const STOP_WORDS = new Set(["i","me","my","a","an","the","for","to","of","with","and","or","something","need","want","looking","show","find","please","that","is","are","under","below","max","budget","best","top","great","strong","review","reviews","high","rated"]);

const SYNONYMS = {
  shoe: ["shoe","shoes","sneaker","sneakers","footwear","running","walking"],
  shoes: ["shoe","shoes","sneaker","sneakers","footwear","running","walking"],
  sneaker: ["shoe","shoes","sneaker","sneakers","footwear"],
  sneakers: ["shoe","shoes","sneaker","sneakers","footwear"],
  work: ["work","desk","office","productivity","coding"],
  travel: ["travel","trip","flight","commute","portable","carry"],
  music: ["music","audio","speaker","headphones","earbuds"],
  gym: ["gym","fitness","exercise","wellness","running"],
  gift: ["gift","home","coffee","lifestyle"],
};

const intentWords = (text) => {
  const raw = text.toLowerCase().replace(/[^a-z0-9$ ]/g, " ").split(/\s+/).filter(Boolean);
  const useful = raw.filter((word) => !STOP_WORDS.has(word) && !/^\$?\d+$/.test(word));
  return [...new Set(useful.flatMap((word) => SYNONYMS[word] || [word]))];
};

function App() {
  const [query, setQuery] = useState("");
  const [category, setCategory] = useState("All");
  const [sort, setSort] = useState("Recommended");
  const [cart, setCart] = useState(() => readStorage(KEYS.cart, []));
  const [wishlist, setWishlist] = useState(() => readStorage(KEYS.wishlist, []));
  const [orders, setOrders] = useState(() => readStorage(KEYS.orders, []));
  const [activity, setActivity] = useState(() => readStorage(KEYS.activity, { categoryScores: {}, searches: [] }));
  const [panel, setPanel] = useState(null);
  const [toast, setToast] = useState("");
  const [assistantInput, setAssistantInput] = useState("");
  const [assistantMatches, setAssistantMatches] = useState([]);
  const [assistantNote, setAssistantNote] = useState("");
  const [page, setPage] = useState(1);
  const pageSize = 9;

  useEffect(() => localStorage.setItem(KEYS.cart, JSON.stringify(cart)), [cart]);
  useEffect(() => localStorage.setItem(KEYS.wishlist, JSON.stringify(wishlist)), [wishlist]);
  useEffect(() => localStorage.setItem(KEYS.orders, JSON.stringify(orders)), [orders]);
  useEffect(() => localStorage.setItem(KEYS.activity, JSON.stringify(activity)), [activity]);
  useEffect(() => {
    if (!toast) return;
    const timer = setTimeout(() => setToast(""), 2200);
    return () => clearTimeout(timer);
  }, [toast]);

  const signalCategory = (name, weight = 1) => {
    if (!name || name === "All") return;
    setActivity((current) => ({
      ...current,
      categoryScores: {
        ...current.categoryScores,
        [name]: (current.categoryScores?.[name] || 0) + weight,
      },
    }));
  };

  const personalizedScore = (product) => {
    let value = product.score;
    value += (activity.categoryScores?.[product.category] || 0) * 4;
    if (wishlist.includes(product.id)) value += 8;
    if (cart.some((item) => item.id === product.id)) value += 5;
    orders.forEach((order) => order.items.forEach((item) => {
      if (item.category === product.category) value += item.quantity * 5;
    }));
    return value;
  };

  const categories = ["All", ...new Set(products.map((product) => product.category))];

  const filtered = useMemo(() => {
    const terms = intentWords(query);
    let result = products.filter((product) => {
      const haystack = [product.name, product.category, product.tag, ...product.keywords].join(" ").toLowerCase();
      const matchesQuery = !terms.length || terms.some((term) => haystack.includes(term));
      const matchesCategory = category === "All" || product.category === category;
      return matchesQuery && matchesCategory;
    });

    if (sort === "Price: low to high") result = [...result].sort((a, b) => a.price - b.price);
    if (sort === "Price: high to low") result = [...result].sort((a, b) => b.price - a.price);
    if (sort === "Top rated") result = [...result].sort((a, b) => b.rating - a.rating);
    if (sort === "Recommended") result = [...result].sort((a, b) => personalizedScore(b) - personalizedScore(a));

    return result;
  }, [query, category, sort, activity, wishlist, cart, orders]);

  useEffect(() => setPage(1), [query, category, sort]);

  const pageCount = Math.max(1, Math.ceil(filtered.length / pageSize));
  const visibleProducts = filtered.slice((page - 1) * pageSize, page * pageSize);

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
    signalCategory(product.category, 2);
    setToast("Added " + product.name + " to cart");
    setPanel("cart");
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

  const toggleWishlist = (product) => {
    setWishlist((current) => {
      const saved = current.includes(product.id);
      setToast(saved ? "Removed " + product.name + " from wishlist" : "Saved " + product.name + " to wishlist");
      return saved ? current.filter((item) => item !== product.id) : [...current, product.id];
    });
    signalCategory(product.category, 2);
  };

  const completeOrder = () => {
    if (!cart.length) return;
    const order = {
      id: "ORD-" + String(Date.now()).slice(-6),
      date: new Date().toISOString(),
      total: subtotal + (subtotal >= 100 ? 0 : 8),
      items: cart,
    };
    setOrders((current) => [order, ...current]);
    cart.forEach((item) => signalCategory(item.category, item.quantity * 4));
    setCart([]);
    setToast("Order " + order.id + " created");
    setPanel("orders");
  };

  const runAssistant = (event) => {
    event.preventDefault();
    const text = assistantInput.trim();
    if (!text) return;
    const words = intentWords(text);
    const budgetMatch = text.match(/(?:under|below|max|budget|\$)\s*\$?(\d+)/i);
    const budget = budgetMatch ? Number(budgetMatch[1]) : null;

    const scored = products.map((product) => {
      const haystack = [product.name, product.category, product.tag, ...product.keywords].join(" ").toLowerCase();
      const matchedTerms = words.filter((word) => haystack.includes(word));
      let match = matchedTerms.length * 25;
      if (matchedTerms.length) match += personalizedScore(product) * 0.04;
      if (budget !== null) match += product.price <= budget ? 12 : -Math.min(30, (product.price - budget));
      if (/best|top|great|strong review|high rated/i.test(text)) match += product.rating * 2;
      if (/cheap|affordable|value|budget/i.test(text)) match += Math.max(0, 10 - product.price / 12);
      return { ...product, match, matchedTerms };
    });

    const semanticMatches = words.length ? scored.filter((product) => product.matchedTerms.length > 0) : scored;
    const ranked = semanticMatches
      .sort((a, b) => b.match - a.match)
      .slice(0, 5);

    setActivity((current) => ({
      ...current,
      searches: [text, ...(current.searches || []).filter((item) => item !== text)].slice(0, 8),
    }));
    setAssistantMatches(ranked);
    setAssistantNote(
      ranked.length === 0
        ? "I could not find a close catalog match. Try a broader use case or category."
        : budget
          ? "Only products matching your main intent are ranked, then budget, ratings, and saved behavior refine the order."
          : "Only products matching your main intent are ranked, then ratings and saved behavior refine the order."
    );
    setAssistantInput("");
    setPanel("assistant");
  };

  const wishlistProducts = products.filter((product) => wishlist.includes(product.id));

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
          <button className="nav-action" onClick={() => setPanel("assistant")}>
            <MessageCircle size={16} /> Ask ShopSense
          </button>
        </nav>

        <div className="header-actions">
          <button className="icon-nav" onClick={() => setPanel("wishlist")}>
            <Heart size={17} /> Wishlist
            {wishlist.length > 0 && <span>{wishlist.length}</span>}
          </button>
          <button className="icon-nav" onClick={() => setPanel("orders")}>
            <History size={17} /> Orders
            {orders.length > 0 && <span>{orders.length}</span>}
          </button>
          <button className="cart-button" onClick={() => setPanel("cart")}>
            <ShoppingBag size={17} />
            Cart
            {cartCount > 0 && <span>{cartCount}</span>}
          </button>
        </div>
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
              placeholder="Search products, use cases, or categories"
            />
          </div>

          <form className="assistant-bar" onSubmit={runAssistant}>
            <Bot size={20} />
            <input
              value={assistantInput}
              onChange={(event) => setAssistantInput(event.target.value)}
              placeholder='Try: "I need something for travel under $80 with strong reviews"'
            />
            <button type="submit">Find closest matches</button>
          </form>
        </div>

        <div className="recommendation-card">
          <span className="section-label">PERSONALIZED FOR THIS BROWSER</span>
          <h2>Recommendations that learn from activity</h2>
          <p>
            Ranking uses category browsing, searches, wishlist saves, cart activity,
            and completed demo orders stored locally in this browser.
          </p>
          <div className="score-row">
            <span>Signals currently tracked</span>
            <strong>{Object.keys(activity.categoryScores || {}).length + orders.length + wishlist.length}</strong>
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
                onClick={() => {
                  setCategory(item);
                  signalCategory(item, 1);
                }}
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
            {visibleProducts.map((product) => (
              <article className="product-card" key={product.id}>
                <div className={`product-visual tone-${product.tone}`}>
                  <span className="product-tag">{product.tag}</span>
                  <button
                    className={wishlist.includes(product.id) ? "wish active" : "wish"}
                    onClick={() => toggleWishlist(product)}
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
                    <button onClick={() => addToCart(product)}>Add to cart <span className="plus-sign">+</span></button>
                  </div>
                </div>
              </article>
            ))}
          </div>

          {filtered.length > pageSize && (
            <div className="pagination">
              <button
                onClick={() => setPage((current) => Math.max(1, current - 1))}
                disabled={page === 1}
              >
                Previous
              </button>
              <span>Page {page} of {pageCount}</span>
              <button
                onClick={() => setPage((current) => Math.min(pageCount, current + 1))}
                disabled={page === pageCount}
              >
                Next
              </button>
            </div>
          )}
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

      {toast && (
        <div className="toast"><Check size={17} />{toast}</div>
      )}

      {panel && (
        <div className="cart-backdrop" onMouseDown={() => setPanel(null)}>
          <aside className="cart-drawer wide-drawer" onMouseDown={(event) => event.stopPropagation()}>
            <div className="cart-header">
              <div>
                <span className="section-label">
                  {panel === "cart" && "YOUR CART"}
                  {panel === "wishlist" && "YOUR WISHLIST"}
                  {panel === "orders" && "PAST ORDERS"}
                  {panel === "assistant" && "SHOPSENSE ASSISTANT"}
                </span>
                <h2>
                  {panel === "cart" && cartCount + " item" + (cartCount === 1 ? "" : "s")}
                  {panel === "wishlist" && wishlistProducts.length + " saved"}
                  {panel === "orders" && orders.length + " order" + (orders.length === 1 ? "" : "s")}
                  {panel === "assistant" && "Find the closest match"}
                </h2>
              </div>
              <button onClick={() => setPanel(null)}><X size={20} /></button>
            </div>

            {panel === "cart" && <>
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
              <button disabled={!cart.length} onClick={completeOrder}>Place demo order</button>
              <small>No payment is processed. Placing the demo order creates purchase history in this browser.</small>
            </div>
            </>}

            {panel === "wishlist" && (
              <div className="drawer-list">
                {wishlistProducts.length === 0 ? (
                  <div className="empty-cart">
                    <Heart size={30} />
                    <h3>Your wishlist is empty</h3>
                    <p>Tap the heart on any product and it will appear here.</p>
                  </div>
                ) : wishlistProducts.map((product) => (
                  <div className="saved-row" key={product.id}>
                    <div className={"cart-thumb tone-" + product.tone}>{product.emoji}</div>
                    <div>
                      <strong>{product.name}</strong>
                      <span>{product.category + " · $" + product.price + " · " + product.rating + " ★"}</span>
                    </div>
                    <button onClick={() => addToCart(product)}>Add to cart</button>
                  </div>
                ))}
              </div>
            )}

            {panel === "orders" && (
              <div className="drawer-list">
                {orders.length === 0 ? (
                  <div className="empty-cart">
                    <History size={30} />
                    <h3>No past orders yet</h3>
                    <p>Place a demo order from the cart and it will show here and influence recommendations.</p>
                  </div>
                ) : orders.map((order) => (
                  <article className="order-card" key={order.id}>
                    <div className="order-heading">
                      <div><strong>{order.id}</strong><span>{new Date(order.date).toLocaleString()}</span></div>
                      <strong>{"$" + order.total.toFixed(2)}</strong>
                    </div>
                    {order.items.map((item) => (
                      <div className="order-item" key={item.id}>
                        <span>{item.emoji} {item.name}</span>
                        <span>{item.quantity + " × $" + item.price}</span>
                      </div>
                    ))}
                  </article>
                ))}
              </div>
            )}

            {panel === "assistant" && (
              <div className="assistant-panel">
                <div className="assistant-intro">
                  <Bot size={22} />
                  <p>Describe what you want naturally. ShopSense matches use case, budget, ratings, product attributes, and saved activity.</p>
                </div>
                <form className="drawer-assistant-form" onSubmit={runAssistant}>
                  <input
                    value={assistantInput}
                    onChange={(event) => setAssistantInput(event.target.value)}
                    placeholder="What are you looking for?"
                    autoFocus
                  />
                  <button type="submit">Match products</button>
                </form>
                {assistantNote && <p className="assistant-note">{assistantNote}</p>}
                <div className="assistant-results">
                  {assistantMatches.map((product, index) => (
                    <article className="assistant-result" key={product.id}>
                      <div className={"assistant-thumb tone-" + product.tone}>{product.emoji}</div>
                      <div>
                        <span>{"Match #" + (index + 1)}</span>
                        <h3>{product.name}</h3>
                        <p>
                          {product.category + " · $" + product.price + " · " + product.rating + " ★"}
                          {product.matchedTerms?.length ? " · matched " + product.matchedTerms.slice(0, 3).join(", ") : ""}
                        </p>
                      </div>
                      <button onClick={() => addToCart(product)}>Add</button>
                    </article>
                  ))}
                </div>
              </div>
            )}
          </aside>
        </div>
      )}
    </main>
  );
}

export default App;
