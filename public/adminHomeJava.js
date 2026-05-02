// === Haftnotiz ===
const form = document.getElementById('note-form');
const titleInput = document.getElementById('note-title');
const textInput = document.getElementById('note-text');
const saveMsg = document.getElementById('save-msg');

// Vorbefüllung
titleInput.value = localStorage.getItem('haftnotiz-title') || '';
textInput.value = localStorage.getItem('haftnotiz-text') || '';

form.addEventListener('submit', (e) => {
  e.preventDefault();
  localStorage.setItem('haftnotiz-title', titleInput.value);
  localStorage.setItem('haftnotiz-text', textInput.value);
  saveMsg.style.display = 'block';
  setTimeout(() => saveMsg.style.display = 'none', 2000);
});


