function updateWishlistCount() {
    const heartCountEl = document.getElementById('heart-count');
    if (!heartCountEl) return;

    fetch('/wishlist/count?_=' + new Date().getTime())
        .then(res => res.json())
        .then(data => {
            heartCountEl.innerText = data.count;
        })
        .catch(console.error);
}
