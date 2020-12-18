function showMore(id) {
    var findClicked = document.getElementsByClassName("clicked");

    if (findClicked.length > 0) findClicked[0].classList.remove("clicked");

    document.getElementById(id).classList.add("clicked");

    return;
}
 
$(document).ready(function() {
    $("#inputSearch").on("keyup", function() {
        var value = $(this)
            .val()
            .toLowerCase();
        $("#table .tableBody tr ").filter(function() {
            $(this).toggle(
                $(this)
                    .text()
                    .toLowerCase()
                    .indexOf(value) > -1
            );
        });
    });
});

// function invest() {
//   var input, filter, tbody, td, a, i, txtValue;
//   input = document.getElementById("notes");
//   filter = input.value.toUpperCase();
//   tbody = document.getElementById("search_notes");
//   li = ul.getElementsByTagName("li");

//   for (i = 0; i < li.length; i++) {
//       a = li[i].getElementsByTagName("a")[0];
//       txtValue = a.textContent || a.innerText;
//       if (txtValue.toUpperCase().indexOf(filter) > -1) {
//           li[i].style.display = "";
//       } else {
//           li[i].style.display = "none";
//       }
//   }
// }

function submitForm(id) {
  console.log(id)
    document.getElementById(id).submit();
}
