var SCORE = 0
var To_ADD_SCORE = 0;

const questionsTypeEnum = Object.freeze({
    "qcm": 0,
    "qcu": 1,
    "dragAndDrop": 2,
    "Lines": 3,
  });

var IS_FIRST = true;

var CURRENT_QUESTION = null;
var QUESTION_NUMBER = 10;
var QUESTION_PROGRESSION = 0;

var QUESTIONS = [];
var SELECTED_ANSWER = []

class Question{
	constructor(questionsType,question,answers,validAnswers,scores){
    	this.questionsType=questionsType;
      	this.question=question;
        this.answers=answers;
        this.validAnswers=validAnswers;
        this.scores=scores;

        QUESTIONS.push(this);
    }
    checkQuestion(userAnwser) {
        let userValidAnswers = [];
        for (let index = 0; index < this.validAnswers.length; index++) {
            const element = this.validAnswers[index];
            console.log("element : " + element);
            if (userAnwser.includes(element)) {
                To_ADD_SCORE += 1;
                userValidAnswers.push(index);
            }
        }
        return userValidAnswers;
    }
}

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
                $(this).attr('style', 'background-color: #61616171;');
                SELECTED_ANSWER[index]=true
            } else {
                $(this).attr('style', 'background-color: #61616100;');
                SELECTED_ANSWER[index]=false
            }
        });

    }

}

$.getJSON("js/questions.json", function(content) {

    let questions = content
    console.log(questions)

    for (let index = 0; index < questions.length; index++) {

        const element = questions[index];
        
        let type = questionsTypeEnum[element.questionType]
        let question = element.question
        let answers = element.answers
        let validAnswers = element.validAnswers
        let scores = element.scores

        new Question(type, question, answers, validAnswers, scores);
    }

});

$("#question-next").click(function(){

    if (IS_FIRST) {
        $("#question-next").text("Question suivante");
        IS_FIRST = false;
    } else {

        let selected = []
        for (let index = 0; index < SELECTED_ANSWER.length; index++) {
            const element = SELECTED_ANSWER[index];
            if (element) {
                selected.push(index)
            }
        }
        if (selected.length == 0) {
            return;
        }

        console.log(selected)
        let response = CURRENT_QUESTION.checkQuestion(selected);

        if (response.length > 0) {
            for (let index = 0; index < array.length; index++) {
                const element = array[index];
                To_ADD_SCORE -= 1;
            }
        } else {
            SCORE += To_ADD_SCORE
            $("#question-subtitle").text("Score " + SCORE);
        }

    }
    
    $('#question-card').empty();

    QUESTION_PROGRESSION += 1
    let progression = (QUESTION_PROGRESSION * 100)/QUESTION_NUMBER;
    $('#question-progress').attr('style', 'width: ' + progression + '%').text(progression + "%")

    To_ADD_SCORE = 0
    CURRENT_QUESTION = QUESTIONS[Math.floor(Math.random()*QUESTIONS.length)]
    displayQuestion(CURRENT_QUESTION)

});