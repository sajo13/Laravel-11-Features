<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
<div x-data="latestUsers" x-init="init()">
    <h1>Latest Users</h1>

    <div x-show="users.length > 0">
        <ul>
            <template x-for="user in users" :key="user.id">
                <li x-text="user.name"></li>
            </template>
        </ul>
    </div>

    <div x-show="users.length === 0">
        <p>No users available.</p>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('latestUsers', () => ({
            init() {
                this.fetchUsers();
                setInterval(this.fetchUsers, 5000); // Fetch new users every second
            },

            async fetchUsers() {
                try {
                    const response = await axios.get('/api/latest-users');
                    this.users = response.data; // Assuming the response is a list of users
                } catch (error) {
                    console.error("Error fetching users:", error);
                }
            },

            users: [], // Store users here
        }));
    });
</script>
</body>
</html>
