    </main>
  </div>

  <!-- Standard Admin Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/store-data.js"></script>
  <script src="../assets/js/admin.js"></script>
  <?php 
  if (!empty($pageScripts)) echo $pageScripts; 
  if (!empty($extraScripts)) echo $extraScripts; 
  ?>
</body>
</html>
