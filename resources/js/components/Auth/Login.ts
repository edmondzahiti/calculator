import {makeApiRequest} from "../../services/apiService";

export default {
    data() {
        return {
            email: '',
            password: '',
        };
    },
    methods: {
        async login() {
            try {
                const response = await makeApiRequest("login", "POST", {
                    email: this.email,
                    password: this.password,
                });

                const token = response.access_token;

                localStorage.setItem('jwt_token', token);

                this.$root.isLoggedIn = true;

                this.$router.push('/');

            } catch (error) {
                console.error('Login failed', error);
            }
        },
    },
};
