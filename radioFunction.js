function whichFunction() {
// if "Update" is selected, pass to updateAndConfirm.php
if(document.editTable.function[0].checked == true) {
   document.editTable.action = 'updateAndConfirm.php';
   }
// if "Delete" is selected, pass to deleteAndConfirm.php
else if(document.editTable.function[0].checked == true) {
   document.editTable.action = 'deleteAndConfirm.php';
   }
return true; // obligatory return statement
}
