import { getCards } from '../../utils/game-client';
import generate from './card-generator';

const init = () => {
  const newHandBtnElement = document.querySelector('#js-new-hand');

  newHandBtnElement.addEventListener('click', () => {
    getCards().then(cards => {
      const handUnsort = document.querySelector('#js-hand-unsort');
      const handSort = document.querySelector('#js-hand-sort');

      generate(cards);

      handUnsort.classList.remove('d-none');
      handSort.classList.remove('d-none');
    });
  });
}

init();
