$(document).ready(function () {
  $("body").on("click", "#add", function () {
    $.ajax({
      url: "ajax.php",
      method: "POST",
      data: { input: $("#newtask").val() },
      datatype: "JSON",
    }).done(function (response) {
        displayList($.parseJSON(response));
    });
  });

    $("body").on("click", ".delete", function(){
        console.log($(this).data('option'));
        $.ajax({
            'url':'ajax.php',
            'method':'POST',
            'data':{
                'index':$(this).data('id'), 
                'option':$(this).data('option')
            },
            datatype:'JSON'
        }).done(function(response){
            responseData = $.parseJSON(response);
            displayList(responseData['lists']);
            displayCompleted(responseData['completed']);
        })
    });
    var updateOption = '';
    $("body").on("click", ".edit", function(){
        var editId = $(this).data('id');
        updateOption = $(this).data('option');
        $.ajax({
            'url':'ajax.php',
            'method':'POST',
            'data':{
                'editIndex':editId, 
                'option':$(this).data('option')
            },
            datatype:'JSON'
        }).done(function(response){
            responseData = $.parseJSON(response);

            var html = '<input id="newtask" type="text">\
            <button id="update" data-id = '+editId+'>Update</button>';
            $('p').html(html);
            
            $('#newtask').val(responseData[editId]);  
            $('#add').hide();
            $('#update').show();
        })
    });

    $("p").on("click", "#update", function(){
        var updateId = $(this).data('id');
        
        $.ajax({
            'url':'ajax.php',
            'method':'POST',
            'data':{
                'updateIndex': updateId,
                'newList':$('#newtask').val(),
                'option':updateOption   
            },
            datatype:'JSON'
        }).done(function(response){
            $('#update').hide();
            
            var html = '<input id="newtask" type="text">\
            <button id="add" name="add">Add</button>';

            $('p').html(html);
            if (updateOption=='uncompleted'){
                displayList($.parseJSON(response));
            }
            else if(updateOption=='completed'){
                displayCompleted($.parseJSON(response));
            }
            
        })
    });

    $("body").on("change", ".check", function(){
        var checkIndex = $(this).data('id');
        $.ajax({
            'url':'ajax.php',
            'method':'POST',
            'data':{
                'checkIndex': checkIndex,    
            },
            datatype:'JSON'
        }).done(function(response){
            responseData = $.parseJSON(response);
            displayList(responseData['lists']);
            displayCompleted(responseData['completed']);
        })
    });

    $("body").on("change", ".uncheck", function(){
        var uncheckIndex = $(this).data('id');
        $.ajax({
            'url':'ajax.php',
            'method':'POST',
            'data':{
                'uncheckIndex': uncheckIndex,    
            },
            datatype:'JSON'
        }).done(function(response){
            responseData = $.parseJSON(response);
            displayList(responseData['lists']);
            displayCompleted(responseData['completed']);
        })
    });


});

function displayList(myData) {
  var text = "";
  for (var i = 0; i < myData.length; i++) {
    text +=
      '<li><input type="checkbox" class="check" data-id='+i+'>\
            <label>' + myData[i] +'</label>\
            <input type="text">\
            <button class="edit" data-option="uncompleted" data-id = '+i+' >Edit</button>\
            <button class="delete" data-option="uncompleted" data-id = '+i+'>Delete</button>\
        </li>';
  }
  $("#incomplete-tasks").html(text);
}

function displayCompleted(myData) {
    var text = "";
    for (var i = 0; i < myData.length; i++) {
      text +=
        '<li><input type="checkbox" class="uncheck" data-id='+i+' checked>\
              <label>' + myData[i] +'</label>\
              <input type="text">\
              <button class="edit" data-option="completed" data-id = '+i+' >Edit</button>\
              <button class="delete" data-option="completed" data-id = '+i+'>Delete</button>\
          </li>';
    }
    $("#completed-tasks").html(text);
  }