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

// === Schichtplan ===
const scheduleTable = document.getElementById('schedule-table');
const saveScheduleBtn = document.getElementById('save-schedule');
const scheduleMsg = document.getElementById('schedule-msg');

// Lade Schichtplan aus LocalStorage
if (localStorage.getItem('schichtplan')) {
  const savedSchedule = JSON.parse(localStorage.getItem('schichtplan'));
  Array.from(scheduleTable.tBodies[0].rows).forEach((row, i) => {
    Array.from(row.cells).forEach((cell, j) => {
      if (i < savedSchedule.length && j < savedSchedule[i].length) {
        cell.innerText = savedSchedule[i][j];
      }
    });
  });
}

// Speichern
saveScheduleBtn.addEventListener('click', () => {
  const scheduleData = Array.from(scheduleTable.tBodies[0].rows).map(row =>
    Array.from(row.cells).map(cell => cell.innerText)
  );
  localStorage.setItem('schichtplan', JSON.stringify(scheduleData));
  scheduleMsg.style.display = 'block';
  setTimeout(() => scheduleMsg.style.display = 'none', 2000);
});
