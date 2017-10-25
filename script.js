$( "#submit" ).click(function() {

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
       $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td></tr>");
     });
    });
  });
});

$.getJSON("cars.php", function(result) {

  $("#lentele").html('');

  $.each(result, function(i, field) {
    $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td></tr>");
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
        $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td></tr>");
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
        $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td></tr>");
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
        $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td></tr>");
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
        $("#lentele").append("<tr><td>" + field.id + "</td><td>" + field.owner + "</td><td>" + field.license + "</td><td>" + field.model +  "</td><td>" + field.make + "</td><td>" + field.date + "</td></tr>");
      });

    });
});