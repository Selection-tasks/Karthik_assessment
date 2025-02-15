document.addEventListener('DOMContentLoaded', () => {
  
  const questions = [
    {
      id: 1,
      text: "What is the output of console.log(typeof NaN)?",
      options: ["number", "string", "undefined", "object"],
    },
    {
      id: 2,
      text: "Which of the following is not a JavaScript data type?",
      options: ["boolean", "float", "string", "object"],
    },
    {
      id: 3,
      text: "What does CSS stand for?",
      options: ["Cascading Style Sheets", "Creative Style Sheets", "Computer Style Sheets", "Colorful Style Sheets"],
    },
  ];

  const quizQuestionsDiv = document.getElementById('quizQuestions');

  questions.forEach((question, index) => {
    const questionDiv = document.createElement('div');
    questionDiv.className = "space-y-2";
    questionDiv.innerHTML = `
      <p class="font-medium text-gray-800">${index + 1}. ${question.text}</p>
      <div class="grid grid-cols-2 gap-2">
        ${question.options.map(option => `
          <label class="flex items-center justify-center p-3 bg-gray-200 rounded-md cursor-pointer hover:bg-gray-300 transition duration-200">
            <input type="checkbox" name="q${question.id}[]" value="${option}" class="hidden">
            <span class="text-gray-700">${option}</span>
          </label>
        `).join('')}
      </div>
    `;
    quizQuestionsDiv.appendChild(questionDiv);

    
    const labels = questionDiv.querySelectorAll('label');
    labels.forEach(label => {
      const checkbox = label.querySelector('input[type="checkbox"]');
      checkbox.addEventListener('change', () => {
        if (checkbox.checked) {
          label.classList.add('bg-indigo-600', 'text-white');
          label.classList.remove('bg-gray-200', 'hover:bg-gray-300');
        } else {
          label.classList.remove('bg-indigo-600', 'text-white');
          label.classList.add('bg-gray-200', 'hover:bg-gray-300');
        }
      });
    });
  });
});