// the script is a simple procedural JS file, if you intend to use it I suggest sanitizing it.
// import * as $ from 'https://code.jquery.com/jquery-3.6.0.min.js'
// variables

const cards = document.querySelectorAll(".card");
const flashFrontHead = document.querySelector(".flashcard-answer-head");
const flashBackHead = document.querySelector(".flashcard-question-head");
const flashBackText = document.querySelector(".flashcard-answer");
const flashBackSyn = document.querySelector(".flashcard-synonym");
const btnNext = document.querySelector(".flashcard-next");
const btnPrev = document.querySelector(".flashcard-back");
const resetBtn = document.querySelector(".flashcard-reset ");
let answerNumber = 0;
let questionValue = "";
let answerValue = "";
// object containing questions. You might want to switch the object for an array, but in my opinion objects give you a clearer way of seeing all that's been written. Take note - if you plan on adding more questions I suggest using backticks ` for multiline answers.

window.addEventListener("DOMContentLoaded", (e) => {
  fetch("flash/flash.php")
    .then(function (response) {
      return response.json();
    })
    .then(function (myJson) {
        console.log(myJson);
        console.log(myJson.length);

      start(myJson);
    });
});

// adding an event listener for both cards (front/back) and giving both of them a toggle of the 'hidden' class. Do not use 'this' unless you change the arrow function to a es5 function.

function start(questions) {
  cards.forEach((card) => {
    card.addEventListener("click", () => {
      cards.forEach((side) => {
        side.classList.toggle("hidden");
      });
    });
  });

  btnNext.addEventListener("click", (e) => {
    // e.preventDefault();
    // this flips the card if your on the answer side and want to go to the next question
    if (document.querySelector(".front").classList.length > 2) {
      cards.forEach((side) => {
        side.classList.toggle("hidden");
      });
    }
    console.log("cksdflkj",answerNumber);
    // changes the text if there is a next card
    if (answerNumber < questions.length) {
      answerNumber++;
      textChanger();
      btnNext.textContent = "Next";
    }

    // adds the 'reset' button and high-fives the user.
    if (answerNumber == questions.length) {
      resetBtn.classList.add("show");
      flashBackText.innerText = "You've attempted all questions.!";
      flashBackHead.innerText = "All Done !!";
      flashFrontHead.innerText = "You've attempted all questions.!";
      flashBackSyn.innerHTML = " All the best!";
      refresh = `<a href="index.php" style="text-decoration:none;color:white">Finish</a>`
      btnNext.innerHTML = refresh;

    }
    // removes the 'reset' button
    else {
      resetBtn.classList.remove("show");
    }
  });
  // works as long as there is a previous card
  btnPrev.addEventListener("click", (e) => {
    if (answerNumber > 1) {
      e.preventDefault();
      answerNumber--;
      textChanger();
      btnNext.textContent = "Next";
      resetBtn.classList.remove("show");
    }
    console.log(answerNumber);
  });
  // adds specific text. You might want to use Math.random if you want to randomize questions. If so - you might want to remove the numbers AND the counter string fron the 'ownAdder' element.
  const textChanger = function () {
    console.log(questions[answerNumber-1].word);
    var vali = questions[answerNumber-1].answer_example;
    var ans_obj = JSON.parse(vali);
    console.log(ans_obj)
    var body="";
    for (var key of Object.keys(ans_obj)) {
        if(key)
        {
            console.log(key + " -> " + ans_obj[key])
            ans = `<b>Answer</b> : ${key} <br>`;
            exm = `<B>Example</b> : ${ans_obj[key]}<br><br>`;
            body = body +ans+exm;
        }
    }
    synonym="";
    if(questions[answerNumber-1].synonym){
    arr = questions[answerNumber-1].synonym.split(",");
    synonym="<b>Synonym</b> :- "
    arr.forEach((syn)=>{
        synonym += `<span class="synonym"> ${syn}</span>`;
    });
    }
    antonym = "";
    if(questions[answerNumber-1].antonym)
    {
      antonym = `<br><b> antonym </b> :- <span class="synonym"> ${questions[answerNumber-1].antonym} </span>`;

    }
    synonym +=antonym;
    flashBackText.innerHTML = body;
    flashBackHead.innerText = questions[answerNumber-1].word;
    flashFrontHead.innerText = questions[answerNumber-1].word;
    flashBackSyn.innerHTML = synonym;
  };

  //   simple reset
  resetBtn.addEventListener("click", (e) => {
    e.preventDefault();
    answerNumber = 1;
    textChanger();
    resetBtn.classList.remove("show");
  });
}
