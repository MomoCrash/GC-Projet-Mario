var SCORE = 0

const questionsTypeEnum = Object.freeze({
    qcm: 0,
    qcu: 1,
    dragAndDrop: 2,
    Lines: 3,
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

function getRandomQuestion() {
    return 
}

$.getJSON("js/questions.json", function(content) {
    console.log(content)
});

new Question(questionsTypeEnum.qcu, "Quelle est la couleur de la quasquette de Mario", ["Bleu", "Rouge", "Verte"], [1], [1]);
new Question(questionsTypeEnum.qcu, "Quelle est la couleur de la quasquette de Luigi", ["Bleu", "Rouge", "Verte"], [2], [1]);