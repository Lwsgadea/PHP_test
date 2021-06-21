</main>

<hr>
<footer>
  <div class="row">
    <div class="col-md-4">
      <?php
      require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Compteur.php';
      $compteur = new Compteur(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur');
      $compteur->incrementer();
      $vues = $compteur->recuperer();
      ?>
      Il y a eu <?= $vues ?> visite<?php if($vues > 1): ?>s<?php endif ?> sur le site .
    </div>
    <div class="col-md-4">
      <?php if($title !== 'Adhérer à la newsletter'): ?>
        <form action="/newsletter.php" method="POST">
          <input type="email"
                name="email"
                placeholder="Entrez votre adresse mail"
                class="form-control"
                required>
          <button type="submit" class="btn btn-primary">Confirmer l'email</button>
        </form>
      <?php endif ?>
    </div>
    <div class="col-md-4">
      <h5>Navigation</h5>
      <ul class="list-unstyled text-small">
        <?= nav_menu() ?>
      </ul>
    </div>
  </div>
</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


  </body>
</html>
