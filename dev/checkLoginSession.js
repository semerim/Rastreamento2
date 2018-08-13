function checkLogin(){
 $.ajax({
  url: 'checkLoginSession.php',
  type: 'post',
  success: function(data){
   // Perform operation on return value
   // alert(data);
   if(data==0) window.location.href="logout.php";
  },
  complete:function(data){
   setTimeout(checkLogin,30000);
  }
 });
}

$(document).ready(function(){
 setTimeout(checkLogin,30000);
});

/*
$(document).ready(function(){
  setTimeout(function(){
        $.get("checkLoginSession.php", function(data){
        if(data==0) window.location.href="logout.php";
        });
    },1*60*1000);
});
*/