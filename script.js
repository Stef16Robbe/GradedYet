function finishedAmountPlus(id, maxAmount) {
    var finishedAmount = parseInt(document.getElementById('examinedAmount' + id).innerHTML);
    finishedAmount = finishedAmount + 1;
    if (finishedAmount <= maxAmount) {
        if (finishedAmount < 10) {
            finishedAmount = "0" + String(finishedAmount);
        }
        document.getElementById('examinedAmount' + id).innerHTML = finishedAmount;
    }
}

function finishedAmountMinus(id) {
    var finishedAmount = parseInt(document.getElementById('examinedAmount' + id).innerHTML);
    finishedAmount = finishedAmount - 1;
    if (finishedAmount >= 0) {
        if (finishedAmount < 10) {
            finishedAmount = "0" + String(finishedAmount);
        }
        document.getElementById('examinedAmount' + id).innerHTML = finishedAmount;
    }
}

function saveFinishedAmount(id, maxAmount) {
    
    finishedAmount = parseInt(document.getElementById('examinedAmount' + id).innerHTML);
    if (finishedAmount >= 0 && finishedAmount <= maxAmount) {
        $.ajax({ url: 'UpdateExaminedAmount.php',
        data: {id: id, examinedAmount: finishedAmount},
        type: 'post',
        success: function(output) {
                if (output == 0) {
                    alert("Something went wrong. Please try again.");
                }
            }
        });
    }

}