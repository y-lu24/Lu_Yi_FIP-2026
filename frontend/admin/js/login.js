const app = Vue.createApp({
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            loading: false,
            errorMessage: ''
        };
    },
    methods: {
        submitLogin() {
            this.loading = true;
            this.errorMessage = '';

            fetch('http://127.0.0.1:8000/api/admin/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(this.form)
            })
            .then(res => res.json())
            .then(data => {
                if (data.message === 'Logged in successfully') {
                    window.location.href = 'dashboard.html';
                } else {
                    this.errorMessage = data.message || 'Login failed.';
                }
            })
            .catch(err => {
                this.errorMessage = 'Something went wrong. Please try again later.';
            })
            .finally(() => {
                this.loading = false;
            });
        }
    }
})
.mount('#app');