<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stampe</title>
 
    <link rel="stylesheet" href="{{asset}}/css/main.css">
</head>
<body>
<nav class="custom-navbar">
  <div class="navbar-container">
    <!-- <div class="logo">🖋️ Stampee</div> -->
    <ul class="nav-links">
      <li><a href="{{ base }}">Accueil</a></li>

      {% if session.privilege_id == 1 %}
        <li><a href="{{base}}/user">User List</a></li>
        <li><a href="{{base}}/logs">Logs</a></li>
      {% endif %}

      {% if session.user_name is defined %}
        <li><a href="{{base}}/logout">Logout</a></li>
      {% else %}
        <li><a href="{{base}}/login">Login</a></li>
        <li><a href="{{base}}/user/create">SignUp</a></li>
      {% endif %}
    </ul>

    {% if session.user_name is defined %}
      <div class="user-box">Bienvenue, {{session.user_name}}</div>
    {% endif %}
  </div>
</nav>


</body>


