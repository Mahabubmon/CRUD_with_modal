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
show_data();

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
