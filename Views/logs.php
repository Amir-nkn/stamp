{# Inclusion de l'en-tête de la page #}
{{ include('layouts/header.php') }}

<h2 class="logs-title">View Logs</h2>

<table class=" custom-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>IP Address</th>
            <th>Visit Time</th>
            <th>Username</th>
            <th>Page Visited</th>
        </tr>
    </thead>
    <tbody>
        {% for log in logs %}
        <tr>
            <td>{{ log.id }}</td>
            <td>{{ log.ip_address }}</td>
            <td>{{ log.visit_time }}</td>
            <td>{{ log.username }}</td>
            <td>{{ log.page_visited }}</td>
        </tr>
        {% endfor %}
    </tbody>
</table>

{# Inclusion du pied de page #}
{{ include('layouts/footer.php') }}