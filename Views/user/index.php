{{ include('layouts/header.php', {title: 'UsersList'}) }}
{% set privileges = {1: 'SuperAdmin', 2: 'Admin', 3: 'User'} %}
<div>
    <h1 class="user-table-title">User List</h1>
</div>

<table class="custom-table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Privilege</th>
        <th>Actions</th>
    </tr>

    {% for user in users %}
        <tr>
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
                {{ privileges[user.privilege_id] is defined ? privileges[user.privilege_id] : 'Unknown' }}
            </td>
            <td>
                <a href="{{ BASE }}/user/show?id={{ user.id }}" class="btn">Show</a>
            </td>
        </tr>
    {% endfor %}
</table>

{{ include('layouts/footer.php')}}