<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez Maquette-1 : une plateforme moderne pour les enchères de timbres rares et anciens.">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Nikki">
    <meta name="keywords" content="enchères, timbres rares, collection de timbres, philatélie, timbres anciens">
  
    <title>Maquette-1</title>
    <link rel="icon" href="data:,">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&family=PT+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&family=PT+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Feuilles de style CSS -->
    <link rel="stylesheet" href="{{asset}}/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" media="print" onload="this.onload=null;this.removeAttribute('media');">

    <!-- Fichiers JavaScript -->
    <script src="{{asset}}/js/accordion.js" type="module"></script>
    <script src="{{asset}}/js/main.js" type="module"></script>

</head>

<body>
    <header>
        <!-- Début des navigations -->
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="menu-burger" aria-label="Ouvrir le menu">
            <i class="fa-solid fa-bars"></i>
        </label>
  
     <div class="menu-container">
            <nav id="navigation-secondaire">
                <!-- Section du logo -->
                <div class="logo">    
                    <a href="index.php"><img src="{{asset}}/img/Logo.webp" alt="Logo-navigation"></a>
                </div>
                
                <!-- Barre de recherche -->
                <div class="barre-de-recherche">
                    <div class="conteneur-de-recherche">
                        <input aria-label="recherche" type="text" id="recherche-input" placeholder="Chercher Lord-stampee">
                    </div>
                    <button type="submit" class="bouton-de-recherche">Recherche</button>
                </div>

                <!-- Section des icônes -->
                <div class="section-icon">
                    <p>Bienvenue, {{ session['user_name'] ?? 'Guest' }}</p>

{% if session['privilege_id'] is defined and session['privilege_id'] == 1 %}
   <a href="{{base}}/login"       class="compte">Admin</a>
{% endif %}
{% if session['user_name'] is defined %}
   <a href="{{base}}/logout" class="compte">Log Out</a>
{% else %}
   <a href="{{base}}/login"       class="compte">Mon compte</a>
   <a href="{{base}}/user/create" class="compte">SginUp</a>
{% endif %}

                   <div class="devise" id="devise-selector">
                        <span><i class="fa-solid fa-dollar-sign"></i> CAD</span>
                        <ul class="devise-deroulant" id="devise-deroulant">
                            <li><i class="fa-solid fa-dollar-sign"></i> CAD</li>
                            <li><i class="fa-solid fa-dollar-sign"></i> USD</li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Navigation principale -->
            <nav id="navigation-principal">
                <ul>
                    <li><a href="">Enchères</a></li>
                    <li><a href="">À propos</a></li>
                    <li class="menu-deroulant">
                        <a class="gachete" href="#">Blog/Actualités</a>
                        <ul class="contenu-deroulant">
                            <li><a href="#">Nouvelles du marché des timbres</a></li>
                            <li><a href="#">Conseils pour les collectionneurs</a></li>
                        </ul>
                    </li>
                    <li class="menu-deroulant">
                        <a class="gachete" href="#">Compte</a>
                        <ul class="contenu-deroulant">
                            <li><a href="#">Connexion</a></li>
                            <li><a href="#">Inscription</a></li>
                            <li><a href="#">Profil</a></li>
                            <li><a href="">Mes enchères</a></li>
                            <li><a href="">Historique des transactions</a></li>
                            <li><a href="">Notifications</a></li>
                            <li><a href="">Paiement sécurisé</a></li>
                            <li><a href="">Favoris</a></li>
                        </ul>
                    </li>
                    <li class="menu-deroulant">
                        <a class="gachete" href="#">Contact</a>
                        <ul class="contenu-deroulant">
                            <li><a href="#">Aide/FAQ</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="contenu-sur-image">
        <img src="{{asset}}/img/lord.webp" alt="lord">
        <div>
            <h1>Lord-stampee</h1>
            <p>Lord Stampee est une plateforme d'enchères pour timbres uniques et personnalisés. Participez pour acquérir des timbres exclusifs pour votre collection !</p>
            <a href="" class="bouton">
                <span>En savoir plus sur Lord</span>
                <i>
                    <svg width="80" height="80" viewBox="0 0 64 64" fill="gold" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22L20 42L32 30L44 42L52 22L40 36L32 24L24 36L12 22Z" stroke="black" stroke-width="2" fill="gold" />
                        <circle cx="12" cy="22" r="3" fill="black" />
                        <circle cx="52" cy="22" r="3" fill="black" />
                        <circle cx="32" cy="10" r="4" fill="black" />
                        <circle cx="24" cy="36" r="3" fill="black" />
                        <circle cx="40" cy="36" r="3" fill="black" />
                        <rect x="16" y="42" width="32" height="6" fill="black" />
                    </svg>
                </i>
            </a>
        </div>
    </section>

    <div class="barre-stats">
        <div class="element-stat">
            <span class="chiffre-stat">120</span>
            <span class="libelle-stat"><a href="#"><i class="fas fa-arrow-right"></i> Enchères actives</a></span>
        </div>
        <div class="element-stat">
            <span class="chiffre-stat">3540</span>
            <span class="libelle-stat"><a href="#"><i class="fas fa-arrow-right"></i> Utilisateurs actifs</a></span>
        </div>
        <div class="element-stat">
            <span class="chiffre-stat">2500 $</span>
            <span class="libelle-stat"><a href="#"><i class="fas fa-arrow-right"></i> Offre la plus élevée aujourd'hui</a></span>
        </div>
        <div class="element-stat">
            <span class="chiffre-stat">100 $</span>
            <span class="libelle-stat"><a href="#"><i class="fas fa-arrow-right"></i> Prix moyen des ventes</a></span>
        </div>
    </div>
</body>
</html>
