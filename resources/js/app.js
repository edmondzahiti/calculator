import {createApp} from 'vue';
import {createRouter, createWebHistory} from 'vue-router';
import Calculator from './components/Calculator/Calculator.vue';
import Login from './components/Auth/Login.vue';

const app = createApp({
    data() {
        return {
            isLoggedIn: localStorage.getItem('jwt_token') !== null,
        };
    },
    methods: {
        logout() {
            localStorage.removeItem('jwt_token');
            this.isLoggedIn = false;
            this.$router.push({name: 'login'});
        },
    },
});

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'calculator',
            component: Calculator,
            meta: {requiresAuth: true},
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/logout',
            name: 'logout',
            beforeEnter: (to, from, next) => {
                localStorage.removeItem('jwt_token');
                next({name: 'login'});
            },
        },
    ],
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('jwt_token');

    if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
        next({name: 'login'});
    } else {
        next();
    }
});


app.use(router);
app.mount('#app');

