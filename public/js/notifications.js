// Script to adjust notification dropdown width
document.addEventListener('DOMContentLoaded', function() {
    // Use Alpine.js to watch for changes
    document.addEventListener('alpine:initialized', () => {
        // Find all notification dropdowns and adjust their width
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.addedNodes.length) {
                    const dropdowns = document.querySelectorAll('[x-show="open"].absolute.right-0.mt-2');
                    dropdowns.forEach(dropdown => {
                        if (dropdown.closest('li').querySelector('svg path[d*="M14.857 17.082"]')) {
                            dropdown.style.width = '450px';
                            dropdown.style.maxWidth = '90vw';
                        }
                    });
                }
            });
        });
        
        observer.observe(document.body, { childList: true, subtree: true });
    });
});
