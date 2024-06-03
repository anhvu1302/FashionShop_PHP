$("#user-btn").click(function () {
    var userBox = $("#user-box");
    var displayValue = userBox.css("display");
  
    if (displayValue === "none") {
      userBox.css("display", "unset");
    } else {
      userBox.css("display", "none");
    }
  });