<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Intelcom</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/warehouse_dashboard/login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/warehouse_dashboard/signup.php">Signup</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/warehouse_dashboard/logout.php">Logout</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Performance
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/warehouse_dashboard/performance_tracker.php">Driver Performance</a></li>
            <li><a class="dropdown-item" href="/warehouse_dashboard/warehouse_performance.php">Warehouse Performance</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>