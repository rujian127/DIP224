const learningCards = document.querySelectorAll('.learning-cards.card');
const videoIds = ['g9p5VKd8VkE', 'aM31RyxSSCw', 'Hcsy_gSWV0A']; // Replace these with the actual YouTube video IDs

learningCards.forEach((card, index) => {
    card.addEventListener('click', () => {
        const videoIframe = card.querySelector('iframe');
        const videoId = videoIds[index];
        videoIframe.src = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
    });
});