document.addEventListener('DOMContentLoaded', function () {
  const navigation = document.querySelector('.navigation');
  const main = document.querySelector('.main');

  const menuIcon = document.querySelector('.menu');

  menuIcon.addEventListener('click', function () {
    navigation.classList.toggle('active');
    main.classList.toggle('active');
  });
});
// ==========================================================================================================================
function submitEntry(type) {
  const category = document.getElementById('category').value;
  const date = document.getElementById('date').value;
  const amount = document.getElementById('amount').value;
  const description = document.getElementById('description').value;

  if (category === '' || date === '' || amount === '') {
    alert('Please fill in required fields.');
    return;
  }

  console.log('Type:', type);
  console.log('Category:', category);
  console.log('Date:', date);
  console.log('Amount:', amount);
  console.log('Description:', description);

}
// ===================================================================================================================


document.addEventListener("DOMContentLoaded", function () {
  function loadTableData(page, table) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "dashboard.php?page=" + page + "&table=" + table, true);

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        document.getElementById("tbl").innerHTML = xhr.responseText;
      }
    };

    xhr.send();
  }

  var paginationButtons = document.querySelectorAll(".pagination a");
  paginationButtons.forEach(function (button) {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      var page = this.getAttribute("href").split("=")[1];
      loadTableData(page, 'expense');
    });
  });
});
function checkdelete() {
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
var currentDate = new Date().toISOString().slice(0, 10);

document.getElementById("t-date").value = currentDate;



function showBudgetDaysLeftPopup() {
  var modal = document.getElementById("budgetDaysLeftModal");
  modal.style.display = "block";
}

function closeBudgetDaysLeftPopup() {
  var modal = document.getElementById("budgetDaysLeftModal");
  modal.style.display = "none";
}


