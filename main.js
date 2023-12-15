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
