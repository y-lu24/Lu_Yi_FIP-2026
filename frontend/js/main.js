import { burgerMenu } from './modules/burger-menu.js';
import { bottomNav } from './modules/bottom-nav.js';

burgerMenu();
bottomNav();

const app = Vue.createApp({
    data() {
        return {
            artistsData: [],
            portfolioData: [],
            error: null,
            loadingArtists: true,
            loadingPortfolio: true
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
        }
    }
})
.mount('#app');