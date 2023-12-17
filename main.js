$(document).ready(function () {
  show_data();
});

function userModal() {
  $("#UserModal").show();
}

//modal hide function

function closeButton() {
  $("#UserModal").hide();
}

//insert the data
$("#btnUserAdd").on("click", function (e) {
  e.preventDefault();

  let mydata = {};
  mydata.name = $("#name").val();
  mydata.userName = $("#userName").val();
  mydata.email = $("#email").val();
  mydata.address = $("#address").val();
  mydata.type = "USER_CREATE";

  $.ajax({
    url: "action.php",
    method: "post",
    data: mydata,
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        console.log(response);
        // Clear the form input fields
        $("#name").val("");
        $("#userName").val("");
        $("#email").val("");
        $("#address").val("");

        show_data();
        sweetAlertSuccess(response.msg);
      } else {
        sweetAlertErrors(response.msg);
      }
    },
  });
});

//Data Show funtion
function show_data(id) {
  $.ajax({
    url: "action.php",
    method: "post",
    data: { id: id, type: "SHOW_DATA" }, // Include type here
    dataType: "text",
    success: function (response) {
      // console.log(response);
      $("#tbody").html(response);
    },
  });
}

//Delete functionality
$(document).on("click", ".btn-delete", function () {
  let userId = $(this).data("id");
  $.ajax({
    url: "action.php",
    method: "post",
    data: { id: userId, type: "DELETE_DATA" },
    dataType: "json",
    success: function (response) {
      if (response.status == "success") {
        sweetAlertSuccess(response.msg);

        show_data();
      } else {
        sweetAlertErrors(response.msg);
      }
    },
  });
});

//edit functionality
$(document).on("click", ".btn-edit", function () {
  let userId = $(this).data("id");
  userModal();
  $.ajax({
    url: "edit.php",
    method: "post",
    dataType: "json",
    data: { id: userId, type: "EDIT_DATA" },
    success: function (response) {
      $("#name").val(response.name);
      $("#userName").val(response.username);
      $("#email").val(response.email);
      $("#address").val(response.address);
    },
  });
});

//Sweet alert function
function sweetAlertSuccess(msg) {
  Swal.fire({
    position: "top-end",
    icon: "success",
    title: msg,
    showConfirmButton: false,
    timer: 1500,
  });
}

function sweetAlertErrors(msg) {
  Swal.fire({
    position: "top-end",
    icon: "error",
    title: msg,
    showConfirmButton: false,
    timer: 1500,
  });
}
