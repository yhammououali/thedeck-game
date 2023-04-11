export const getCards = () => {
  return fetch(`/game/${gameId}/cards`)
    .then(response => response.json())
    .catch(error => console.error(error))
}
