{{ include('layouts/header.php', {title: 'UsersList'}) }}
{% set privileges = {1: 'SuperAdmin', 2: 'Admin', 3: 'User'} %}

<div class="user-details-card">
    <h1>User Details</h1>

    <p><strong>Name:</strong> {{ user.name }}</p>
    <p><strong>Email:</strong> {{ user.email }}</p>
    <p><strong>Privilege:</strong> 
        {{ privileges[user.privilege_id] is defined ? privileges[user.privilege_id] : 'Unknown' }}
    </p>

    <div class="button-group">
        <a href="{{ BASE }}/user/edit?id={{ user.id }}" class="btn-edit">Edit</a>

        <form action="{{ BASE }}/user/delete" method="post" style="display:inline;">
            <input type="hidden" name="id" value="{{ user.id }}">
            <input type="submit" value="Delete" class="btn-edit red"
                   onclick="return confirm('Are you sure you want to delete this user?');">
        </form>
    </div>

    <a href="{{ BASE }}/user" class="btn back">Back to users</a>
</div>


{{ include('layouts/footer.php')}}