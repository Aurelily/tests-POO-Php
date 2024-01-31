
<nav>
 
    <?php if($_SESSION): ?>
        <a href="index.php"><button>Accueil</button></a>
        <a href="shop.php"><button>La boutique</button></a>
        <a href="profile.php"><button>Mon profile</button></a>
        <a href="deconnexion.php"><button>Se déconnecter</button></a>
    <?php else: ?>
        <a href="index.php"><button>Accueil</button></a>
        <a href="shop.php"><button>La boutique</button></a>
        <a href="register.php"><button>S'enregistrer</button></a>
        <a href="login.php"><button>Se connecter</button></a>
    <?php endif ?>

</nav>