document.addEventListener('DOMContentLoaded', function() {
    let questionIndex = 0;

    document.getElementById('addQuestionButton').addEventListener('click', function() {
        addQuestion();
    });

    document.getElementById('quizForm').addEventListener('submit', function(event) {
        event.preventDefault();
        saveQuiz();
        window.location.reload();
    });

    function addQuestion() {
        questionIndex++;

        const questionContainer = document.createElement('div');
        questionContainer.classList.add('question');

        const questionInput = document.createElement('textarea');
        questionInput.setAttribute('name', `questions[${questionIndex}][question_text]`);
        questionInput.setAttribute('placeholder', 'اكتب السؤال هنا');
        questionInput.setAttribute("class","main-input");
        questionContainer.appendChild(questionInput);

        const markInput = document.createElement('input');
        markInput.setAttribute('type', 'number');
        markInput.setAttribute('name', `questions[${questionIndex}][mark]`);
        markInput.setAttribute('placeholder', 'العلامة');
        markInput.setAttribute("class","main-input");
        questionContainer.appendChild(markInput);


        const answersContainer = document.createElement('div');
        answersContainer.classList.add('answers');

        const addAnswerButton = document.createElement('button');
        addAnswerButton.setAttribute('type', 'button');
        addAnswerButton.textContent = 'إضافة إجابة';
        addAnswerButton.setAttribute("class","btnn");
        addAnswerButton.addEventListener('click', function() {
            addAnswer(answersContainer, questionIndex);

        });

        const removeQuestionButton = document.createElement('button');
        removeQuestionButton.setAttribute('type', 'button');
        removeQuestionButton.textContent = 'حذف السؤال';
        removeQuestionButton.classList.add('remove-btn');
        removeQuestionButton.addEventListener('click', function() {
            questionContainer.remove();
        });

        // questionContainer.appendChild(removeQuestionButton);
        questionContainer.appendChild(answersContainer);

        // questionContainer.appendChild(addAnswerButton);
        document.getElementById('questionsContainer').appendChild(questionContainer);



        let optionButton = document.createElement("div");
        optionButton.classList.add("optionButton")
        optionButton.appendChild(addAnswerButton);
        optionButton.appendChild(removeQuestionButton);
        questionContainer.appendChild(optionButton);

    }

    function addAnswer(answersContainer, questionIndex) {
        const answerIndex = answersContainer.childElementCount;

        const answerContainer = document.createElement('div');
        answerContainer.classList.add('answer');

        const answerInput = document.createElement('input');
        answerInput.setAttribute('type', 'text');
        answerInput.setAttribute('name', `questions[${questionIndex}][answers][${answerIndex}][answer_text]`);
        answerInput.setAttribute('placeholder', 'اكتب الإجابة هنا');
        answerInput.setAttribute("class","main-input");
        answerContainer.appendChild(answerInput);

        const correctInput = document.createElement('input');
        correctInput.setAttribute('type', 'radio');
        correctInput.setAttribute('name', `questions[${questionIndex}][correct_answer]`);
        correctInput.setAttribute('value', answerIndex);

        const label = document.createElement("label");
        let radioDiv = document.createElement("div");
        radioDiv.classList.add("radioDiv");
        label.appendChild(document.createTextNode("الاجابة صحيحة ؟"))
        radioDiv.appendChild(label);
        radioDiv.appendChild(correctInput);

        answerContainer.appendChild(radioDiv);

        const removeAnswerButton = document.createElement('button');
        removeAnswerButton.setAttribute('type', 'button');
        removeAnswerButton.textContent = 'حذف الإجابة';
        removeAnswerButton.classList.add('remove-btn');
        removeAnswerButton.addEventListener('click', function() {
            answerContainer.remove();
        });

        answerContainer.appendChild(removeAnswerButton);
        answersContainer.appendChild(answerContainer);
        answersContainer.appendChild(answerContainer);
    }

    function saveQuiz() {
        const formElement = document.getElementById('quizForm');
        const formData = new FormData(formElement);
        fetch('/quiz/store', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});

