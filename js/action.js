var SCORE = 0

const questionsTypeEnum = Object.freeze({
    "qcm": 0,
    "qcu": 1,
    "dragAndDrop": 2,
    "Lines": 3,
  });

var IS_FIRST = true;
var IS_RESET = false;
var IS_FINISH = false;

// All questions and progression
var QUESTIONS = [];
var CURRENT_QUESTION = null;
var QUESTION_NUMBER = 10;
var QUESTION_PROGRESSION = 0;

// Selected anwser
var SELECTED_ANSWER = []

// Question feedback
var IS_FEEDBACK = false;
var FEEDBACK_QUESTION = null;

// Default coonstructor for Question class
class Question{
	constructor(questionsType,question,answers,validAnswers){
    	this.questionsType=questionsType;
      	this.question=question;
        this.answers=answers;
        this.validAnswers=validAnswers;

        QUESTIONS.push(this);
    }

    // Match user anwser and question valid anwser
    checkQuestion(userAnwser) {
        let userValidAnswers = [];
        let userInvalidAnswers = [];

        for (let index = 0; index < userAnwser.length; index++) {
            const element = userAnwser[index];

            if (this.validAnswers.includes(element)) {
                userValidAnswers.push(element);
            } else {
                userInvalidAnswers.push(element)
            }

        }
        return [ userValidAnswers, userInvalidAnswers ];
    }
}

$("#question-reset").click(function() {

    CURRENT_QUESTION=null;
    QUESTION_PROGRESSION=0;
    SCORE=0;

    SELECTED_ANSWER = [];

    IS_FEEDBACK=false;
    FEEDBACK_QUESTION=false;

    IS_RESET=true;

    $("#question-title").text("Faire le quiz");
    $("#question-subtitle").text("Duree: 10 minutes");

    $('#question-card').empty();
    $('#question-card').text('Vous devez repondre a chaque question par une ou plusieurs reponse, choissisez chaque reponse que vous pensez valide puis valider avec "Question suivante"')

    $("#question-next").text("Commencez le Quiz !")

    let progression = (QUESTION_PROGRESSION * 100)/QUESTION_NUMBER;
    $('#question-progress').attr('style', 'width: ' + progression + '%').text(progression + "%")
    

});

// Display the question on page
function displayQuestion(question) {
    
    let answers = question.answers;

    $("#question-title").text(question.question);
    $("#question-subtitle").text("Score " + SCORE);

    for (let index = 0; index < answers.length; index++) {

        const element = answers[index];
        SELECTED_ANSWER[index]=false

        $("#question-card").first().append('<li id="anwser_' + index + '" class="list-group-item"><div class="card-answer">' + element + '</div></li>');

        $("#anwser_" + index).click(function() {
            if(!SELECTED_ANSWER[index]) {
                $(this).attr('style', 'background-color: #002fffb0;');
                SELECTED_ANSWER[index]=true
            } else {
                $(this).attr('style', 'background-color: #fff;');
                SELECTED_ANSWER[index]=false
            }
        });

    }

}

function updateCard(isProgression) {
    $('#question-card').empty();
    CURRENT_QUESTION = QUESTIONS[Math.floor(Math.random()*QUESTIONS.length)]
    displayQuestion(CURRENT_QUESTION)

    if (isProgression) {
        // Update Progression
        let progression = (QUESTION_PROGRESSION * 100)/QUESTION_NUMBER;
        $('#question-progress').attr('style', 'width: ' + progression + '%').text(progression + "%")
    }
}

$.getJSON("js/questions.json", function(content) {

    let questions = content

    for (let index = 0; index < questions.length; index++) {

        const element = questions[index];
        
        let type = questionsTypeEnum[element.questionType]
        let question = element.question
        let answers = element.answers
        let validAnswers = element.validAnswers

        new Question(type, question, answers, validAnswers);
    }

});

// Check click on the Question button
$("#question-next").click(function(){

    if (IS_FIRST) {

        $("#progress-bar").append('<div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="10">'
        + '<div id="question-progress" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%;">0%</div></div>"');
        $("#question-next").text("Correction");
        IS_FIRST = false;
        updateCard(false)

    } else if (IS_RESET) {

        IS_RESET=false;
        updateCard(false)
        $("#question-next").text("Correction");

    } else if(IS_FEEDBACK) {

        $("#question-next").text("Correction");
        IS_FEEDBACK = false;
        QUESTION_PROGRESSION += 1
        // Set a new question on page
        updateCard(true)

    } else {

        // Get activated anwsers
        let selected = []
        for (let index = 0; index < SELECTED_ANSWER.length; index++) {
            const element = SELECTED_ANSWER[index];
            if (element) {
                selected.push(index)
            }
        }

        // Check if there is no selected question
        if (selected.length == 0) {
            return;
        }

        // Check the right or bad anwsers
        console.log(selected)
        let currentAnwsers = CURRENT_QUESTION.checkQuestion(selected);

        for (let index = 0; index < currentAnwsers[0].length; index++) {
            const element = currentAnwsers[0][index];
            console.log("+1");
            SCORE += 1;
        }
        for (let index = 0; index < currentAnwsers[1].length; index++) {
            const element = currentAnwsers[1][index];
            console.log("-1");
            if (SCORE >= 1) {
                SCORE -= 1;
            }
        }

        // Update the score
        $("#question-subtitle").text("Score: " + SCORE);

        // Show the feedback screen
        IS_FEEDBACK=true;
        $('#question-card').empty();
        $("#question-title").text("Correction :" + CURRENT_QUESTION.question);

        for (let index = 0; index < CURRENT_QUESTION.answers.length; index++) {
            const element = CURRENT_QUESTION.answers[index];
            if (currentAnwsers[0].includes(index) && CURRENT_QUESTION.validAnswers.includes(index)) {
                $("#question-card").first().append('<li id="anwser_' + index + '" class="list-group-item" style="background-color: #00BC1B;><div class="card-answer">' + element + ' +1</div></li>');
            } else if (currentAnwsers[1].includes(index)) {
                $("#question-card").first().append('<li id="anwser_' + index + '" class="list-group-item" style="background-color: #C0392B;  text-decoration: line-through;">' + element + ' -1</div></li>');
            } else if (CURRENT_QUESTION.validAnswers.includes(index)) {
                $("#question-card").first().append('<li id="anwser_' + index + '" class="list-group-item" style="background-color: #00BC1B;">' + element + ' -1</div></li>');
            } else {
                $("#question-card").first().append('<li id="anwser_' + index + '" class="list-group-item" style="background-color: #fff;">' + element + '</div></li>');
            }
        }

        // Update the score
        $("#question-subtitle").text("Score: " + SCORE);
        $("#question-next").text("Question suivante");

    }

});