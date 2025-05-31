// TODO: Code to be reviewed - localStorage implementation might need optimization
class CandidateFavorites {
    constructor() {
        this.storageKey = 'employer_favorite_candidates';
        this.favorites = this.loadFavorites();
        this.initializeEventListeners();
    }

    loadFavorites() {
        const stored = localStorage.getItem(this.storageKey);
        return stored ? JSON.parse(stored) : [];
    }

    saveFavorites() {
        localStorage.setItem(this.storageKey, JSON.stringify(this.favorites));
    }

    addFavorite(candidateId, candidateName) {
        if (!this.isFavorite(candidateId)) {
            this.favorites.push({
                id: candidateId,
                name: candidateName,
                timestamp: new Date().toISOString()
            });
            this.saveFavorites();
            this.updateFavoriteButton(candidateId, true);
        }
    }

    removeFavorite(candidateId) {
        this.favorites = this.favorites.filter(fav => fav.id !== candidateId);
        this.saveFavorites();
        this.updateFavoriteButton(candidateId, false);
    }

    isFavorite(candidateId) {
        return this.favorites.some(fav => fav.id === candidateId);
    }

    updateFavoriteButton(candidateId, isFavorite) {
        const button = document.querySelector(`.favorite-button[data-candidate-id="${candidateId}"]`);
        if (button) {
            // Update button appearance
            if (isFavorite) {
                button.classList.add('text-yellow-400');
                button.classList.remove('text-gray-400');
                button.setAttribute('title', 'Remove from favorites');
            } else {
                button.classList.remove('text-yellow-400');
                button.classList.add('text-gray-400');
                button.setAttribute('title', 'Add to favorites');
            }
        }
    }

    initializeEventListeners() {
        // Initialize favorite buttons when they exist
        document.addEventListener('DOMContentLoaded', () => {
            const favoriteButtons = document.querySelectorAll('.favorite-button');
            favoriteButtons.forEach(button => {
                const candidateId = button.getAttribute('data-candidate-id');
                this.updateFavoriteButton(candidateId, this.isFavorite(candidateId));
            });
        });
    }

    getRecentFavorites(limit = 3) {
        return this.favorites
            .sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp))
            .slice(0, limit);
    }
}

// Initialize the favorites system
const candidateFavorites = new CandidateFavorites();

// Global function to toggle favorite status
function toggleFavoriteCandidate(candidateId, candidateName) {
    if (candidateFavorites.isFavorite(candidateId)) {
        candidateFavorites.removeFavorite(candidateId);
    } else {
        candidateFavorites.addFavorite(candidateId, candidateName);
    }
} 