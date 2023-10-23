var SCORE = 0

const questionsTypeEnum = Object.freeze({
    qcm: 0,
    qcu: 1,
    dragAndDrop: 2,
    Lines: 3,
  });

class Question{
	constructor(questionsType,question,answers,validAnswers,scores){
    	this.questionsType=questionsType;
      	this.question=question;
        this.answers=answers;
        this.validAnswers=validAnswers;
        this.scores=scores;
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

let question1 = new Question(questionsTypeEnum.qcu, "Quelle est la couleur de la quasquette de mario", ["Bleu", "Rouge"], [1, 0], [5, 10]);
question1.checkQuestion([1])
console.log(SCORE)

question1.checkQuestion([1])
console.log(SCORE)