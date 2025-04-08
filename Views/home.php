{{ include('layouts/stampheader.php', { title: 'Registration' }) }}
<main>


<header class="titre-principal">
                <h2>Nouvellement répertorié</h2>
                <p>Découvrez notre collection de timbres rares et uniques,
                    parfaits pour les collectionneurs et passionnés.
                </p>
            </header>
<div class="grille-filtre">
    <div class="filtre">
    <!-- Barre laterale pour les options de filtre -->


    <aside class="barre-laterale">
            <div class="conteneur-filtre">
                <div class="en-tête-barre-laterale">Filtrer les timbres</div>

            <!-- Filtrer par Annee -->
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


            <!-- Filtrer par Prix -->
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

    <!-- Section des timbres -->
    <div id="contenu_principal">

        <div class="grille">
            {% set stamps_count = stamps|length %}
            {% for i in 0..11 %}
                {% if i < stamps_count %}
                    {% set stamp = stamps[i] %}
                    <article class="carte">
                        <img src="{{ ASSET ~ '/img/stamp/' ~ stamp.image }}" loading="lazy" class="grille-img" alt="{{ stamp.name }}">
                        <div>
                            <p class="identification">
                                <span>code d'identification</span>
                                <span>#{{ stamp.stamp_code }}</span>
                            </p>
                            <h3><a href="{{BASE}}/stamp/show?id={{ stamp.id }}">{{ stamp.details }}</a></h3>
                        </div>
                        <div class="identification-secondaire">
                             <p class="Prix">CAD ${{ stamp.price }}</p>
                             <p class="info">
                             <span>{{ stamp.time_left }} | {{ stamp.offers }} offre</span>
                             </p>
                             <span style="display: inline;"><a href="{{BASE}}/stamp/edit?id={{ stamp.id }}">Edit Item</a></span>
                        </div>
                    </article>
                {% else %}
                    <article class="carte empty"></article>
                {% endif %}
            {% endfor %}
        </div>

<div class="pagination" id="pagination">
  
    {% if current_Page > 1 %}
        <a href="?page=1#pagination" class="first">⏮️ </a>
    {% else %}
        <a href="#" class="first disabled">⏮️</a>
    {% endif %}

 
    {% if current_Page > 1 %}
        <a href="?page={{ current_Page - 1 }}#pagination">⬅️</a>
    {% else %}
        <a href="#" class="prev disabled">⬅️</a>
    {% endif %}


    {% set max_buttons = 10 %}
    {% set half_buttons = max_buttons // 2 %}
    

    {% set start_page = current_Page - half_buttons %}
    {% if start_page < 1 %}
        {% set start_page = 1 %}
    {% endif %}

  
    {% set end_page = start_page + max_buttons - 1 %}
    {% if end_page > total_Pages %}
        {% set end_page = total_Pages %}
    {% endif %}

  
    {% if end_page - start_page < max_buttons - 1 %}
        {% set start_page = end_page - max_buttons + 1 %}
        {% if start_page < 1 %}
            {% set start_page = 1 %}
        {% endif %}
    {% endif %}

   
    {% for i in start_page..end_page %}
        <a href="?page={{ i }}#pagination" class="page{% if i == current_Page %} active{% endif %}">{{ i }}</a>
    {% endfor %}


    {% if current_Page < total_Pages %}
        <a href="?page={{ current_Page + 1 }}#pagination" >➡️</a>
    {% else %}
        <a href="#" class="next disabled">➡️</a>
    {% endif %}

 
    {% if current_Page < total_Pages %}
        <a href="?page={{ total_Pages }}#pagination" class="last">⏭️</a>
    {% else %}
        <a href="#" class="last disabled">⏭️</a>
    {% endif %}
</div>



</div>



</main>

{# Inclusion du pied de page #}
{{ include('layouts/footer.php') }}