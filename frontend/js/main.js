import { burgerMenu } from './modules/burger-menu.js';
import { bottomNav } from './modules/bottom-nav.js';
import { scrollTop } from './modules/scroll-top.js';
import { smoothScroll } from './modules/smooth-scroll.js';

burgerMenu();
bottomNav();
scrollTop();
smoothScroll();

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
            artistsData: [],
            portfolioData: [],
            error: null,
            loadingArtists: true,
            loadingPortfolio: true,
            currentPage: 0,
            selectedImage: null,
            formData: emptyForm(),
            responseMessage: '',
            errors: {},
            buttonText: 'Send Message'
        }
    },
    created() {
        this.getArtists();
        this.getPortfolio();
    },
    methods: {
        getArtists() {
            fetch('http://127.0.0.1:8000/api/artists')
            .then(res => {
                if(!res.ok) {
                    throw new Error('Failed to fetch artists');
                }
                return res.json();
            })
            .then(artists => {
                this.artistsData = artists.data;
            })
            .catch(err => {
                this.error = err.message;
            })
            .finally(() => {
                this.loadingArtists = false;
            });
        },

        getPortfolio() {
            fetch('http://127.0.0.1:8000/api/portfolio')
            .then(res => {
                if(!res.ok) {
                    throw new Error('Failed to fetch portfolio');
                }
                return res.json();
            })
            .then(portfolio => {
                this.portfolioData = portfolio.data;
            })
            .catch(err => {
                this.error = err.message;
            })
            .finally(() => {
                this.loadingPortfolio = false;
            });
        },

        getCurrentImages() {
            const start = this.currentPage * 4;
            return this.portfolioData.slice(start, start + 4);
        },

        prevPage() {
            if(this.currentPage > 0) {
                this.currentPage--;
            }
        },

        nextPage() {
            const totalPages = Math.ceil(this.portfolioData.length / 4);
            if(this.currentPage < totalPages - 1) {
                this.currentPage++;
            }
        },

        openLightbox(image) {
            this.selectedImage = image;
        },

        closeLightbox() {
            this.selectedImage = null;
        },

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