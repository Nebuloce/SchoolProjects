function validate() {

        var Q1 = document.getElementById("Q1").value;
        var Q2 = document.getElementById("Q2d");
        var Q3 = document.getElementById("Q3").value;
        var submitOK= 0;

        if(Q1 != 3) {
        alert("That is not the answer");
        }
        else {
        submitOK++;
        }


        if(!Q2.checked) {
        alert("Nope, math not your forte eh?");
        }
        else {
	submitOK++;
	}

	if(Q3 != "crunchy") {
        alert("The correct answer is crunchy")
        }
        else {
        submitOK++;
        }

        alert("you got " + submitOK + " right!");
        return submitOK;
}
