<template>
    <div className="login-container">
        <h2>Login</h2>
        <form @submit.prevent="login" class="login-form">
            <label htmlFor="email">Email:</label>
            <input v-model="email" type="text" id="email" className="login-input" required>
            <br>
            <label htmlFor="password">Password:</label>
            <input v-model="password" type="password" id="password" className="login-input" required>
            <br>
            <button type="submit" className="login-button">Login</button>
        </form>
    </div>
</template>

<style scoped>
.login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
}

.login-input {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}
</style>

<script>
import Login from "./Login";

export default Login;

</script>
