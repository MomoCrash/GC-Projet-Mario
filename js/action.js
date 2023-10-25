var SCORE = 0

const questionsTypeEnum = Object.freeze({
    "qcm": 0,
    "qcu": 1,
    "dragAndDrop": 2,
    "Lines": 3,
  });

var IS_FIRST = true;

var CURRENT_QUESTION = null;
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
                SCORE += this.scores[index]
                userValidAnswers.push(index);
            }
        }
        $("#question-subtitle").text("Score " + SCORE);
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
        CURRENT_QUESTION.checkQuestion(selected);

    }
    
    $('#question-card').empty();
    CURRENT_QUESTION = QUESTIONS[Math.floor(Math.random()*QUESTIONS.length)]
    displayQuestion(CURRENT_QUESTION)

});