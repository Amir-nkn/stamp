
const deviseSelector = document.querySelector('#devise-selector');
const dropdown = document.querySelector('#devise-deroulant');
const deviseText = deviseSelector.querySelector('span');


deviseSelector.addEventListener('click', function() {
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
});


dropdown.addEventListener('click', function(event) {
    let selectedDevise = event.target.textContent.trim(); 

  
    if (!selectedDevise.includes("💲")) {
        selectedDevise = "💲 " + selectedDevise; 
    }

    deviseText.textContent = selectedDevise + " ▼";  
    dropdown.style.display = 'none';  
});

document.addEventListener('click', function(event) {
    if (!deviseSelector.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});

