const generate = (cards) => {
  generateUnsortedCards(cards);
  generateSortedCards(cards);
}

const generateUnsortedCards = (cards) => {
  const handUnsortContainer = document.querySelector('#js-hand-unsort-container');
  handUnsortContainer.innerHTML = '';

  cards.unsortedCards.forEach(card => {
    handUnsortContainer.appendChild(createImageCard(card.cardPath));
  });
}

const generateSortedCards = (cards) => {
  const handSortContainer = document.querySelector('#js-hand-sort-container');
  handSortContainer.innerHTML = '';

  cards.sortedCards.forEach(card => {
    handSortContainer.appendChild(createImageCard(card.cardPath));
  });
}

const createImageCard = (cardPath) => {
  const cardImage = document.createElement('img');
  cardImage.classList.add('game-card');
  cardImage.classList.add('mr-3');
  cardImage.setAttribute('src', `/images/cards/${cardPath}.png`);

  return cardImage;
}

export default generate;
