{{ include('layouts/stampheader.php', { title: 'Registration' }) }}
<main>
            <!-- Section du titre principal -->
            <header class="titre-principal">
                <h2>Nouvellement répertorié</h2>
                <p>Découvrez notre collection de timbres rares et uniques,
                    parfaits pour les collectionneurs et passionnés.
                </p>
            </header>

            <div class="grille-filtre">
         <!-- Début de la grille de filtre -->
            <!-- Section des filtres -->
            <div class="filtre">
                <!-- Barre latérale pour les options de filtre -->
                <aside class="barre-laterale">
                    <div class="conteneur-filtre">
                        <div class="en-tête-barre-laterale">Filtrer les timbres</div>
                        <!-- Conteneur de la plage d'années -->
                        <div class="element-filtre">
                            <div class="titre-filtre">Filtrer par Année:</div>
                            <div class="conteneur-plage">
                                <span>1880</span>
                                <input id="annee" type="range" min="1880" max="2025" value="2000" oninput="valeurAnnee.value = annee.value" aria-label="anne">
                                <output id="valeurAnnee">2000</output>
                            </div>
                        </div>
                        
                        
                     
                        <!-- Pays d'origine filter -->
                        <div class="element-filtre">
                            <div class="titre-filtre">Pays d'origine:</div>
                            <div class="conteneur-selection">
                                <label for="country-select">Choisir</label>
                                <select id="country-select">
                                    <option>France</option>
                                    <option>USA</option>
                                    <option>Japon</option>
                                </select>
                            </div>
                        </div>

                        <!-- Catégories filter -->
                        <div class="element-filtre">
                            <div class="titre-filtre">Catégories:</div>
                            <ul>
                                <li><input type="checkbox" id="rare"> <label for="rare">Timbres rares</label></li>
                                <li><input type="checkbox" id="old"> <label for="old">Timbres anciens</label></li>
                            </ul>
                        </div>

                        <div class="element-filtre">
                            <label for="Prix" class="titre-filtre">Filtrer par Prix:</label>
                            <div class="conteneur-plage">
                                <span>$1</span>
                                <input id="Prix" type="range" min="1" max="1000" value="500" oninput="valeurPrix.value = Prix.value" aria-label="prix">
                                <output id="valeurPrix">500</output>
                            </div>
                        </div>
                        
                        <!-- Condition du timbre filter -->
                        <div class="element-filtre">
                            <div class="titre-filtre">Condition du timbre:</div>
                            <ul>
                                <li><input type="checkbox" id="new"> <label for="new">Neuf</label></li>
                                <li><input type="checkbox" id="used"> <label for="used">Usé</label></li>
                            </ul>
                        </div>

                        <!-- Popularité filter -->
                        <div class="element-filtre">
                            <div class="titre-filtre">Popularité:</div>
                            <ul>
                                <li><input type="checkbox" id="popular"> <label for="popular">Très populaire</label>
                                </li>
                                <li><input type="checkbox" id="newarrival"> <label for="newarrival">Nouveauté</label>
                                </li>
                            </ul>
                        </div>



                        <div class="element-filtre">
                            <div class="titre-filtre">couleurs:</div>
                            <div class="conteneur-selection">
                                <label for="country-select">Choisir</label>
                                <select id="country-select">
                                    <option>Rouge</option>
                                    <option>Bleu</option>
                                    <option>Jaune</option>
                                    <option>Vert</option>
                                    <option>Orange</option>
                                    <option>Violet</option>
                                    <option>Rose</option>
                                    <option>Noir</option>
                                    <option>Blanc</option>
                                    <option>Gris</option>
                                    <option>Marron</option>
                                    <option>Beige</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- Début de la section du contenu principal -->
                <div id="contenu_principal">
                    <!-- Début de la grille des cartes de timbres -->
                    <div class="grille">
                        <article class="carte">
                            <!-- Image du timbre -->
                            <img src="{{asset}}/img/stamp/canada-stamp-75ii-queen-victoria-1-1898.webp " loading="lazy" class="grille-img"
                                alt="stamp-1">
                            <!-- Informations d'identification du timbre -->
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#vt33c</span>
                                </p>
                                <!-- Titre du timbre avec lien vers la page de détails -->
                                <h3><a href="details.html">Timbre du Canada #75ii - Reine Victoria (1898) 1¢ Bleu Vert</a></h3>

                            </div>
                            <!-- Informations secondaires : prix et autres détails -->
                            <div class="identification-secondaire">
                                <!-- Affichage du prix -->
                                <p class="Prix">CAD $104.95</p>
                                <p class="info">
                                    <!-- Informations complémentaires (durée, nombre d'offres, etc.) -->
                                    <span>1jour 15h | 20 offre</span>

                                </p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/9b115a9ad35178487dd267ea2f189bda-800.webp"  loading="lazy" class="grille-img"
                                alt="stamp-2">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#ty90</span>
                                </p>
                                <h3><a href="">#O65 Mint OG, F-VF (CV $550) Joseph Luft monarque régnant le plus
                                        longtemps s vsdf gfg</a>
                                </h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $289.67</p>
                                <p class="info">
                                    <span>4jour |25 offre</span>
                                    <span class="vert">Livraison gratuite </span>
                                </p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/975de27e9d9041c029bd5e54d72c6bdf-800.webp" loading="lazy" class="grille-img"
                                alt="stamp-3">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#c1d1</span>
                                </p>

                                <h3><a href="">USA #2889a XF-SUPERB OG NH, Imperf Pair, joliment centré xdfgbxd!</a>
                                </h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $490.95</p>
                                <p class="info">

                                    <span class="vert">Livraison gratuite </span>
                                </p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/c4b3bb8495baadf07fc6e93fb0af4a00-800.webp" loading="lazy" class="grille-img"
                                alt="stamp-4">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#33c</span>
                                </p>
                                <h3><a href="">#219/#284/#287 1890-1898 1c-$1 Presque une série complète fthbdnrtubhd
                                    </a></h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $104.95</p>
                                <p class="info">
                                    <span>18 h 29 | </span>
                                </p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/pexels-brettjordan-7462696.webp" loading="lazy" class="grille-img" alt="stamp-5">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#gh8y7</span>
                                </p>
                                <h3><a href="">29v MENTHE 15c GRIS GRAND PAPIER REINE BOTHWELL ngjngyjn</a></h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $59.95</p>
                                <p class="info">
                                    <span>19h |</span>
                                    <span class="rouge">Seulment 6 en stock</span>
                                </p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/f11012bc2e30e36f54ffb86f7f2a5838-800.webp" loading="lazy" class="grille-img"
                                alt="stamp-6">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#n2343</span>
                                </p>
                                <h3><a href="">Canada# 1639 Victorian Order of Nurses 45c 1997 Mint NH bfgjnfgnh</a>
                                </h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $104.95</p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/pexels-sanlad-11860586.webp" class="grille-img" loading="lazy" alt="stamp-7">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#li45</span>
                                </p>
                                <h3><a href="">TOGO 2019 PAPILLONS LOT DE DEUX FEUILLES NEUF JAMAIS ARTICULÉ
                                        mhjkujkgh</a></h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $87.90</p>
                                <p class="info">
                                    <span>2jour|10 offre</span>

                                </p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/pexels-sanlad-11947691.webp" class="grille-img" loading="lazy" alt="stamp-8">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#m43r</span>
                                </p>
                                <h3><a href="">TOGO 2019 PAPILLONS LOT DE DEUX FEUILLES NEUF JAMAIS ngjk ghn</a></h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $100</p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/9f38dba2549fb76a0bb80f40576c283a-800.webp" loading="lazy" class="grille-img"
                                alt="stamp-9">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#t5676</span>
                                </p>
                                <h3><a href="">Niuafo'ou 2015, Elizabeth, monarque régnant le plus longtemps bfgjgyu
                                        fgbgf</a></h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $57</p>

                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/565c3dbb21a1bb927bc5cbb05acbf83c-800.webp" loading="lazy" class="grille-img"
                                alt="stamp-10">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#i9090</span>
                                </p>
                                <h3><a href="">LOT DE COLLECTION 17590 LEGION ALLEMANDE EN LIBYE MNH bff dgdfgf d</a>
                                </h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $55.00</p>
                                <p class="info">
                                    <span>10jour |20 offre</span>

                                </p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/38f44430c1c3b2e77df24928e8e89dd0-800.webp" loading="lazy" class="grille-img"
                                alt="stamp-11">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#jj45</span>
                                </p>
                                <h3><a href="">Numéro de journal américain PR59 inutilisé LH F-VF-GT-RYT #4357 cvbdfvxc
                                    </a></h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $561.00</p>
                                <p class="info"><span>1jour 15h|20 offre</span>
                                    <span class="rouge">Seulment 4 en stock</span>
                                </p>
                            </div>

                        </article>
                        <article class="carte">
                            <img src="{{asset}}/img/stamp/cbe10ea9fbdb690bd3f41703359c4b80-800.webp" loading="lazy" class="grille-img"
                                alt="stamp-12">
                            <div>
                                <p class="identification">
                                    <span>code d'identification</span>
                                    <span>#fh43</span>
                                </p>
                                <h3><a href="">#287 Mint NH, VF, Bloc de 4, quelques tonifiants (CV 1 320$)
                                        gfgfdbdfgdf</a></h3>
                            </div>
                            <div class="identification-secondaire">
                                <p class="Prix">CAD $100</p>
                                <p class="info"><span>30 jours | </span></p>
                            </div>
                            <!-- Fin de la grille des cartes -->


                        </article>
                    </div>
                    <!-- Début de la section de pagination -->
                    <div class="pagination">
                        <a href="#" class="prev disabled">‹</a>
                        <a href="#" class="page active">1</a>
                        <a href="#" class="page">2</a>
                        <a href="#" class="page">3</a>
                        <a href="#" class="page">4</a>
                        <a href="#" class="page">5</a>
                        <a href="#" class="page">6</a>
                        <a href="#" class="page">7</a>
                        <a href="#" class="page">8</a>
                        <a href="#" class="next">›</a>
                    </div>
                    <!-- Fin de la section de pagination -->
                </div>

            </div>

            <!-- Fin du contenu principal -->
        </div>
        <!-- Fin de la grille de filtre-->

        <!-- 
Section regroupant les dernières nouvelles de la philatélie. 
Chaque article présente une image, un titre, un résumé et un lien pour accéder aux détails de l'actualité.
-->
        <section class="section-nouvelles">
            <h3>Dernières nouvelles de la philatélie</h3>
            <div class="conteneur-nouvelles">
                <article class="element-nouvelle">
                    <img src="{{asset}}/img/stamp/41515-de66a8b1ae61a3d634a65bf10b5a0df1c105c06d-story_inline_image.png"
                    loading="lazy" alt="Timbre rare vendu">
                    <div class="contenu-nouvelle">
                        <h4>Un timbre rare vendu pour 1,2 million d'euros</h4>
                        <p>Un collectionneur a récemment acquis un timbre extrêmement rare lors d'une vente aux
                            enchères.</p>
                        <a href="#">Lire plus</a>
                    </div>
                </article>
                <article class="element-nouvelle">
                    <img src="{{asset}}/img/stamp/canada-stamp-1-beaver-3d-1851-70.webp" loading="lazy" alt="Histoire du timbre">
                    <div class="contenu-nouvelle">
                        <h4>L’histoire fascinante des premiers timbres-poste</h4>
                        <p>Découvrez comment les premiers timbres ont révolutionné le système postal mondial.</p>
                        <a href="#">Lire plus</a>
                    </div>
                </article>
                <article class="element-nouvelle">
                    <img src="{{asset}}/img/stamp/Expo.webp" loading="lazy" alt="Exposition">
                    <div class="contenu-nouvelle">
                        <h4>Exposition philatélique 2025 : ce qu'il faut savoir</h4>
                        <p>Le salon international de la philatélie arrive bientôt ! Voici tout ce qu'il faut savoir.</p>
                        <a href="#">Lire plus</a>
                    </div>
                </article>
            </div>
        </section>

        <!-- 
Section "Meilleurs vendeurs du mois" :
Cette section présente sous forme de cartes les vendeurs les plus performants du mois.
Chaque carte (contenu-vendeur) affiche l'image du vendeur, son nom, le nombre de timbres vendus, 
une note sous forme d'étoiles avec son évaluation, des icônes de réseaux sociaux et un bouton "En savoir+".
-->
        <section class="meilleurs-vendeurs">
            <h4>Meilleurs vendeurs du mois</h4>
            <div class="cartes-vendeurs">
                <div class="contenu-vendeur">
                    <img src="{{asset}}/img/images.webp" loading="lazy" alt="Vendeur">
                    <h5>M.hérisson</h5>
                    <p>50 timbres vendus</p>
                    <div class="note">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        (100)
                    </div>
                    <div class="icônes-sociales">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                    <button class="bouton-vendeur">En savoir+</button>
                </div>

                <div class="contenu-vendeur">
                    <img src="{{asset}}/img/blue-circle-with-white-user_78370-4707.webp" loading="lazy" alt="Vendeur-1">
                    <h5>Marie Lefevre</h5>
                    <p>67 timbres vendus</p>
                    <div class="note">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        (4.7)
                    </div>
                    <div class="icônes-sociales">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                    <button class="bouton-vendeur">En savoir+</button>
                </div>

                <div class="contenu-vendeur">
                    <img src="{{asset}}/img/blue-circle-with-white-user_78370-4707.webp" loading="lazy" alt="Vendeur-2">
                    <h5>Antoine Girard</h5>
                    <p>40 timbres vendus</p>
                    <div class="note">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        (4.8)
                    </div>
                    <div class="icônes-sociales">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                    <button class="bouton-vendeur">En savoir+</button>
                </div>

                <div class="contenu-vendeur">
                    <img src="{{asset}}/img/blue-circle-with-white-user_78370-4707.webp" loading="lazy" alt="Vendeur-3">
                    <h5>David O. Buckley</h5>
                    <p>80 timbres vendus</p>
                    <div class="note">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        (4.6)
                    </div>
                    <div class="icônes-sociales">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                    <button class="bouton-vendeur">En savoir+</button>
                </div>
            </div>
        </section>


        <!-- Bouton de chat flottant pour l'assistance client -->
        <div class="chat-floating">
            <button id="chat-button">💬 Assistance</button>
        </div>

        <!-- 
Section "inscription-encheres" : 
Cette section permet aux utilisateurs de s'inscrire pour participer aux enchères.
Elle affiche un message d'invitation et un formulaire demandant le nom et l'adresse e-mail.
-->
        <section class="inscription-encheres">
            <div class="texte-inscription">
                <h5>Inscrivez-vous et participez aux enchères !</h5>
                <p>Rejoignez notre communauté de collectionneurs et enchérissez sur des timbres rares.</p>
            </div>
            <form id="formulaire-encheres">
                <input aria-label="votre nom" type="text" id="nom" placeholder="Votre nom" required>
                <input type="email" id="email" aria-label="Votre e-mail" placeholder="Votre e-mail" required>
                <button type="submit">S'inscrire maintenant</button>
            </form>
        </section>
    </main>



  
    <!-- 
Pied de page du site "Lord Stampee" :
Ce pied de page regroupe plusieurs sections importantes :
- Une section présentant le logo et une invitation à participer aux enchères, avec des liens pour s'inscrire et se connecter.
- Des sections "À propos" et "Acheter" listant des liens de navigation vers différentes pages et régions d'achat.
- Une section "Contactez-nous" affichant les coordonnées, y compris l'adresse, le téléphone, l'e-mail et les horaires d'ouverture.
- Un formulaire d'abonnement à la newsletter.
- Une section secondaire avec des icônes de réseaux sociaux et un message de copyright.
-->
<footer id="pied-de-page">
    <div class="conteneur-pied-de-page">
        <div class="section-pied-de-page logo-section">
            <div class="logo">    
                <a href="index.html"> <img src="{{asset}}/img/Logo.webp" alt="Logo-pied-de-page"></a>
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




</body>

</html>