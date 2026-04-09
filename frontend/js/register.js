const app = Vue.createApp({
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            loading: false,
            errors: {},
            responseMessage: ''
        };
    },
    methods: {
        submitRegister() {
            this.loading = true;
            this.errors = {};
            this.responseMessage = '';

            fetch('http://127.0.0.1:8000/api/register', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(this.form)
            })
            .then(res => res.json())
            .then(data => {
                if(data.errors) {
                    this.errors = data.errors;
                    return;
                }
                this.responseMessage = data.message;
                setTimeout(() => {
                    window.location.href = 'login.html';
                }, 1500);
            })
            .catch(err => {
                this.errors = { general: 'Something went wrong. Please try again later.' };
            })
            .finally(() => {
                this.loading = false;
            });
        }
    }
})
.mount('#app');