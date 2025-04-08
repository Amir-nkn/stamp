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
    
    {# Feuilles de style CSS #}
    <link rel="stylesheet" href="{{ASSET}}/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" media="print" onload="this.onload=null;this.removeAttribute('media');">

    {# Fichiers JavaScript #}
    <script src="{{ASSET}}/js/accordion.js" type="module"></script>
    <script src="{{ASSET}}/js/main.js" type="module"></script>

</head>

<body>
    <header>
        {# Début des navigations #}
        <input type="checkbox" id="menu-toggle">
        <label for="menu-toggle" class="menu-burger" aria-label="Ouvrir le menu">
            <i class="fa-solid fa-bars"></i>
        </label>
  
     <div class="menu-container">
            <nav id="navigation-secondaire">
                {# Section du logo #}
                <div class="logo">    
                <a href="{{ BASE }}/">
    <img src="{{ ASSET }}/img/Logo.webp" alt="Logo-navigation">
</a>

                </div>
                
                {# Barre de recherche #}
                <div class="barre-de-recherche">
                    <div class="conteneur-de-recherche">
                        <input aria-label="recherche" type="text" id="recherche-input" placeholder="Chercher Lord-stampee">
                    </div>
                    <button type="submit" class="bouton-de-recherche">Recherche</button>
                </div>

                {# Section des icônes #}
                <div class="section-icon">
                    <p>Bienvenue, {{ session['user_name'] ?? 'Guest' }}</p>

{% if session['privilege_id'] is defined and session['privilege_id'] == 1 %}
   <a href="{{BASE}}/login"       class="compte">Admin</a>
{% endif %}
{% if session['user_name'] is defined %}
   <a href="{{BASE}}/logout" class="compte">Log Out</a>
{% else %}
   <a href="{{BASE}}/login"       class="compte">Mon compte</a>
   <a href="{{BASE}}/user/create" class="compte">S'inscrire</a>
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

            {# Navigation principale #}
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
                        <a class="gachete" href="#">Vendre</a>
                        <ul class="contenu-deroulant">
                            <li><a href="{{BASE}}/stamp/create">Mettre un timbre en vente</a></li>
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


    {#  MAIN : Contient le produit en vente aux enchères #}
    <main>

        <article class="principal">
            <div class="titre-produit">
                <h1>{{ stamp.details }}</h1>
{#                <h1>Timbre du Canada #75ii - Reine Victoria (1898) 1¢ Bleu Vert</h1> #}
            </div>
            {#  Section d'affichage du timbre avec bouton "favoris" #}
            <div class="contenu">
                <aside class="aside">
                    <div class="vitrine-timbre">
                        
                        <button class="favoris-btn" aria-label="Ajouter-favoris">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 19" width="22" height="19"
                                fill="none">
                                <path class="heart-path" clip-rule="evenodd"
                                    d="M2.405 2.465a4.8 4.8 0 0 1 6.788 0l1.406 1.406 1.406-1.406a4.8 4.8 0 1 1 6.788 6.788l-8.194 8.194-8.194-8.194a4.8 4.8 0 0 1 0-6.788Z"
                                    stroke="black" stroke-width="2" stroke-linejoin="round" fill="none" />
                            </svg>
                        </button>

        <img src="{{ ASSET ~ '/img/stamp/' ~ stamp.image   }}" loading="lazy" class="images-secondaires" >

                        <div class="images-secondaires">
                            <label class="small-image-upload">
        <img src="{{ ASSET ~ '/img/stamp/' ~ stamp.image_1 }}" loading="lazy" class="images-secondaires" >
                            </label>
                            <label class="small-image-upload">
        <img src="{{ ASSET ~ '/img/stamp/' ~ stamp.image_2 }}" loading="lazy" class="images-secondaires" >
                            </label>
                            <label class="small-image-upload">
        <img src="{{ ASSET ~ '/img/stamp/' ~ stamp.image_3 }}" loading="lazy" class="images-secondaires" >
                            </label>
                        </div>
                    </div>
                    <div class="discription">
                        <p>Ce timbre rare est en enchère avec un prix de départ de CAD 104.95.</p>
                        <p>L'enchère se termine bientôt ⏳ Ne manquez pas votre chance de l'acquérir en plaçant votre
                            offre dès maintenant. 💰</p>
                    </div>

                    <div class="offre">
{% if session.user_name is defined %}
{% if message %}
    <div class="alert">{{ message }}</div>
{% endif %}

<form action="{{ BASE }}/stamp/newbid" method="POST" style="margin-top: 20px;">
    <input type="hidden" name="id" value="{{ stamp.id }}">
    <input type="number" name="amount" id="amount" value="{{ stamp.amount }}" min="1"  required style="width: 150px;">
    <input type="hidden" name="auction_id" value="{{ stamp.auction_id }}">
    <button type="submit">Votre offre</button>
    {% if stamp.amount> 0  %}
       <div class="alert">"You have Registerd your offer Before"</div>
    {% endif %}
</form>
{% endif %}
                    </div>

                    <div class="statistiques">
                        <span class="stat"><strong>24</strong> visites |</span>
                        <span class="stat"><strong>1</strong> suivi |</span>
                        <span class="stat"><strong>2</strong> offre</span>


                    </div>

                    <div class="infos-enchere">
                        <p class="prix-actuel">Prix actuel: CAD {{ stamp.price }}</p>
                        <p class="compteur">Fin de l'enchère dans: <span id="countdown">{{ stamp.end_date }}</span></p>
                        <p class="compteur">Days Remaining to END: <span id="countdown">{{ stamp.days_left }}</span></p>
                    </div>

                </aside>

                {# Détails et informations du produit #}
                 <custom-accordion>
                <section class="details">
                    <div class="accordion">
                        <div class="accordion-header">
                            <button class="accordion-btn">🔍 Détails</button>
                            <button class="accordion-btn">📜 Historique</button>
                            <button class="accordion-btn">💳 Paiement</button>
                        </div>

                        <div class="accordion-contenu">
            <div class="contenu contenu_information">
                     <h2>Détails de l'article</h2>
            <p><strong>Category:</strong> {{stamp.category_name }}</p>
            <p><strong>Country:</strong> {{stamp.country_name }}</p>
            <p><strong>Color:</strong> {{stamp.color_name }}</p>
            <p><strong>Condition:</strong> {{stamp.condition_name }}</p>
            <p><strong>Certified:</strong> {{stamp.certified }}</p>
            <p><strong>Creation Date:</strong> {{stamp.creation_date }}</p>
            <p><strong>Details:</strong> {{stamp.details }}</p>
            <p><strong>User Name:</strong> {{stamp.user_name }}</p>
            <p><strong>َAuction End Date:</strong> {{stamp.end_date }}</p>
            <p><strong>َAuction Base Price:</strong> {{stamp.base_price }}</p>
                            
            </div>

                            <div class="contenu contenu_historique">
                                <h2>Historique des offres</h2>
                                <ul>
{% if bids is not empty %}
   {% for bid in bids %}
      <p>User {{ bid.user_id }} Price {{ bid.amount }} Date {{ bid.bid_date|date("Y-m-d H:i") }}</p>
   {% endfor %}
{% else %}
   <p>No offer is registered.</p>
{% endif %}                               
                                </ul>
                            </div>

                            <div class="contenu contenu_paiment">
                                <h2>Informations de paiement</h2>
                                <p><strong>Vendeur:</strong> <a href="">Michelle</a></p>
                                <div class="paiement-icons">
                                    <i class="fa-brands fa-cc-paypal"></i>
                                    <i class="fa-brands fa-cc-visa"></i>
                                    <i class="fa-brands fa-cc-mastercard"></i>
                                    <i class="fa-brands fa-google-pay"></i>
                                </div>
                                <ul class="liste-securite">
                                    <li>
                                        <i class="fa-solid fa-shield-halved"></i> Achetez en sécurité sur Lord Stampee
                                    </li>
                                    <li class="vert">
                                        <i class="fa-solid fa-truck"></i> Livraison gratuite pour les achats de plus de250 CAD
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </section>
            </custom-accordion>
            </div>
        </article>

        <section class="bloc-temoignages">
            <h3>Avis des acheteurs</h3>
            <p class="note-avis">Les avis ci-dessous sont laissés par des acheteurs ayant remporté des enchères précédentes.</p>
            <div class="bloc">
                <div class="avis-enchere galerie">
                    <article class="commentaire vignette">
                        <h2 class="nom-utilisateur"><strong>Jean Dupont</strong> ⭐⭐⭐⭐⭐</h2>
                        <p class="texte-avis">"J'ai remporté cette enchère et je suis ravi de mon achat Le timbre était en parfait état et bien protégé."</p>
                        <span class="date-avis">Publié après la fin de l'enchère le 12 février 2025</span>
                    </article>
        
                    <article class="commentaire vignette">
                        <h2 class="nom-utilisateur"><strong>Sophie Martin</strong> ⭐⭐⭐⭐⭐</h2>
                        <p class="texte-avis">"Le timbre est exactement comme décrit. Expédition rapide et service client impeccable "</p>
                        <span class="date-avis">Publié après la fin de l'enchère le 11 février 2025</span>
                    </article>
        
                    <article class="commentaire vignette">
                        <h2 class="nom-utilisateur"><strong>Marie Durand</strong> ⭐⭐⭐⭐⭐</h2>
                        <p class="texte-avis">"Superbe expérience  L'emballage était soigné et la livraison rapide. Très satisfait."</p>
                        <span class="date-avis">Publié après la fin de l'enchère le 10 février 2025</span>
                    </article>
        
                    <article class="commentaire vignette">
                        <h2 class="nom-utilisateur"><strong>Claire Dubois</strong> ⭐⭐⭐⭐☆</h2>
                        <p class="texte-avis">"Très bon produit, mais la livraison a pris un peu plus de temps que prévu."</p>
                        <span class="date-avis">Publié après la fin de l'enchère le 9 février 2025</span>
                    </article>
        
                    <article class="commentaire vignette">
                        <h2 class="nom-utilisateur"><strong>Michel Leroy</strong> ⭐⭐⭐☆☆</h2>
                        <p class="texte-avis">"Le timbre était globalement en bon état, mais j'ai remarqué une légère imperfection sur un bord."</p>
                        <span class="date-avis">Publié après la fin de l'enchère le 8 février 2025</span>
                    </article>
                
                </div>
                <button class="ajouter-avis">Laisser un avis</button>
            </div>
        </section>



        {# Section affichant des timbres similaires en enchères #}
        <section class="galerie__contenu_principal">
            <div class="galerie__titre">
                <h3>Timbres similaires en enchères</h3>
            </div>
            <div class="galerie">
                <article class="vignette">
                    <img src="public/assets/img/stamp/38f44430c1c3b2e77df24928e8e89dd0-800.webp" class="images-secondaires"
                        alt="stamp-1">
                    <div>
                        <p class="identifiant">
                            <span>code d'identification</span>
                            <span>#jj45</span>
                        </p>
                        <h4><a href="">Numéro de journal américain PR59 inutilisé LH F-VF-GT-RYT</a></h4>
                    </div>
                    <div class="details-secondaires">
                        <p class="prix">CAD CAD 561.00</p>
                        <p class="details-secondaires-info">
                            <span>1jour 15h|20 offre</span>

                        </p>
                    </div>
                </article>

                <article class="vignette">
                    <img src="public/assets/img/stamp/9b115a9ad35178487dd267ea2f189bda-800.webp" class="images-secondaires"
                        alt="stamp-2">
                    <div>
                        <p class="identifiant">
                            <span>code d'identification</span>
                            <span>#ty90</span>
                        </p>
                        <h4><a href="">#O65 Mint OG, F-VF (CV CAD 550)</a></h4>
                    </div>
                    <div class="details-secondaires">
                        <p class="prix">CAD CAD 289.67</p>
                        <p class="details-secondaires-info">
                            <span>4jour |25 offre</span>
                            <span class="vert">Livraison gratuite </span>
                        </p>
                    </div>
                </article>

                <article class="vignette">
                    <img src="public/assets/img/stamp/975de27e9d9041c029bd5e54d72c6bdf-800.webp" class="images-secondaires"
                        alt="stamp-3">
                    <div>
                        <p class="identifiant">
                            <span>code d'identification</span>
                            <span>#c1d1</span>
                        </p>
                        <h4><a href="">USA #2889a XF-SUPERB </a></h4>
                    </div>
                    <div class="details-secondaires">
                        <p class="prix">CAD CAD 490.95</p>
                        <p class="details-secondaires-info">
                            <span class="vert">Livraison gratuite </span>
                        </p>
                    </div>
                </article>

                <article class="vignette">
                    <img src="public/assets/img/stamp/c4b3bb8495baadf07fc6e93fb0af4a00-800.webp" class="images-secondaires"
                        alt="stamp-4">
                    <div>
                        <p class="identifiant">
                            <span>code d'identification</span>
                            <span>#33c</span>
                        </p>
                        <h4><a href="">#219/#284/LEGION ALLEMANDE EN LIBYE</a></h4>
                    </div>
                    <div class="details-secondaires">
                        <p class="prix">CAD CAD 104.95</p>
                        <p class="details-secondaires-info">
                            <span>18 h 29 | </span>
                        </p>
                    </div>
                </article>

                <article class="vignette">
                    <img src="public/assets/img/stamp/cbe10ea9fbdb690bd3f41703359c4b80-800.webp" class="images-secondaires"
                        alt="stamp-5">
                    <div>
                        <p class="identifiant">
                            <span>code d'identification</span>
                            <span>#fh43</span>
                        </p>
                        <h4><a href="">#287 Mint NH, VF, Bloc de 4, quelques tonifiants </a></h4>
                    </div>
                    <div class="details-secondaires">
                        <p class="prix">CAD CAD 199.99</p>
                        <p class="details-secondaires-info">
                            <span>2 jours | 10 offre</span>

                        </p>
                    </div>
                </article>

            </div>
        </section>

    </main>


    <div class="chat-floating">
        <button id="chat-button">💬 Assistance</button>
    </div>

<footer id="pied-de-page">
    <div class="conteneur-pied-de-page">
        <div class="section-pied-de-page logo-section">
            <div class="logo">    
                <a href="index.html"> <img src="public/assets/img/Logo.webp" alt="Logo-pied-de-page"></a>
                 </div>
        </div>
      
            <div class="section-pied-de-page section-pied-page-compte">
                <h5>Participez aux enchères sur Lord Stampee :</h5>
                <p>Créez un compte et commencez à enchérir sur des timbres rares et de collection. Suivez vos
                    enchères
                    consultez l'historique des offres et recevez des alertes sur les nouvelles ventes aux enchères.
                </p>
                <a href="#">REGISTRE <span class="arrow">→</span></a><br>
                <a href="#">SE CONNECTER <span class="arrow">→</span></a>
            </div>
       



        <div class="section-pied-de-page">
            <h6>À propos :</h6>
            <ul>
                <li><a href="#">Lord Stampee</a></li>
                <li><a href="#">Notre collectionneurs</a></li>
                <li><a href="#">Enchères</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Compte</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class="section-pied-de-page">
            <h6>Acheter :</h6>
            <ul>
                <li><a href="#">États-Unis</a></li>
                <li><a href="#">Afrique</a></li>
                <li><a href="#">Asie</a></li>
                <li><a href="#">Australie et Océanie</a></li>
                <li><a href="#">Commonwealth britannique</a></li>
                <li><a href="#">Canada</a></li>
                <li><a href="#">Caraïbes</a></li>
                <li><a href="#">Europe</a></li>
            </ul>
        </div>

        <div class="section-pied-de-page">
            <h6>Contactez-nous :</h6><br>
            <p><strong>Adresse :</strong> 123 Main Street, Québec, Canada</p><br>
            <p><strong>Numéro de téléphone : </strong>+1 (416) 123-4567</p><br>
            <p><strong>Email :</strong> <a href="mailto:lordstampee@info.ca">lordstampee@info.ca</a></p><br>

            <h6>Heures d'ouverture :</h6>
            <p>Lundi à Vendredi : 9h00 - 18h00</p>
            <p>Samedi : 10h00 - 16h00</p>
            <p>Dimanche : Fermé</p>
        </div>
    </div>

    <div class="bulletin-d-information">
        <label for="newsletter-email">Abonnez-vous</label>
        <input type="email" id="newsletter-email" aria-label="courriel" placeholder="Entrez votre courriel">
        <button>Envoyer</button>
    </div>
    


    <div class="pied-de-page-secondaire">
        <div class="social-media">
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest"></i></a>
        </div>

        <div class="pied-de-page-bas">
            <p>Copyright © [2025] [Lord Stampee]. Tous droits réservés.</p>
        </div>
    </div>
</footer>

</body>

</html>