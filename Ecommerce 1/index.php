<?php include('includes/header.php'); ?>

<!-- Banner Principal -->
<div class="container mt-4">
  <img src="assets/img/banner.jpg" class="img-fluid w-100 rounded shadow" alt="Banner promocional">
</div>

<!-- Categorias -->
<div class="container mt-5">
  <h2 class="text-center mb-4">Categorias</h2>
  <div class="row text-center">
    <div class="col-md-6 mb-4">
      <img src="assets/img/celular.jpg" class="img-fluid rounded" alt="Celulares">
      <h4 class="mt-2">Celulares</h4>
    </div>
    <div class="col-md-6 mb-4">
      <img src="assets/img/eletro.jpg" class="img-fluid rounded" alt="Eletrodomésticos">
      <h4 class="mt-2">Eletrodomésticos</h4>
    </div>
  </div>
</div>

<!-- Carrossel de Produtos -->
<div class="container mt-5">
  <h2 class="text-center mb-4">Produtos em Destaque</h2>
  <div id="carouselProdutos" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner text-center">
      <div class="carousel-item active">
        <img src="assets/img/celular.jpg" class="d-block w-50 mx-auto" alt="Produto 1">
        <p>Smartphone Samsung - 10000 MT</p>
      </div>
      <div class="carousel-item">
        <img src="assets/img/eletro.jpg" class="d-block w-50 mx-auto" alt="Produto 2">
        <p>Micro-ondas LG - 8500 MT</p>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProdutos" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselProdutos" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<?php include('includes/footer.php'); ?>
