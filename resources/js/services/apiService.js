const BASE_URL = "http://127.0.0.1/api";

async function makeApiRequest(endpoint, method = "GET", data = null) {
    const url = `${BASE_URL}/${endpoint}`;

    const headers = {
        "Content-Type": "application/json",
    };

    // Retrieve token from localStorage
    const token = localStorage.getItem('jwt_token');

    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }

    const options = {
        method,
        headers,
    };

    if (data !== null) {
        options.body = JSON.stringify(data);
    }

    try {
        const response = await fetch(url, options);

        if (!response.ok) {
            throw new Error(`Request failed with status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        throw new Error(`Error making API request: ${error.message}`);
    }
}

export { makeApiRequest };
