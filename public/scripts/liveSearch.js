// Select the query input element
const queryInput = document.querySelector('#headerSearchInput');
const resultsContainer = document.querySelector('#liveSearch');

queryInput.addEventListener('keyup', async (event) => {
    // Clear any existing timeout
    clearTimeout(queryInput.timeout);
  
    // Set a new timeout to delay the execution of the code
    queryInput.timeout = setTimeout(async () => {
      // Get the search query from the input element
      const query = event.target.value;
      if (query.trim() === '') {
        resultsContainer.innerHTML = '';
        return;
      }  
      // Make a request to the server with the search query
      const response = await fetch(`/api/liveSearch?query=${query}`);
  
      // Parse the response as JSON
      const results = await response.json();
  
      // Update the search results dynamically
      resultsContainer.innerHTML = '';
      results.tracks.items.forEach(track => {
        const trackElement = document.createElement('a');
        trackElement.classList.add('track');
        trackElement.classList.add('basis-full');
        trackElement.classList.add('w-full');
        trackElement.href = `track/${track.id}`
  
        const trackImage = document.createElement('img');
        trackImage.src = track.album.images[2].url;
        trackImage.alt = `${track.name} cover`;
        trackElement.appendChild(trackImage);
  
        const trackInfo = document.createElement('div');
        trackInfo.textContent = `${track.name} by ${track.artists.map(artist => artist.name).join(', ')}`;
        trackElement.appendChild(trackInfo);
  
        resultsContainer.appendChild(trackElement);
      });
    }, 2000); // Delay execution by 2000ms (2 seconds)
  });
