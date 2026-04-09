const app = Vue.createApp({
    data() {
        return {
            currentTab: 'artists',
            artistsData: [],
            portfolioData: [],
            messagesData: [],
            consultationsData: [],
            loadingArtists: true,
            loadingPortfolio: true,
            loadingMessages: true,
            loadingConsultations: true,
            artistMessage: '',
            imageMessage: '',
            editingArtist: null,
            editingImage: null,
            artistForm: emptyArtistForm(),
            imageForm: emptyImageForm()
        }
    },
    created() {
        this.getArtists();
        this.getPortfolio();
        this.getMessages();
        this.getConsultations();
    },
    methods: {
        getArtists() {
            fetch('http://127.0.0.1:8000/api/admin/artists')
            .then(res => {
                if(!res.ok) {
                    throw new Error('Failed to fetch artists');
                }
                return res.json();
            })
            .then(data => {
                this.artistsData = data.data;
            })
            .catch(err => console.log(err))
            .finally(() => {
                this.loadingArtists = false;
            });
        },

        submitArtist() {
            if(this.editingArtist) {
                this.updateArtist();
            } else {
                this.addArtist();
            }
        },

        addArtist() {
            fetch('http://127.0.0.1:8000/api/admin/artists', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(this.artistForm)
            })
            .then(res => res.json())
            .then(data => {
                this.artistMessage = data.message;
                this.artistForm = emptyArtistForm();
                this.getArtists();
            })
            .catch(err => console.log(err));
        },

        editArtist(artist) {
            this.editingArtist = artist;
            this.artistForm = {
                name: artist.name,
                bio: artist.bio,
                specialty_styles: artist.specialty_styles,
                instagram_handle: artist.instagram_handle,
                profile_image_url: artist.profile_image_url
            };
        },

        updateArtist() {
            fetch('http://127.0.0.1:8000/api/admin/artists/' + this.editingArtist.id, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(this.artistForm)
            })
            .then(res => res.json())
            .then(data => {
                this.artistMessage = data.message;
                this.editingArtist = null;
                this.artistForm = emptyArtistForm();
                this.getArtists();
            })
            .catch(err => console.log(err));
        },

        deleteArtist(id) {
            fetch('http://127.0.0.1:8000/api/admin/artists/' + id, {
                method: 'DELETE'
            })
            .then(res => res.json())
            .then(data => {
                this.artistMessage = data.message;
                this.getArtists();
            })
            .catch(err => console.log(err));
        },

        cancelArtistEdit() {
            this.editingArtist = null;
            this.artistForm = emptyArtistForm();
        },

        getPortfolio() {
            fetch('http://127.0.0.1:8000/api/admin/portfolio')
            .then(res => {
                if(!res.ok) {
                    throw new Error('Failed to fetch portfolio');
                }
                return res.json();
            })
            .then(data => {
                this.portfolioData = data.data;
            })
            .catch(err => console.log(err))
            .finally(() => {
                this.loadingPortfolio = false;
            });
        },

        submitImage() {
            if(this.editingImage) {
                this.updateImage();
            } else {
                this.addImage();
            }
        },

        addImage() {
            fetch('http://127.0.0.1:8000/api/admin/portfolio', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(this.imageForm)
            })
            .then(res => res.json())
            .then(data => {
                this.imageMessage = data.message;
                this.imageForm = emptyImageForm();
                this.getPortfolio();
            })
            .catch(err => console.log(err));
        },

        editImage(image) {
            this.editingImage = image;
            this.imageForm = {
                title: image.title,
                image_url: image.image_url,
                artist_id: image.artist_id,
                completion_date: image.completion_date,
                description: image.description
            };
        },

        updateImage() {
            fetch('http://127.0.0.1:8000/api/admin/portfolio/' + this.editingImage.id, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams(this.imageForm)
            })
            .then(res => res.json())
            .then(data => {
                this.imageMessage = data.message;
                this.editingImage = null;
                this.imageForm = emptyImageForm();
                this.getPortfolio();
            })
            .catch(err => console.log(err));
        },

        deleteImage(id) {
            fetch('http://127.0.0.1:8000/api/admin/portfolio/' + id, {
                method: 'DELETE'
            })
            .then(res => res.json())
            .then(data => {
                this.imageMessage = data.message;
                this.getPortfolio();
            })
            .catch(err => console.log(err));
        },

        cancelImageEdit() {
            this.editingImage = null;
            this.imageForm = emptyImageForm();
        },

        getMessages() {
            fetch('http://127.0.0.1:8000/api/admin/messages')
            .then(res => {
                if(!res.ok) {
                    throw new Error('Failed to fetch messages');
                }
                return res.json();
            })
            .then(data => {
                this.messagesData = data.data;
            })
            .catch(err => console.log(err))
            .finally(() => {
                this.loadingMessages = false;
            });
        },

        updateMessageStatus(id, status) {
            fetch('http://127.0.0.1:8000/api/admin/messages/' + id, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ status: status })
            })
            .then(res => res.json())
            .then(() => {
                this.getMessages();
            })
            .catch(err => console.log(err));
        },

        getConsultations() {
            fetch('http://127.0.0.1:8000/api/admin/consultations')
            .then(res => {
                if(!res.ok) {
                    throw new Error('Failed to fetch consultations');
                }
                return res.json();
            })
            .then(data => {
                this.consultationsData = data.data;
            })
            .catch(err => console.log(err))
            .finally(() => {
                this.loadingConsultations = false;
            });
        },

        updateConsultationStatus(id, status) {
            fetch('http://127.0.0.1:8000/api/admin/consultations/' + id, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ status: status })
            })
            .then(res => res.json())
            .then(() => {
                this.getConsultations();
            })
            .catch(err => console.log(err));
        },

        logout() {
            fetch('http://127.0.0.1:8000/api/admin/logout', {
                method: 'POST'
            })
            .then(() => {
                window.location.href = 'login.html';
            })
            .catch(err => console.log(err));
        }
    }
})
.mount('#app');

const emptyArtistForm = function() {
    return {
        name: '',
        bio: '',
        specialty_styles: '',
        instagram_handle: '',
        profile_image_url: ''
    }
}

const emptyImageForm = function() {
    return {
        title: '',
        image_url: '',
        artist_id: '',
        completion_date: '',
        description: ''
    }
}