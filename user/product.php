<?php
session_start();
include '../db.php'; 

$product = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM photos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo htmlspecialchars($product['title'] ?? 'Product'); ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <style>
        /* modal styles */
        .modal { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: none; align-items: center; justify-content: center; z-index: 9999; }
        .modal-content { background: #fff; padding: 20px; border-radius: 8px; width: 320px; max-width: 90%; text-align: left; position: relative; }
        .close { position: absolute; right: 10px; top: 8px; font-size: 22px; cursor: pointer; }
        .cart-btn { cursor: pointer; border: none; background: transparent; font-size: 20px; }
        .quantity-box { display: flex; align-items: center; justify-content: center; gap: 5px; }
          
        .quantity-box button {
            padding: 5px 10px;
            font-size: 18px;
            cursor: pointer;
        }

        .quantity-box input {
            width: 40px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
}
    </style>
</head>
<body>
    <?php if ($product): ?>
        <h1><?php echo htmlspecialchars($product['title']); ?></h1>
        <img src="../<?php echo htmlspecialchars($product['image']); ?>" alt="photo" style="max-width:300px;">
        <p>₱<?php echo number_format($product['price'], 2); ?></p>

        <?php if (isset($_SESSION['id'])): ?>
            <!-- Logged in: show modal -->
            <button class="cart-btn" id="openCartBtn" aria-label="Add to cart">
                <span class="material-symbols-outlined">add_shopping_cart</span> 
            </button>

            <!-- Modal -->
            <div id="cartModal" class="modal" aria-hidden="true">
                <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="modalHeading">
                    <button class="close" id="closeModalBtn" aria-label="Close">&times;</button>
                    <h2 id="modalHeading">Add to Cart</h2>

                    <form action="add_to_cart.php" method="POST" id="addCartForm">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <label for="quantity">Quantity:</label>
                         <div class="quantity-box">
        <button type="button" onclick="changeQuantity(-1)">-</button>
        <input type="text" id="quantity" name="quantity" value="1" readonly>
        <button type="button" onclick="changeQuantity(1)">+</button>
    </div><div style="margin-top:12px;">
                            <button type="submit">Add to Cart</button>
                            <button type="button" id="cancelBtn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

        <?php else: ?>
            <!-- Not logged in: go to login, then back -->
            <a href="login.php?redirect=product.php?id=<?php echo $product['id']; ?>" class="cart-btn">
                <span class="material-symbols-outlined">add_shopping_cart</span> Login to add
            </a>
        <?php endif; ?>

    <?php else: ?>
        <p>Product not found.</p>
    <?php endif; ?>

    <script>
    // Modal JS
    (function() {
        const openBtn = document.getElementById('openCartBtn');
        const modal = document.getElementById('cartModal');
        const closeBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const form = document.getElementById('addCartForm');

        if (!modal) return; // nothing to do if product not found or not logged in

        function openModal() {
            modal.style.display = 'flex';
            modal.setAttribute('aria-hidden', 'false');
            // focus the quantity input for convenience
            const qty = document.getElementById('quantity');
            if (qty) qty.focus();
        }

        function closeModal() {
            modal.style.display = 'none';
            modal.setAttribute('aria-hidden', 'true');
        }

        openBtn && openBtn.addEventListener('click', openModal);
        closeBtn && closeBtn.addEventListener('click', closeModal);
        cancelBtn && cancelBtn.addEventListener('click', closeModal);

        // close when clicking outside modal-content
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });

        // close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });

        // Optional client-side validation before submit:
        form.addEventListener('submit', function(e) {
            const qty = parseInt(document.getElementById('quantity').value, 10);
            if (!Number.isInteger(qty) || qty < 1) {
                e.preventDefault();
                alert('Please enter a valid quantity (1 or more).');
            }
            // otherwise, form posts to add_to_cart.php
        });
    })();


function changeQuantity(amount) {
    let qtyInput = document.getElementById("quantity");
    let current = parseInt(qtyInput.value);
    let newVal = current + amount;
    if (newVal >= 1) { // Prevent going below 1
        qtyInput.value = newVal;
    }
}
    </script>
</body>
</html>
