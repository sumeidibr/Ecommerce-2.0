<?php include('includes/header.php'); ?>

<div class="container mt-5">
  <div class="row">

    <!-- Filtros -->
    <div class="col-md-3">
      <h4>Filtrar</h4>
      <form method="GET" action="">
        <div class="mb-3">
          <label for="categoria" class="form-label">Categoria</label>
          <select class="form-select" id="categoria" name="categoria">
            <option value="">Todas</option>
            <option value="celulares">Celulares</option>
            <option value="eletro">Eletrodomésticos</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="preco_min" class="form-label">Preço mínimo</label>
          <input type="number" class="form-control" id="preco_min" name="preco_min" placeholder="0">
        </div>

        <div class="mb-3">
          <label for="preco_max" class="form-label">Preço máximo</label>
          <input type="number" class="form-control" id="preco_max" name="preco_max" placeholder="100000">
        </div>

        <div class="mb-3">
          <label for="pesquisa" class="form-label">Nome do Produto</label>
          <input type="text" class="form-control" id="pesquisa" name="pesquisa" placeholder="Ex: Samsung">
        </div>

        <button type="submit" class="btn btn-primary w-100">Pesquisar</button>
      </form>
    </div>

    <!-- Catálogo de Produtos -->
    <div class="col-md-9">
      <h4>Produtos Encontrados</h4>
      <div class="row overflow-auto" style="max-height: 75vh;">
        
        <!-- Produto 1 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="assets/img/celular.jpg" class="card-img-top" alt="Produto 1">
            <div class="card-body">
              <h5 class="card-title">Samsung Galaxy A23</h5>
              <p class="card-text">Preço: 12.500 MT</p>
              <a href="#" class="btn btn-outline-primary w-100">Ver Detalhes</a>
            </div>
          </div>
        </div>

        <!-- Produto 2 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="assets/img/eletro.jpg" class="card-img-top" alt="Produto 2">
            <div class="card-body">
              <h5 class="card-title">Forno Elétrico LG</h5>
              <p class="card-text">Preço: 9.750 MT</p>
              <a href="#" class="btn btn-outline-primary w-100">Ver Detalhes</a>
            </div>
          </div>
        </div>

        <!-- Produto 3 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="assets/img/celular.jpg" class="card-img-top" alt="Produto 3">
            <div class="card-body">
              <h5 class="card-title">iPhone 11</h5>
              <p class="card-text">Preço: 39.000 MT</p>
              <a href="#" class="btn btn-outline-primary w-100">Ver Detalhes</a>
            </div>
          </div>
        </div>

        <!-- Mais produtos podem ser adicionados aqui... -->

      </div>
    </div>

  </div>
</div>

<?php include('includes/footer.php'); ?>
