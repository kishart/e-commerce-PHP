<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
   <style>
    .footer {
  background-color: #D0C3B8;
  padding: 40px 80px;
  border-top: 1px solid #ddd;
  font-family: Arial, sans-serif;
}

.footer-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 40px;
}

.footer-section {
  flex: 1;
  min-width: 200px;
}

.footer-logo {
  font-size: 22px;
  font-weight: bold;
  margin-bottom: 15px;
}

.footer-section h3 {
  font-size: 14px;
  color: #777;
  margin-bottom: 15px;
}

.footer-section ul {
  list-style: none;
  padding: 0;
}

.footer-section ul li {
  margin-bottom: 10px;
}

.footer-section ul li a {
  text-decoration: none;
  color: #000;
  font-weight: bold;
}

.newsletter {
  display: flex;
  border-bottom: 1px solid #000;
  padding-bottom: 5px;
  max-width: 250px;
}

.newsletter input {
  border: none;
  outline: none;
  flex: 1;
  font-size: 14px;
}

.newsletter button {
  border: none;
  background: none;
  font-weight: bold;
  cursor: pointer;
}

   </style>
</head>
<body>
    <footer class="footer">
  <div class="footer-container">
    
    <!-- Logo + Address -->
    <div class="footer-section">
       <h2><span class="material-symbols-outlined">
shopping_bag_speed
</span>
e-commerce</h2>

      <p style="margin-top: 5px;">400 University Drive Suite 200 
      </p>
   <p style="margin-top: 5px;">  Coral Gables FL 33134 USA</p>
    </div>

    <!-- Links -->
    <div class="footer-section">
      <h3>Links</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Shop</a></li>
        <li><a href="#">About</a></li>
      </ul>
    </div>

    <!-- Help -->
    <div class="footer-section">
      <h3>Help</h3>
      <ul>
        <li><a href="#">Payment Options</a></li>
        <li><a href="#">Returns</a></li>
        <li><a href="#">Privacy Policies</a></li>
      </ul>
    </div>

    <!-- Newsletter -->
    <div class="footer-section">
      <h3>Newsletter</h3>
      <form class="newsletter">
        <input type="email" placeholder="Enter Your Email Address">
        <button type="submit">SUBSCRIBE</button>
      </form>
    </div>

  </div>
</footer>

    
</body>
</html>