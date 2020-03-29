function deleteClass(id) {
    $.ajax({ url: 'DeleteClass.php',
    data: {id: id},
    type: 'post',
    success: function(output) {
            if (output == 1) {
                location.reload();
                return false;
            }
            else {
                alert("Something went wrong. Class has not been deleted, please try again.");
            }
        }
    });
}

function showAddClass() {
    document.getElementById("addClassIcon").style.display="none";
    document.getElementById("addClass").style.display="block";
}