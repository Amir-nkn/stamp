{{ include('layouts/header.php', {title: 'UsersList'}) }}
{% set privileges = {1: 'SuperAdmin', 2: 'Admin', 3: 'User'} %}
<div class="stamp-card">
    <h2>Edit User</h2>

    <form action="{{ base }}/user/edit" method="post" class="form-container">

        <input type="hidden" name="id" value="{{ user.id }}">

        <label>Name:
            <input type="text" name="name" value="{{ user.name | default('') }}" required class="input-field">
        </label>
        {% if errors.name is defined %}
            <span class="error">{{ errors.name }}</span>
        {% endif %}

        <label>Email address:
            <input type="text" name="email" value="{{ user.email | default('') }}" required class="input-field">
        </label>
        {% if errors.email is defined %}
            <span class="error">{{ errors.email }}</span>
        {% endif %}

        <label>Password:
            <input type="password" name="password" class="input-field">
        </label>
        {% if errors.password is defined %}
            <span class="error">{{ errors.password }}</span>
        {% endif %}

        <label>Privilege:
            <select name="privilege_id" required class="input-field">
                <option value="">Select a privilege</option>
                {% for id, name in privileges %}
                    <option value="{{ id }}"
                        {% if user.privilege_id is defined and user.privilege_id == id %}selected{% endif %}>
                        {{ name }}
                    </option>
                {% endfor %}
            </select>
        </label>

        <input type="submit" value="Update" class="btn">
    </form>

    <a href="{{ base }}/user" class="btn back">Back to users</a>
</div>


{{ include('layouts/footer.php')}}