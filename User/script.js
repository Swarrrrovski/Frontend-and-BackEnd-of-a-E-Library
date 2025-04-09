
document.getElementById('order-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    alert('Order placed successfully!');
});

document.getElementById('review-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = document.getElementById('customer-name').value;
    const review = document.getElementById('review').value;
    const reviewsDisplay = document.getElementById('reviews-display');
    
    
    const newReview = document.createElement('div');
    newReview.innerHTML = `<strong>${name}</strong>: <p>${review}</p>`;
    reviewsDisplay.appendChild(newReview);
    

    document.getElementById('review-form').reset();
});


