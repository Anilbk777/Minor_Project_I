document.addEventListener('DOMContentLoaded', function () {
    // Get references to the navigation and main elements
    const navigation = document.querySelector('.navigation');
    const main = document.querySelector('.main');

    // Get reference to the menu icon
    const menuIcon = document.querySelector('.menu');
    // const logoContainer = document.querySelector('.logo');

    // Toggle the 'active' class on navigation and main when the menu icon is clicked
    menuIcon.addEventListener('click', function () {
      navigation.classList.toggle('active');
      main.classList.toggle('active');
      // logoContainer.classList.toggle('inline');
    });
  });
  // ==========================================================================================================================
  function submitEntry(type) {
    const category = document.getElementById('category').value;
    const date = document.getElementById('date').value;
    const amount = document.getElementById('amount').value;
    const description = document.getElementById('description').value;

    // Validate inputs (you can add more validation if needed)
    if (category === '' || date === '' || amount === '') {
      alert('Please fill in required fields.');
      return;
    }

    // Log the entered details (you can replace this with your logic)
    console.log('Type:', type);
    console.log('Category:', category);
    console.log('Date:', date);
    console.log('Amount:', amount);
    console.log('Description:', description);

    // Optionally, you can add logic to store the details, e.g., in an array or send to the server
  }
  // ===================================================================================================================


  document.addEventListener("DOMContentLoaded", function() {
    function loadTableData(page, table) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "dashboard.php?page=" + page + "&table=" + table, true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("tbl").innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }

    var paginationButtons = document.querySelectorAll(".pagination a");
    paginationButtons.forEach(function(button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            var page = this.getAttribute("href").split("=")[1];
            loadTableData(page, 'expense');
        });
    });
});
function checkdelete(){
  return confirm('Are you sure you want to delete this record?');
}

// ------------------------------------------------------------------>

function openPopup3() {
  var dialog = document.querySelector('.popup3');
  dialog.showModal();
}

function closePopup3() {
  var dialog = document.querySelector('.popup3');
  dialog.close();
}


