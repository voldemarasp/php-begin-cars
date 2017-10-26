$( "#submit" ).click(function() {

    

    if ($("#owner").val() == "" && $("#license").val() == ""){
      console.log('test');
      $("#prideti_error").html('Please fill all the fields');
    } else { $("#prideti_error").html(''); }

  $.post("cars.php", 
  {
    owner: $("#owner").val(),
    license: $("#license").val(),
    model: $("#model").val(),
    make: $("#make").val()
  }, 
  function(data, status){
    $.getJSON("cars.php", function(result) {
      $("#lentele").html('');

      $.each(result, function(i, field) {
       $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td><td><a class='btn btn-warning' href='cars.php?id=" + field.id +"'>Delete</a></td></tr>");
     });
    });
  });
});

$.getJSON("cars.php", function(result) {

  $("#lentele").html('');

  $.each(result, function(i, field) {
    $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td><td><a class='btn btn-warning' href='cars.php?id=" + field.id +"'>Delete</a></td></tr>");
  });
});

$("#make_filter").change(function() {
    $.getJSON( "cars.php",
    {
      make_filter: $("#make_filter").val(),
      model_filter: $("#model_filter").val(),
      owner_filter: $("#owner_filter").val()
    },
     function(result) {
    $("#lentele").html('');

      $.each(result, function(i, field) {
        $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td><td><a class='btn btn-warning' href='cars.php?id=" + field.id +"'>Delete</a></td></tr>");
      });

    });
});

$("#model_filter").change(function() {
    $.getJSON( "cars.php",
    {
      make_filter: $("#make_filter").val(),
      model_filter: $("#model_filter").val(),
      owner_filter: $("#owner_filter").val()
    },
     function(result) {
    $("#lentele").html('');

      $.each(result, function(i, field) {
        $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td><td><a class='btn btn-warning' href='cars.php?id=" + field.id +"'>Delete</a></td></tr>");
      });

    });
});

$("#owner_filter").keyup(function() {
    $.getJSON( "cars.php",
    {
      make_filter: $("#make_filter").val(),
      model_filter: $("#model_filter").val(),
      owner_filter: $("#owner_filter").val()
    },
     function(result) {
    $("#lentele").html('');

      $.each(result, function(i, field) {
        $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td><td><a class='btn btn-warning' href='cars.php?id=" + field.id +"'>Delete</a></td></tr>");
      });

    });
});

$("#last_filter").click(function() {
    $.getJSON( "cars.php",
    {
      last_filter: $("#last_filter").val()
    },
     function(result) {
    $("#lentele").html('');

      $.each(result, function(i, field) {
        $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td><td><a class='btn btn-warning' href='cars.php?id=" + field.id +"'>Delete</a></td></tr>");
      });

    });
});