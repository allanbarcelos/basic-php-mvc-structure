<h2>Create Product</h2>
<form action="/product/create" method="post">
    <!-- change this form, adapt to create a product -->
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" require>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" require>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" require>
    </div>
    <div>
        <label for="role_id">Role:</label>
        <select name="role_id" id="role_id">
            <option value="1">Admin</option>
            <option value="3" selected>User</option>
        </select>
    </div>
    <div>
        <button type="submit">Create</button>
    </div>
</form>

<a href="/products">Back to Products List</a>