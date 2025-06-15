<?php include('sidebar.php'); ?>
<!DOCTYPE html>
<html lang="pt-MZ">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Produtos - Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    :root {
      --primary: #4361ee;
      --primary-dark: #3a56d4;
      --secondary: #6c757d;
      --success: #28a745;
      --danger: #dc3545;
      --warning: #ffc107;
      --info: #17a2b8;
      --light: #f8f9fa;
      --dark: #343a40;
      --border: #e2e8f0;
      --card-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      --sidebar-width: 250px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f5f7fb;
      color: #333;
      display: flex;
      min-height: 100vh;
    }

    .main-content {
      margin-left: var(--sidebar-width);
      padding: 30px;
      flex: 1;
      transition: all 0.3s;
    }

    .page-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--border);
    }

    .page-title {
      font-size: 28px;
      font-weight: 700;
      color: var(--dark);
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .page-title i {
      color: var(--primary);
    }

    /* Product Actions */
    .product-actions {
      display: flex;
      gap: 15px;
      margin-bottom: 25px;
    }

    .btn {
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s;
      border: none;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
    }

    .btn-secondary {
      background-color: white;
      color: var(--primary);
      border: 1px solid var(--primary);
    }

    .btn-secondary:hover {
      background-color: #f0f5ff;
    }

    /* Search and Filter */
    .search-filter {
      background-color: white;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 25px;
      box-shadow: var(--card-shadow);
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      align-items: center;
    }

    .search-box {
      flex: 1;
      min-width: 300px;
      position: relative;
    }

    .search-box input {
      width: 100%;
      padding: 12px 20px 12px 45px;
      border-radius: 8px;
      border: 1px solid var(--border);
      font-size: 16px;
      transition: all 0.3s;
    }

    .search-box input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
      outline: none;
    }

    .search-box i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--secondary);
    }

    .filter-group {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .filter-select {
      padding: 10px 15px;
      border-radius: 8px;
      border: 1px solid var(--border);
      background-color: white;
      color: var(--dark);
      font-size: 15px;
      min-width: 150px;
    }

    /* Products Table */
    .products-table-container {
      background-color: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }

    thead {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
    }

    th {
      padding: 16px 20px;
      text-align: left;
      font-weight: 600;
      font-size: 15px;
    }

    tbody tr {
      transition: background-color 0.2s;
    }

    tbody tr:nth-child(even) {
      background-color: #f8fafc;
    }

    tbody tr:hover {
      background-color: #f0f5ff;
    }

    td {
      padding: 16px 20px;
      border-bottom: 1px solid var(--border);
      color: #4a5568;
    }

    .product-image {
      width: 60px;
      height: 60px;
      border-radius: 8px;
      object-fit: cover;
      border: 1px solid var(--border);
    }

    .stock-indicator {
      display: inline-block;
      padding: 5px 12px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 500;
    }

    .stock-high {
      background-color: rgba(40, 167, 69, 0.15);
      color: var(--success);
    }

    .stock-medium {
      background-color: rgba(255, 193, 7, 0.15);
      color: var(--warning);
    }

    .stock-low {
      background-color: rgba(220, 53, 69, 0.15);
      color: var(--danger);
    }

    .actions {
      display: flex;
      gap: 10px;
    }

    .action-btn {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s;
      border: none;
    }

    .edit-btn {
      background-color: rgba(59, 130, 246, 0.1);
      color: var(--primary);
    }

    .edit-btn:hover {
      background-color: rgba(59, 130, 246, 0.2);
    }

    .delete-btn {
      background-color: rgba(220, 53, 69, 0.1);
      color: var(--danger);
    }

    .delete-btn:hover {
      background-color: rgba(220, 53, 69, 0.2);
    }

    /* Product Form */
    .form-container {
      background-color: white;
      border-radius: 12px;
      padding: 30px;
      box-shadow: var(--card-shadow);
    }

    .form-title {
      font-size: 22px;
      margin-bottom: 25px;
      color: var(--dark);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      margin-bottom: 25px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--dark);
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 16px;
      transition: all 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
      outline: none;
    }

    .variations-container {
      background-color: #f8fafc;
      border-radius: 8px;
      padding: 20px;
      margin-top: 10px;
    }

    .variation-row {
      display: flex;
      gap: 15px;
      margin-bottom: 15px;
    }

    .variation-row input {
      flex: 1;
    }

    .add-variation {
      background-color: rgba(23, 162, 184, 0.1);
      color: var(--info);
      border: none;
      padding: 8px 15px;
      border-radius: 6px;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 5px;
      font-weight: 500;
    }

    .image-upload {
      border: 2px dashed var(--border);
      border-radius: 12px;
      padding: 30px;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s;
    }

    .image-upload:hover {
      border-color: var(--primary);
      background-color: #f0f5ff;
    }

    .image-upload i {
      font-size: 40px;
      color: var(--secondary);
      margin-bottom: 15px;
    }

    .image-upload p {
      color: var(--secondary);
      margin-bottom: 10px;
    }

    .image-preview {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 20px;
    }

    .preview-item {
      width: 120px;
      position: relative;
    }

    .preview-item img {
      width: 100%;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
    }

    .remove-image {
      position: absolute;
      top: -8px;
      right: -8px;
      width: 24px;
      height: 24px;
      background-color: var(--danger);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 12px;
    }

    .form-submit {
      padding: 14px 30px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      transition: all 0.3s;
    }

    .form-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
    }

    /* Responsive styles */
    @media (max-width: 992px) {
      .main-content {
        margin-left: 0;
        padding: 20px;
      }
    }

    @media (max-width: 768px) {
      .search-filter {
        flex-direction: column;
        align-items: stretch;
      }
      
      .search-box {
        min-width: 100%;
      }
      
      .filter-group {
        width: 100%;
        justify-content: space-between;
      }
      
      .filter-select {
        flex: 1;
      }
      
      .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
      }
      
      .product-actions {
        flex-wrap: wrap;
      }
    }
  </style>
</head>
<body>

<div class="main-content">
  <div class="page-header">
    <div class="page-title">
      <i class="fas fa-box"></i>
      <h1>Gerenciamento de Produtos</h1>
    </div>
    <div class="product-actions">
      <button class="btn btn-primary">
        <i class="fas fa-plus"></i> Novo Produto
      </button>
      <button class="btn btn-secondary">
        <i class="fas fa-download"></i> Exportar
      </button>
      <button class="btn btn-secondary">
        <i class="fas fa-sync"></i> Atualizar
      </button>
    </div>
  </div>

  <!-- Search and Filters -->
  <div class="search-filter">
    <div class="search-box">
      <i class="fas fa-search"></i>
      <input type="text" placeholder="Pesquisar produtos...">
    </div>
    <div class="filter-group">
      <select class="filter-select">
        <option>Todas Categorias</option>
        <option>Roupas</option>
        <option>Tecnologia</option>
        <option>Calçados</option>
        <option>Acessórios</option>
      </select>
      <select class="filter-select">
        <option>Todas Marcas</option>
        <option>Marca X</option>
        <option>Marca Y</option>
        <option>Marca Z</option>
      </select>
      <select class="filter-select">
        <option>Status: Todos</option>
        <option>Ativo</option>
        <option>Inativo</option>
        <option>Esgotado</option>
      </select>
    </div>
  </div>

  <!-- Products Table -->
  <div class="products-table-container">
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Preço</th>
          <th>Estoque</th>
          <th>Categoria</th>
          <th>Marca</th>
          <th>Status</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <!-- Product 1 -->
        <tr>
          <td style="display: flex; align-items: center; gap: 15px;">
            <img src="https://images.unsplash.com/photo-1523381294911-8d3cead13475?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" class="product-image">
            <div>
              <div style="font-weight: 600;">Camiseta Azul Premium</div>
              <div style="font-size: 14px; color: var(--secondary);">#PROD-001</div>
            </div>
          </td>
          <td>850 MT</td>
          <td>
            <span class="stock-indicator stock-high">42 em estoque</span>
          </td>
          <td>Roupas</td>
          <td>Marca X</td>
          <td><span style="color: var(--success); font-weight: 500;">Ativo</span></td>
          <td>
            <div class="actions">
              <button class="action-btn edit-btn">
                <i class="fas fa-edit"></i>
              </button>
              <button class="action-btn delete-btn">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        
        <!-- Product 2 -->
        <tr>
          <td style="display: flex; align-items: center; gap: 15px;">
            <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" class="product-image">
            <div>
              <div style="font-weight: 600;">Smart Watch Series 5</div>
              <div style="font-size: 14px; color: var(--secondary);">#PROD-002</div>
            </div>
          </td>
          <td>2,499 MT</td>
          <td>
            <span class="stock-indicator stock-medium">8 em estoque</span>
          </td>
          <td>Tecnologia</td>
          <td>Marca Y</td>
          <td><span style="color: var(--success); font-weight: 500;">Ativo</span></td>
          <td>
            <div class="actions">
              <button class="action-btn edit-btn">
                <i class="fas fa-edit"></i>
              </button>
              <button class="action-btn delete-btn">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        
        <!-- Product 3 -->
        <tr>
          <td style="display: flex; align-items: center; gap: 15px;">
            <img src="https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" class="product-image">
            <div>
              <div style="font-weight: 600;">Tênis Esportivo Runner</div>
              <div style="font-size: 14px; color: var(--secondary);">#PROD-003</div>
            </div>
          </td>
          <td>1,199 MT</td>
          <td>
            <span class="stock-indicator stock-low">3 em estoque</span>
          </td>
          <td>Calçados</td>
          <td>Marca Z</td>
          <td><span style="color: var(--success); font-weight: 500;">Ativo</span></td>
          <td>
            <div class="actions">
              <button class="action-btn edit-btn">
                <i class="fas fa-edit"></i>
              </button>
              <button class="action-btn delete-btn">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
        
        <!-- Product 4 -->
        <tr>
          <td style="display: flex; align-items: center; gap: 15px;">
            <img src="https://images.unsplash.com/photo-1524805444758-089113d48a6d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" class="product-image">
            <div>
              <div style="font-weight: 600;">Fones Bluetooth Pro</div>
              <div style="font-size: 14px; color: var(--secondary);">#PROD-004</div>
            </div>
          </td>
          <td>649 MT</td>
          <td>
            <span class="stock-indicator stock-high">25 em estoque</span>
          </td>
          <td>Tecnologia</td>
          <td>Marca X</td>
          <td><span style="color: var(--success); font-weight: 500;">Ativo</span></td>
          <td>
            <div class="actions">
              <button class="action-btn edit-btn">
                <i class="fas fa-edit"></i>
              </button>
              <button class="action-btn delete-btn">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <div style="color: var(--secondary);">
      Mostrando 1-4 de 125 produtos
    </div>
    <div style="display: flex; gap: 10px;">
      <button class="btn btn-secondary">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button class="btn btn-primary">1</button>
      <button class="btn btn-secondary">2</button>
      <button class="btn btn-secondary">3</button>
      <span style="padding: 10px;">...</span>
      <button class="btn btn-secondary">12</button>
      <button class="btn btn-secondary">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
  </div>

  <!-- Product Form -->
  <div class="form-container">
    <div class="form-title">
      <i class="fas fa-edit"></i>
      <h2>Criar / Editar Produto</h2>
    </div>
    
    <form method="POST" enctype="multipart/form-data">
      <div class="form-grid">
        <div>
          <div class="form-group">
            <label for="nome">Nome do Produto *</label>
            <input type="text" id="nome" name="nome" placeholder="Ex: Camiseta Azul Premium" required />
          </div>
          
          <div class="form-group">
            <label for="descricao">Descrição do Produto</label>
            <textarea id="descricao" name="descricao" rows="4" placeholder="Descrição detalhada do produto..."></textarea>
          </div>
          
          <div class="form-group">
            <label for="preco">Preço (MT) *</label>
            <input type="number" id="preco" name="preco" placeholder="Ex: 850" required />
          </div>
          
          <div class="form-group">
            <label for="estoque">Quantidade em Estoque *</label>
            <input type="number" id="estoque" name="estoque" placeholder="Ex: 15" required />
          </div>
        </div>
        
        <div>
          <div class="form-group">
            <label for="categoria">Categoria *</label>
            <select id="categoria" name="categoria" required>
              <option value="">Selecione uma categoria</option>
              <option value="roupas">Roupas</option>
              <option value="tecnologia">Tecnologia</option>
              <option value="calcados">Calçados</option>
              <option value="acessorios">Acessórios</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="marca">Marca *</label>
            <select id="marca" name="marca" required>
              <option value="">Selecione uma marca</option>
              <option value="marca_x">Marca X</option>
              <option value="marca_y">Marca Y</option>
              <option value="marca_z">Marca Z</option>
            </select>
          </div>
          
          <div class="form-group">
            <label>Variações</label>
            <div class="variations-container">
              <div class="variation-row">
                <input type="text" name="tamanho[]" placeholder="Tamanho (ex: M, G)" />
                <input type="text" name="cor[]" placeholder="Cor (ex: Azul, Preto)" />
              </div>
              <div class="variation-row">
                <input type="text" name="tamanho[]" placeholder="Tamanho (ex: M, G)" />
                <input type="text" name="cor[]" placeholder="Cor (ex: Azul, Preto)" />
              </div>
              <button type="button" class="add-variation">
                <i class="fas fa-plus"></i> Adicionar Variação
              </button>
            </div>
          </div>
          
          <div class="form-group">
            <label>Status do Produto</label>
            <select name="status">
              <option value="ativo">Ativo</option>
              <option value="inativo">Inativo</option>
              <option value="rascunho">Rascunho</option>
            </select>
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <label>Imagens do Produto *</label>
        <div class="image-upload" id="imageUpload">
          <i class="fas fa-cloud-upload-alt"></i>
          <p>Arraste e solte imagens aqui</p>
          <span>ou</span>
          <input type="file" name="imagem[]" multiple accept="image/*" style="display: none;" id="fileInput" />
          <button type="button" class="btn btn-secondary" onclick="document.getElementById('fileInput').click()">
            Selecionar arquivos
          </button>
        </div>
        
        <div class="image-preview" id="imagePreview">
          <div class="preview-item">
            <img src="https://images.unsplash.com/photo-1523381294911-8d3cead13475?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80">
            <div class="remove-image">
              <i class="fas fa-times"></i>
            </div>
          </div>
          <div class="preview-item">
            <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80">
            <div class="remove-image">
              <i class="fas fa-times"></i>
            </div>
          </div>
        </div>
      </div>
      
      <button type="submit" class="form-submit">
        <i class="fas fa-save"></i> Salvar Produto
      </button>
    </form>
  </div>
</div>

<script>
  // Function to handle image previews
  document.getElementById('fileInput').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    if (this.files && this.files.length > 0) {
      for (let i = 0; i < this.files.length; i++) {
        const file = this.files[i];
        const reader = new FileReader();
        
        reader.onload = function(e) {
          const previewItem = document.createElement('div');
          previewItem.className = 'preview-item';
          
          const img = document.createElement('img');
          img.src = e.target.result;
          
          const removeBtn = document.createElement('div');
          removeBtn.className = 'remove-image';
          removeBtn.innerHTML = '<i class="fas fa-times"></i>';
          removeBtn.onclick = function() {
            previewItem.remove();
          };
          
          previewItem.appendChild(img);
          previewItem.appendChild(removeBtn);
          preview.appendChild(previewItem);
        };
        
        reader.readAsDataURL(file);
      }
    }
  });

  // Add variation row
  document.querySelector('.add-variation').addEventListener('click', function() {
    const container = this.parentElement;
    const newRow = document.createElement('div');
    newRow.className = 'variation-row';
    newRow.innerHTML = `
      <input type="text" name="tamanho[]" placeholder="Tamanho (ex: M, G)" />
      <input type="text" name="cor[]" placeholder="Cor (ex: Azul, Preto)" />
      <button type="button" class="delete-btn" style="width: 36px; height: 36px; padding: 0;">
        <i class="fas fa-trash"></i>
      </button>
    `;
    
    // Add remove functionality to new delete button
    newRow.querySelector('.delete-btn').addEventListener('click', function() {
      newRow.remove();
    });
    
    container.insertBefore(newRow, this);
  });

  // Add remove functionality to existing delete buttons
  document.querySelectorAll('.variation-row .delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      this.parentElement.remove();
    });
  });

  // Add remove functionality to existing preview images
  document.querySelectorAll('.preview-item .remove-image').forEach(btn => {
    btn.addEventListener('click', function() {
      this.parentElement.remove();
    });
  });
</script>
</body>
</html>