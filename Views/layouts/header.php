<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stampe</title>
 
    <link rel="stylesheet" href="{{ASSET}}/css/main.css">
</head>
<body>
<nav class="custom-navbar">
  <div class="navbar-container">
    <!-- <div class="logo">🖋️ Stampee</div> -->
    <ul class="nav-links">
      <li><a href="{{ BASE }}">Accueil</a></li>

      {% if session.privilege_id == 1 %}
        <li><a href="{{BASE}}/user">User List</a></li>
        <li><a href="{{BASE}}/logs">Logs</a></li>
      {% endif %}

      {% if session.user_name is defined %}
        <li><a href="{{BASE}}/logout">Logout</a></li>
      {% else %}
        <li><a href="{{BASE}}/login">Login</a></li>
        <li><a href="{{BASE}}/user/create">SignUp</a></li>
      {% endif %}
    </ul>

    {% if session.user_name is defined %}
      <div class="user-box">Bienvenue, {{session.user_name}}</div>
    {% endif %}
  </div>
</nav>


</body>


