// funzioni per cambiare la visualizzazione della pagina senza riaggiornarla
$(document).ready(function(){
    $("#btn-blog").click(function(){ //c'è
      $("#profilo_blog").show();
      // $("#profilo_post").hide();
      // $("#coautore_post").hide();
      $("#coautore_blog").hide();
    });
  });

// $(document).ready(function(){
//     $("#btn-post").click(function(){
//         $("#profilo_blog").hide();
//         $("#btn-new-blog").hide();
//         $("#pres").show();
//         $("#profilo_post").show();
//         $("#coautore_post").hide();
//         $("#coautore_blog").hide();
//     });
//   });

$(document).ready(function(){
    $("#btn-coautore-blog").click(function(){ //c'è
        $("#profilo_blog").hide();
        // $("#profilo_post").hide();
        // $("#coautore_post").hide();
        $("#coautore_blog").show();
    });
  });

// $(document).ready(function(){
//     $("#btn-coautore-post").click(function(){
//         $("#profilo_blog").hide();
//         $("#profilo_post").hide();
//         $("#coautore_post").show();
//         $("#coautore_blog").hide();
//     });
//   });
  

