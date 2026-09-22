  <!-- Floating WhatsApp Action -->
  <a href="https://wa.me/919829012345?text=Hello%20Hari%20Om%20Computer,%20I%20have%20an%20inquiry" target="_blank" class="whatsapp-float" title="Chat on WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>

  <!-- Store Footer -->
  <footer class="footer-hoc">
    <div class="container">
      <div class="row g-4 mb-5">
        <div class="col-lg-4">
          <div class="d-flex align-items-center gap-2 mb-3">
            <div class="brand-icon-box" style="width: 38px; height: 38px; font-size: 1.2rem;">
              <i class="bi bi-cpu"></i>
            </div>
            <span class="text-white fw-bold fs-5">HARI OM COMPUTER</span>
          </div>
          <p class="small text-light text-opacity-75 mb-3">
            Your Trusted Computer & Technology Partner in Jodhpur, Rajasthan. Providing genuine laptops, pre-built PCs, workstation rigs, and components since 2010.
          </p>
          <div class="footer-contact-info">
            <p><i class="bi bi-geo-alt-fill text-info"></i> <span>Plot No. 42, Station Road, Near Sojati Gate, Jodhpur</span></p>
            <p><i class="bi bi-telephone-fill text-info"></i> <span>+91 98290 12345 / 0291-2654321</span></p>
            <p><i class="bi bi-envelope-fill text-info"></i> <span>info@hariomcomputer.com</span></p>
          </div>
        </div>

        <div class="col-6 col-md-3 col-lg-2">
          <div class="footer-title">Products</div>
          <ul class="footer-links">
            <li><a href="laptops.php">Laptops</a></li>
            <li><a href="computers.php">Desktop PCs</a></li>
            <li><a href="components.php">Processors</a></li>
            <li><a href="components.php">Graphics Cards</a></li>
            <li><a href="products.php?cat=Display">Monitors</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-3 col-lg-2">
          <div class="footer-title">Custom Builds</div>
          <ul class="footer-links">
            <li><a href="pc-builder.php">PC Builder Tool</a></li>
            <li><a href="computers.php">Gaming Towers</a></li>
            <li><a href="computers.php">Editing Workstations</a></li>
            <li><a href="enquiry.php">Request Quotation</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-3 col-lg-2">
          <div class="footer-title">Quick Links</div>
          <ul class="footer-links">
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.php">Store Location</a></li>
            <li><a href="enquiry.php">Enquiry Cart</a></li>
            <li><a href="../admin/login.php">Admin Portal</a></li>
          </ul>
        </div>

        <div class="col-6 col-md-3 col-lg-2">
          <div class="footer-title">Business Hours</div>
          <p class="small text-light text-opacity-75 mb-2">Monday - Saturday:<br><strong class="text-white">10:00 AM - 8:30 PM</strong></p>
          <p class="small text-light text-opacity-75 mb-0">Sunday:<br><strong class="text-white">Closed (Orders Online)</strong></p>
        </div>
      </div>

      <div class="pt-4 border-top border-white border-opacity-10 d-flex flex-wrap justify-content-between align-items-center small text-light text-opacity-75">
        <p class="mb-0">&copy; <?php echo date('Y'); ?> Hari Om Computer. All rights reserved. Commercial Prototype.</p>
        <p class="mb-0">GSTIN: 08AABCH1234F1Z9 &bull; Jodhpur, Rajasthan</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/store-data.js"></script>
  <script src="../assets/js/main.js"></script>
  <?php 
  if (!empty($pageScripts)) echo $pageScripts; 
  if (!empty($extraScripts)) echo $extraScripts; 
  ?>
</body>
</html>
