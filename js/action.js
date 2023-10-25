var SCORE = 0

const questionsTypeEnum = Object.freeze({
    "qcm": 0,
    "qcu": 1,
    "dragAndDrop": 2,
    "Lines": 3,
  });

var QUESTIONS = []

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
        return userValidAnswers;
    }
}

function displayQuestion(question) {
    
    let answers = question.answers;
    for (let index = 0; index < answers.length; index++) {
        console.log(answers)
        const element = answers[index];
        $(".CarreNoir").first().append('<input type="checkbox" value="1" class="col">' + element + '</input>')
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

$(".showQuestion").click(function(){
    
    displayQuestion(QUESTIONS[0])

});