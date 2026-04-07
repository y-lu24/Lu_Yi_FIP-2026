import { burgerMenu } from './modules/burger-menu.js';

burgerMenu();

const emptyForm = function() {
    return {
        name: '',
        email: '',
        phone: '',
        message: ''
    }
}

const app = Vue.createApp({
    data() {
        return {
            formData: emptyForm(),
            responseMessage: '',
            errors: {},
            buttonText: 'Send Message'
        }
    },
    methods: {
        submitForm() {
            fetch('http://127.0.0.1:8000/api/contact', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams(this.formData)
            })
            .then(res => res.json())
            .then(data => {
                if(data.errors) {
                    this.errors = data.errors;
                    this.responseMessage = '';
                    return;
                }
                this.errors = {};
                this.responseMessage = data.message;
                this.formData = emptyForm();
            })
            .catch(err => {
                console.log(err);
                this.errors = {
                    general: 'Something went wrong. Please try again later.'
                };
                this.responseMessage = '';
            });
        }
    }
})
.mount('#app');