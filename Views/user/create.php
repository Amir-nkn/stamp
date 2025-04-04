{{ include('layouts/header.php', {title: 'Registration'}) }}
{% set privileges = {1: 'SuperAdmin', 2: 'Admin', 3: 'User'} %}

<div class="stamp-card">
    <h2>Add New User</h2>

    <form action="{{ BASE }}/user/store" method="post">

        <label>Name:
            <input type="text" name="name" value="{{ user.name ?? '' }}" required class="input-field">
        </label>
        {% if errors.name is not empty %}
            <span class="error">{{ errors.name }}</span>
        {% endif %}

        <label>Email address:
            <input type="text" name="email" value="{{ user.email ?? '' }}" required class="input-field">
        </label>
        {% if errors.email is not empty %}
            <span class="error">{{ errors.email }}</span>
        {% endif %}

        <label>Password:
            <input type="password" name="password" class="input-field">
        </label>
        {% if errors.password is not empty %}
            <span class="error">{{ errors.password }}</span>
        {% endif %}

        <label>Privilege:
            <select name="privilege_id" required>
                <option value="">Select a privilege</option>
                {% for id, name in privileges %}
                    <option value="{{ id }}" {% if user.privilege_id is defined and user.privilege_id == id %}selected{% endif %}>
                        {{ name }}
                    </option>
                {% endfor %}
            </select>
        </label>

        <input type="submit" value="Save" class="btn">
        <a href="{{ BASE }}" class="btn back">Back to main</a>
    </form>
</div>

{{ include('layouts/footer.php') }}
