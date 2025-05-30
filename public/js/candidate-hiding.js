class CandidateHiding {
    constructor() {
        this.hiddenCandidates = JSON.parse(localStorage.getItem('hiddenCandidates') || '[]');
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        document.addEventListener('DOMContentLoaded', () => {
            this.hideInitialCandidates();
            this.updateProfileButtonState();
        });
    }

    toggleHideCandidate(candidateId) {
        const index = this.hiddenCandidates.indexOf(candidateId);
        
        if (index === -1) {
            this.hideCandidate(candidateId);
        } else {
            this.showCandidate(candidateId);
        }
        
        localStorage.setItem('hiddenCandidates', JSON.stringify(this.hiddenCandidates));
    }

    hideCandidate(candidateId) {
        this.hiddenCandidates.push(candidateId);
        
        // Update shortlisted widget items
        document.querySelectorAll(`[data-candidate-id="${candidateId}"]`).forEach(el => {
            if (el.classList.contains('candidate-item')) {
                el.style.display = 'none';
            }
        });

        // Update profile button if it exists
        const button = document.querySelector(`.hide-button[data-candidate-id="${candidateId}"]`);
        if (button) {
            button.classList.add('bg-red-600', 'hover:bg-red-500');
            button.classList.remove('bg-gray-700', 'hover:bg-gray-600');
            button.querySelector('.show-text').classList.add('hidden');
            button.querySelector('.unhide-text').classList.remove('hidden');
        }
    }

    showCandidate(candidateId) {
        const index = this.hiddenCandidates.indexOf(candidateId);
        this.hiddenCandidates.splice(index, 1);
        
        // Update shortlisted widget items
        document.querySelectorAll(`[data-candidate-id="${candidateId}"]`).forEach(el => {
            if (el.classList.contains('candidate-item')) {
                el.style.display = '';
            }
        });

        // Update profile button if it exists
        const button = document.querySelector(`.hide-button[data-candidate-id="${candidateId}"]`);
        if (button) {
            button.classList.remove('bg-red-600', 'hover:bg-red-500');
            button.classList.add('bg-gray-700', 'hover:bg-gray-600');
            button.querySelector('.show-text').classList.remove('hidden');
            button.querySelector('.unhide-text').classList.add('hidden');
        }
    }

    hideInitialCandidates() {
        this.hiddenCandidates.forEach(candidateId => {
            document.querySelectorAll(`[data-candidate-id="${candidateId}"]`).forEach(el => {
                if (el.classList.contains('candidate-item')) {
                    el.style.display = 'none';
                }
            });
        });
    }

    updateProfileButtonState() {
        const button = document.querySelector('.hide-button');
        if (!button) return;

        const candidateId = Number(button.dataset.candidateId);
        if (this.hiddenCandidates.includes(candidateId)) {
            button.classList.add('bg-red-600', 'hover:bg-red-500');
            button.classList.remove('bg-gray-700', 'hover:bg-gray-600');
            button.querySelector('.show-text').classList.add('hidden');
            button.querySelector('.unhide-text').classList.remove('hidden');
        }
    }
}

// Initialize the class
const candidateHiding = new CandidateHiding();

// Make it globally available
window.toggleHideCandidate = (candidateId) => candidateHiding.toggleHideCandidate(candidateId); 