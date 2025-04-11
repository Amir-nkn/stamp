<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Découvrez Maquette-1 : une plateforme moderne pour les enchères de timbres rares et anciens.">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Nikki">
    <meta name="keywords" content="enchères, timbres rares, collection de timbres, philatélie, timbres anciens">
    
    <title>Détails du Timbre - Enchères</title>
    <link rel="icon" href="data:,">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&family=PT+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;700&family=PT+Sans:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- 📌 Feuilles de style CSS -->
    <link rel="stylesheet" href="{{ASSET}}/css/main.css">
    <link rel="stylesheet" href="{{ASSET}}/css/child.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" media="print" onload="this.onload=null;this.removeAttribute('media');">
    <!-- 📌 Fichiers JavaScript -->
    <script src="{{ASSET}}/js/accordion.js" type="module" ></script>
    <script src="{{ASSET}}/js/main.js" type="module" ></script>
</head>

<body>

    <div class="stamp-form">
        <form action="{{ BASE }}/stamp/store" method="POST" enctype="multipart/form-data">
            <!-- ID du timbre -->
            <label for="stamp_code">ID du timbre:</label>
            <input type="text" id="stamp_code" name="stamp_code" value="{{ stamp.stamp_code }}" required>
            {% if errors['stamp_code'] %}
                <div class="error">{{ errors['stamp_code'] }}</div>
            {% endif %}

            <!-- Détails -->
            <label for="details">Détails:</label>
            <textarea id="details" name="details" required>{{ stamp.details }}</textarea>
            {% if errors['details'] %}
                <div class="error">{{ errors['details'] }}</div>
            {% endif %}

            <!-- Prix -->
            <label for="price">Prix:</label>
            <input type="number" id="price" name="price" value="{{ stamp.price }}" required>
            {% if errors['price'] %}
                <div class="error">{{ errors['price'] }}</div>
            {% endif %}

            <!-- Certifié -->
            <label for="certified">Certifié:</label>
            <select id="certified" name="certified" required>
                <option value="1" {% if stamp.certified == 1 %}selected{% endif %}>Certifié</option>
                <option value="0" {% if stamp.certified == 0 %}selected{% endif %}>Non-certifié</option>
            </select>
            {% if errors['certified'] %}
                <div class="error">{{ errors['certified'] }}</div>
            {% endif %}

            <!-- Date de création -->
            <label for="creation_date">Date de création:</label>
            <input type="date" id="creation_date" name="creation_date" value="{{ stamp.creation_date }}" required>
            {% if errors['creation_date'] %}
                <div class="error">{{ errors['creation_date'] }}</div>
            {% endif %}

            <!-- Pays -->
            <label for="country_id">Pays:</label>
            <select id="country_id" name="country_id" required>
                {% for country in countries %}
                    <option value="{{ country.id }}" {% if stamp.country_id == country.id %}selected{% endif %}>{{ country.name }}</option>
                {% endfor %}
            </select>
            {% if errors['country_id'] %}
                <div class="error">{{ errors['country_id'] }}</div>
            {% endif %}

            <!-- Couleur -->
            <label for="color_id">Couleur:</label>
            <select id="color_id" name="color_id" required>
                {% for color in colors %}
                    <option value="{{ color.id }}" {% if stamp.color_id == color.id %}selected{% endif %}>{{ color.name }}</option>
                {% endfor %}
            </select>
            {% if errors['color_id'] %}
                <div class="error">{{ errors['color_id'] }}</div>
            {% endif %}

            <!-- Catégorie -->
            <label for="category_id">Catégorie:</label>
            <select id="category_id" name="category_id" required>
                {% for category in categories %}
                    <option value="{{ category.id }}" {% if stamp.category_id == category.id %}selected{% endif %}>{{ category.name }}</option>
                {% endfor %}
            </select>
            {% if errors['category_id'] %}
                <div class="error">{{ errors['category_id'] }}</div>
            {% endif %}

            <!-- Condition -->
            <label for="condition_id">Condition:</label>
            <select id="condition_id" name="condition_id" required>
                {% for condition in conditions %}
                    <option value="{{ condition.id }}" {% if stamp.condition_id == condition.id %}selected{% endif %}>{{ condition.name }}</option>
                {% endfor %}
            </select>
            {% if errors['condition_id'] %}
                <div class="error">{{ errors['condition_id'] }}</div>
            {% endif %}

            <!-- Utilisateur -->
            <label for="user_id">Utilisateur:</label>
            <select id="user_id" name="user_id" required>
                {% for user in users %}
                    <option value="{{ user.id }}" {% if stamp.user_id == user.id %}selected{% endif %}>{{ user.name }}</option>
                {% endfor %}
            </select>
            {% if errors['user_id'] %}
                <div class="error">{{ errors['user_id'] }}</div>
            {% endif %}

            <!-- Image principale -->
            <label for="image">Image principale:</label>
            <input type="file" id="image" name="image" value="{{ stamp.image }}" required>
            {% if errors['image'] %}
                <div class="error">{{ errors['image'] }}</div>
            {% endif %}

            <!-- Images supplémentaires -->
            <label for="image_1">Image supplémentaire 1:</label>
            <input type="file" id="image_1" name="image_1">
            <label for="image_2">Image supplémentaire 2:</label>
            <input type="file" id="image_2" name="image_2">
            <label for="image_3">Image supplémentaire 3:</label>
            <input type="file" id="image_3" name="image_3">

            <button class="stamp-btn" type="submit">Créer</button>
        </form>
    </div>

    <?php

    include 'footer.php';
    ?>
</body>
</html>
