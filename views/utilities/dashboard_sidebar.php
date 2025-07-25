<h1 class="dashboard_title"><?php echo isset($title) ? $title : "Dashboard"?></h1>

<aside class="sidebar">
      <div class="profile">
        <div class="avatar">
            <i class="fa-solid fa-user"></i>
        </div>
          Bonjour <strong><?=$_SESSION['user_name']?></strong>
      </div>
      <nav class="menu">
          <div>
        <a href="user.php" class="<?php echo $_SERVER['REQUEST_URI'] == "/Projet-Stage-Initialization/views/user.php" ? 'active' : ''?>">Tableau de bord</a>
        <a href="commandes.php" class="<?php echo $_SERVER['REQUEST_URI'] == "/Projet-Stage-Initialization/views/commandes.php" ? 'active' : ''?>">Commandes</a>
          </div>
          <div>
        <a href="formulair.php" class="<?php echo $_SERVER['REQUEST_URI'] == "/Projet-Stage-Initialization/views/formulair.php" ? 'active' : ''?>">Détails du compte</a>
        <a href="/Projet-Stage-Initialization/controllers/logout.php">Se déconnecter</a>
          </div>
      </nav>
    </aside>
