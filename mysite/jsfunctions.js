$(function(){
    $("#container").on('click', '#btnNew', showUpHiddenField);

    $("#container").on('focus', '#inDate', function(){
        $(this).datepicker({minDate:0, dateFormat:'M dd'});
    });
    
    $("#container").on('click', '#btnCancel', showUpNewButton);

    $("#container").on('click', '#search', getAppointments);
    
    $("#container").on('click', '#btnAdd', addNewPost);
    
});

//This function used to get existing registered posts from server.
var getAppointments = function(){
    $.get('http://localhost/mysite/main.php', {
        val: $('#sword').val()
    }, function(data){
        tableRendering(data);
    });
};

//This function sends input information to server and register post in the server.
var addNewPost = function(){
    let res = validation();
    if(res != "") {
        $("#error").html(res);
    }else{
        $.post('http://localhost/mysite/main.php', {
            'date': $("#inDate").val(),
            'time': $("#inTime").val(),
            'des': $("#inDesc").val()
        }, function(data){
            tableRendering(data);
        });
    }
};

//Table rendering function
var tableRendering = function(data){
    $("#result tr:gt(0)").remove();
    var tableInfo = "";
        
    if(data != null || data.length > 0){
        data.forEach(e => {
            tableInfo += "<tr><td>" + e.date + "</td><td>" + e.time + "</td><td>" + e.description + "</td></tr>"
        });
        $("#result").append(tableInfo);
    }
};

//It shows up "New" button when we click "Cancel" button.
var showUpNewButton = function(){
    $("#error").empty();
    $("div.group").remove();
    $("#error").after($("<button>").attr("id", "btnNew").text("New"));
};

//It shows up "Hidden Form" when we click "New" button.
var showUpHiddenField = function(){
    this.remove();
    $("#error").after($("<div>").addClass("group").html(
        "<button id='btnAdd'>Add</button>" + 
        "<button id='btnCancel'>Cancel</button>" +
        "</br>" +
        "<span>DATE</span><input type='text' id='inDate'></br>" +
        "<span>TIME</span><input type='time' id='inTime'></br>" +
        "<span>DESC</span><input type='text' id='inDesc'></br>"
    )); 
};

//It validates the form input when we click "Add" button
var validation = function(){
    $("#error").empty();
    let error = "";
    let date = $("#inDate").val();
    let time = $("#inTime").val();
    let des = $("#inDesc").val();
    
    if(!date){
        error += "Please select date <br>";
    }

    if(!time || time.length < 5){
        error += "Please input time. <br>" ;
    }

    if(!des){
        error += "Please input description. <br>";
    }
    return error;
}
