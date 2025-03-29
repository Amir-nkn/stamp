{{ include('layouts/header.php', {title:'User Login'}) }}
{% if session['privilege_id'] is not defined or session['privilege_id'] != 1 %}
    <div class="login-form">
            {% if errors is defined %}
                <span class="error">
                    <ul>
                    {% for error in errors %}
                        <li>{{error}}</li>
                    {% endfor %}
                    </ul>
                </span>
            {% endif %}
        <form method="post">
            <h2>Login</h2>
            <label>Username
                <input type="email" name="username" value="{{user.username}}">
            </label>
            <label>Password
                <input type="password" name="password" >
            </label>
            <input type="submit" value="Login"class="btn">

        </form>
        

        </div>
{% endif %}
   

    