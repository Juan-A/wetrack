// Live search for desktop and mobile devices
const desktopInput = document.querySelector('#desktopSearchInput');
const mobileInput = document.querySelector('#headerSearchInput');
const searchResults = document.querySelector('#searchResultsContainer');
const mobileResults = document.querySelector('#liveSearch');

// On focus show the search results
// If the input is not empty
desktopInput.addEventListener('focus', () => {
  if (desktopInput.value.trim() !== '') {
    searchResults.classList.remove('hidden');
  }
});

let timeout = null;

const handleInput = async (event) => {
  const query = event.target.value.trim();

  // Update the value of the other input
  if (event.target === desktopInput) {
    mobileInput.value = query;
  } else {
    desktopInput.value = query;
  }

  if (timeout) {
    clearTimeout(timeout);
  }

  if (query === '') {
    searchResults.innerHTML = '';
    mobileResults.innerHTML = '';
    searchResults.classList.add('hidden');
    return;
  }

  timeout = setTimeout(async () => {
    searchResults.classList.remove('hidden');
    const response = await fetch(`/api/liveSearch?query=${query}`);
    const results = await response.json();

    searchResults.innerHTML = '';
    mobileResults.innerHTML = '';

    results.tracks.items.forEach(track => {
      const trackElement = document.createElement('a');
      trackElement.classList.add('flex', 'items-center', 'p-2', 'hover:bg-base-200', 'track', 'basis-full', 'w-full', 'dark:text-white', 'rounded-md');
      trackElement.href = `/track/${track.id}`;

      const trackImage = document.createElement('img');
      trackImage.src = track.album.images[2].url;
      trackImage.alt = `${track.name} cover`;
      trackElement.appendChild(trackImage);

      const trackInfo = document.createElement('div');
      trackInfo.textContent = `${track.name} by ${track.artists.map(artist => artist.name).join(', ')}`;
      trackElement.appendChild(trackInfo);

      searchResults.appendChild(trackElement.cloneNode(true));
      mobileResults.appendChild(trackElement.cloneNode(true));
    });

    // Button to submit the form
    const button = document.createElement('li');
    button.classList.add('btn', 'w-full');
    button.textContent = 'Buscar más...';
    searchResults.appendChild(button.cloneNode(true));
    mobileResults.appendChild(button.cloneNode(true));
  }, 1000); // 1000 ms = 1 second
};

desktopInput.addEventListener('input', handleInput);
mobileInput.addEventListener('input', handleInput);

// Hide search results when clicking outside of them or the input
document.addEventListener('click', (event) => {
  if (!searchResults.contains(event.target) && event.target !== desktopInput) {
    searchResults.classList.add('hidden');
  }
});
