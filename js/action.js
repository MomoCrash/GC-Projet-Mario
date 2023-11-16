
/* -----------------------              ADMINISTRATION PART ------------------------------- */

$("#btn-editor").click(function() {
    location.href='editor.php';
});

/* -----------------------              QUIZ PART ------------------------------- */
var SCORE = 0

const questionsTypeEnum = Object.freeze({
    "qcm": 0,
    "qcu": 1,
  });

var POSITIVE_MULTIPLIER = 2;
var NEGATIVE_MULTIPLIER = 1;

// Current state of the quiz
var IS_FIRST = true;
var IS_RESET = false;
var IS_FINISH = false;

// All questions and progression
var QUESTIONS = [];
var ANWSERED_QUESTION = [];
var CURRENT_QUESTION = null;
var QUESTION_NUMBER = 15;
var QUESTION_PROGRESSION = 0;

// Selected anwser
var SELECTED_ANSWER = []

// Question feedback
var IS_FEEDBACK = false;
var FEEDBACK_QUESTION = null;

// Default coonstructor for Question class
class Question{constructor(s,t,e,i){
    this.questionsType=s,this.question=t,this.answers=e,this.validAnswers=i,QUESTIONS.push(this)}
    checkQuestion(s){
        let t=[],e=[];
        for(let i=0;i<s.length;i++){let h=s[i];this.validAnswers.includes(h)?t.push(h):e.push(h)}return[t,e]
    }
}

// Load from data base
$(document).ready(function() {
    $('.quiz-question').each(function() {
        var questions = $(this).data('service');

        console.log(questions);

        QUESTIONS=[];

        questions.forEach(element => {
            console.log(JSON.parse(element.valid_anwsers))
            new Question(questionsTypeEnum[element.question_type], element.question, JSON.parse(element.anwsers), JSON.parse(element.valid_anwsers));
        });
    });
});


// Script for reset the quiz
$("#question-reset").click(function(){
    CURRENT_QUESTION=null,QUESTION_PROGRESSION=0,SCORE=0,SELECTED_ANSWER=[],ANWSERED_QUESTION=[],IS_FEEDBACK=!1,FEEDBACK_QUESTION=!1,IS_RESET=!0,
    $("#question-title").text("Faire le quiz"),$("#question-subtitle").text("Duree: 10 minutes"),
    $("#question-card").empty(),
    $("#question-card").text('Vous devez repondre a chaque question par une ou plusieurs reponse, choissisez chaque reponse que vous pensez valide puis valider avec "Question suivante"'),
    $("#question-next").text("Commencez le Quiz !");let e=100*QUESTION_PROGRESSION/QUESTION_NUMBER;
    $("#question-progress").attr("style","width: "+e+"%").text(e+"%")
});

// Display the question on page
function displayQuestion(t){
    let e=t.answers;$("#question-title").text(t.question),
    $("#question-subtitle").text("Score "+SCORE);
    for(let s=0;s<e.length;s++){
        let i=e[s];SELECTED_ANSWER[s]=!1,
        $("#question-card").first().append('<li id="anwser_'+s+'" class="list-group-item"><div class="card-answer">'+i+"</div></li>"),
        $("#anwser_"+s).click(function(){
            SELECTED_ANSWER[s]?($(this).attr("style","background-color: #fff;"),SELECTED_ANSWER[s]=!1):
            ($(this).attr("style","background-color: #002fffb0;"),SELECTED_ANSWER[s]=!0)
        })
    }
}

// Update card displayed questions
function updateCard(t){
    $("#question-card")
    .empty();let o=Math.floor(Math.random()*QUESTIONS.length),e=0;
    for(;ANWSERED_QUESTION.includes(o)&&e<10;)o=Math.floor(Math.random()*QUESTIONS.length),e++;
    if(ANWSERED_QUESTION.push(o),displayQuestion(CURRENT_QUESTION=QUESTIONS[o]),t){let r=100*QUESTION_PROGRESSION/QUESTION_NUMBER;
    $("#question-progress").attr("style","width: "+r+"%").text(Math.floor(r)+"%")}
}

// Set the difficulty on easy
$("#question-easy").click(function(){
    $("#question-easy").attr("style","background-color: #ffd000"),
    $("#question-medium").attr("style","background-color: #6c757d"),
    $("#question-hard").attr("style","background-color: #6c757d"),POSITIVE_MULTIPLIER=2,NEGATIVE_MULTIPLIER=1
    QUESTION_NUMBER = 5;
}),

// Set the difficulty on medium
$("#question-medium").click(function(){
    $("#question-easy").attr("style","background-color: #6c757d"),
    $("#question-medium").attr("style","background-color: #ffd000"),
    $("#question-hard").attr("style","background-color: #6c757d"),POSITIVE_MULTIPLIER=1,NEGATIVE_MULTIPLIER=1
    QUESTION_NUMBER = 12;
}),

// Set the difficulty on hard
$("#question-hard").click(function(){
    $("#question-easy").attr("style","background-color: #6c757d"),
    $("#question-medium").attr("style","background-color: #6c757d"),
    $("#question-hard").attr("style","background-color: #ffd000"),POSITIVE_MULTIPLIER=1,NEGATIVE_MULTIPLIER=2
    QUESTION_NUMBER = 20;
});

// The main trame of quiz
$("#question-next").click(function(){
    // Code for the first quiz launch
    if(IS_FIRST)$("#progress-bar").append('<div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="10"><div id="question-progress" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%;">0%</div></div>"'),
    $("#question-next").text("Correction"),$("#question-difficulty").empty(),IS_FIRST=!1,updateCard(!1);
    // Code for the first quiz reset
    else if(IS_RESET)IS_RESET=!1,SCORE=0,QUESTION_PROGRESSION=0,updateCard(!0),
    $("#question-next").text("Correction");
    // Code for state question feedback
    else if(IS_FEEDBACK) $("#question-next").text("Correction"),IS_FEEDBACK=!1,(QUESTION_PROGRESSION+=1)==QUESTION_NUMBER?(
        $("#question-next").text("Finir le quiz"),IS_FINISH=!0):updateCard(!0);
    // Code for state quiz finish
    else if(IS_FINISH){console.log("Finis"),
        $("#question-title").text("Resultat"),$("#question-subtitle").text("Quiz en difficulte moyenne"),
        $("#question-card").empty(),$("#question-card").text("Vous avez : "+SCORE+" de score !"),$("#question-next").text("Commencez le Quiz !");

        //get leaderboard
        $.post("getleaderboard.php", {newScore: SCORE}, function(response){
            console.log(response);
            console.log($.parseJSON(response));
            $.parseJSON(response).forEach(element => {
                $("#question-card").append("<div>" + element.name + " : " + element.score + ".</div>");
            })
        });SCORE=0;

    let e=100*QUESTION_PROGRESSION/QUESTION_NUMBER;
    $("#question-progress").attr("style","width: "+e+"%").text(e+"%"),IS_FINISH=!1,IS_RESET=!0}
    // Code for scrolling questions
    else{let t=[];for(let i=0;i<SELECTED_ANSWER.length;i++){let s=SELECTED_ANSWER[i];s&&t.push(i)}
    if(0==t.length)return;console.log(t);
    let r=CURRENT_QUESTION.checkQuestion(t);
    for(let n=0;n<r[0].length;n++)r[0][n],console.log("+1"),SCORE+=1*POSITIVE_MULTIPLIER;
    for(let o=0;o<r[1].length;o++)r[1][o],console.log("-1"),SCORE>=1*NEGATIVE_MULTIPLIER&&(SCORE-=1*NEGATIVE_MULTIPLIER);
    $("#question-subtitle").text("Score: "+SCORE),
    IS_FEEDBACK=!0,$("#question-card").empty(),$("#question-title").text("Correction :"+CURRENT_QUESTION.question);
    for(let l=0;l<CURRENT_QUESTION.answers.length;l++){let a=CURRENT_QUESTION.answers[l];r[0]
        .includes(l)&&CURRENT_QUESTION.validAnswers.includes(l)?
        $("#question-card").first()
        .append('<li id="anwser_'+l+'" class="list-group-item" style="background-color: #00BC1B;><div class="card-answer">'+a+" +"+1*POSITIVE_MULTIPLIER+"</div></li>"):r[1].includes(l)?
        $("#question-card").first().append('<li id="anwser_'+l+'" class="list-group-item" style="background-color: #C0392B;  text-decoration: line-through;">'+a+" -"+1*NEGATIVE_MULTIPLIER+"</div></li>"):CURRENT_QUESTION.validAnswers.includes(l)?
        $("#question-card").first().append('<li id="anwser_'+l+'" class="list-group-item" style="background-color: #00BC1B;">'+a+" -"+1*NEGATIVE_MULTIPLIER+"</div></li>"):$("#question-card").first().append('<li id="anwser_'+l+'" class="list-group-item" style="background-color: #fff;">'+a+"</div></li>")}$("#question-subtitle").text("Score: "+SCORE),
        $("#question-next").text("Question suivante")}
});