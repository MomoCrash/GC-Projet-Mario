var SCORE = 0

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
	constructor(questionsType,question,answers,validAnswers){
    	this.questionsType=questionsType;
      	this.question=question;
        this.answers=answers;
        this.validAnswers=validAnswers;

        QUESTIONS.push(this);
    }
    checkQuestion(userAnwser) {
        let userValidAnswers = [];
        let userInvalidAnswers = [];
        for (let index = 0; index < this.validAnswers.length; index++) {
            const element = this.validAnswers[index];
            console.log("element : " + element);
            if (userAnwser.includes(element)) {
                userValidAnswers.push(index);
            }
        }
        return [ userValidAnswers, userInvalidAnswers ];
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
                $(this).attr('style', 'background-color: #002fffb0;');
                SELECTED_ANSWER[index]=true
            } else {
                $(this).attr('style', 'background-color: #fff;');
                SELECTED_ANSWER[index]=false
            }
        });

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

$("#question-next").click(function(){

    if (IS_FIRST) {
        $("#question-next").text("Question suivante");
        IS_FIRST = false;
    } else {

        QUESTION_PROGRESSION += 1

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
        let userAnwser = CURRENT_QUESTION.checkQuestion(selected);

        for (let index = 0; index < userAnwser[0].length; index++) {
            const element = userAnwser[0][index];
            SCORE += 1;
        }
        for (let index = 0; index < userAnwser[1].length; index++) {
            const element = userAnwser[1][index];
            SCORE -= 1;
        }
        
        $("#question-subtitle").text("Score " + SCORE);

    }
    
    $('#question-card').empty();

    let progression = (QUESTION_PROGRESSION * 100)/QUESTION_NUMBER;
    $('#question-progress').attr('style', 'width: ' + progression + '%').text(progression + "%")

    To_ADD_SCORE = 0
    CURRENT_QUESTION = QUESTIONS[Math.floor(Math.random()*QUESTIONS.length)]
    displayQuestion(CURRENT_QUESTION)

});